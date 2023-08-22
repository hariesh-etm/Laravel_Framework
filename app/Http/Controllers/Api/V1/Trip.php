<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mtrip;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;


class Trip extends Controller
{

  private $_response_data;
  private $_user;
  private $mtrip;
  private $data;
  private $request;
  private $helper;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mtrip = new Mtrip;
  $this->_response_data = array();
  $this->data = array();
  $this->_user = array();
  $this->helper = new Helper();
    $url = Route::getCurrentRoute()->getActionName();
    $res = explode("@",$url);
    $method = $res[1];
    if(!in_array($method, array('register','login','getLocationTest'))){
      $token = $request->bearerToken();
      $this->_user = $this->helper->getAuthentication($token);
    }
  }
  public function buildResponse()
  {
    if($this->_response_data['code'] && $this->_response_data['code']!='' && !isset($this->_response_data['message']))
      $this->_response_data['message']=__('api.'.$this->_response_data['code']);
    if($this->_user == 401){
      $response_data = array('status' => 'FAILED', 'code' => '401', 'message' => __('api.501'));
      return Response::json($response_data, 200);
    }else {
      return Response::json($this->_response_data, 200);
    }
  }
  function checkValidator($rules){
    $validator = Validator::make($this->request->all(), $rules);
    if($validator->fails()){
      $this->_response_data['status']="FAILED";
      $this->_response_data['message']=$validator->errors()->all();
    }
  }

  function listTripdt(){
    $user_id=$this->_user['user_id'];
    $postData = $this->request->input();
    $data = $this->mtrip->getTripListDt($postData,$user_id);
    return $data;
  }

  function listTripById (){
    $id=$this->request->input('id');
    if($id){
        $list=$this->mtrip->listTripById($id);
        // $record=array();
        if(!empty($list) ){
            $record=$list;
        }
        $this->_response_data['status']="SUCCESS";
        $this->_response_data['list']=$record;
        $this->_response_data['code']="206";
    }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="207";
    }
    return $this->buildResponse();
 }

  function createTrip(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $start_km=$this->request->input('start_km');
      $latt=$this->request->input('latitude');
      $lang=$this->request->input('langtitude');
      $created_by=$this->_user['user_id'];

    //   $web = 'positionstack';
      if($lang != ""){
   $locationDt = json_decode($this->getLocation($latt,$lang));
 //print_r($locationDt);
 //print_r($locationDt->results[0]->formatted_address);
if(isset($locationDt->results)){
  if(count($locationDt->results) > 0 ) {
    $location = $locationDt->results[0]->formatted_address;
  }else if(isset($locationDt->plus_code)){
    $location = $locationDt->plus_code->compound_code;
  }else{
    $location = "No Data";
  }

}else{
  $location = "";
}

// echo $location;
// $array = explode(' ', $data_loc);
// print_r($array);
// $location = $array[1];
// echo $location;
// exit;
        $i_status=$this->mtrip->createTrip($start_km,$lang,$latt,$location,$created_by);
        if($i_status=='A'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="208";
        }else if($i_status=='E'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="105";
        }else{
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['code']="201";
          $this->_response_data['trip_id']=$i_status;
        }
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="109";
      }

    return $this->buildResponse();
  }
  function updateTrip(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $id=$this->request->input('id');
      $latt=$this->request->input('u_latitude');
      $lang=$this->request->input('u_langtitude');
      $end_km = $this->request->input('end_km');
			$updated_by=$this->_user['user_id'];


      if($latt != ""){
        $locationDt = json_decode($this->getLocation($latt,$lang));

        if(isset($locationDt->results)){
          if(count($locationDt->results) > 0 ) {
            $location = $locationDt->results[0]->formatted_address;
          }else if(isset($locationDt->plus_code)){
            $location = $locationDt->plus_code->compound_code;
          }else{
            $location = "No Data";
          }

        }else{
          $location = "";
        }

       /* if(isset($locationDt->plus_code)){
          $location = $locationDt->plus_code->compound_code;
        }else{
          $location = "";
        }*/
        //$location = $locationDt->plus_code->compound_code;
    // $apiResult = $response->data;
        $i_status=$this->mtrip->updateTrip($id,$end_km,$lang,$latt,$location,$updated_by);
        if($i_status){
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['code']="202";
        }else{
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="209";
        }
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="109";
      }

    return $this->buildResponse();
  }
  function deleteGeolocation(){
        $id=$this->request->input('id');
        if($id){
        $status=$this->mtrip->deleteGeolocation($id);
        if($status){
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['code']="205";
        }else{
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="302";
        }
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="109";
      }
    return $this->buildResponse();
  }

  function getLocation($latt,$lang){
    // $latt=$this->request->input('latitude');
    // $lang=$this->request->input('langtitude');
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latt.','.$lang.'%0A&location_type=ROOFTOP&result_type=street_address&key=AIzaSyDOvRJlOOIdvOzaJ_OU_FNMMlvbjZQei00';
    // echo $url;
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;

}

function getLocationTest(){
   $latt=$this->request->input('latitude');
   $lang=$this->request->input('langtitude');
  $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latt.','.$lang.'%0A&location_type=ROOFTOP&result_type=street_address&key=AIzaSyDOvRJlOOIdvOzaJ_OU_FNMMlvbjZQei00';
  // echo $url;
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  print_r($response);

  return $response;

}

function getalltrip(){
  $user_id=$this->_user['user_id'];
  $data = $this->mtrip->getalltrip($user_id);
  return $data;
}
}
