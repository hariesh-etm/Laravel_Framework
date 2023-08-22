<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mgeolocation;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;


class Geolocation extends Controller
{

  private $_response_data;
  private $_user;
  private $mgeolocation;
  private $data;
  private $request;
  private $helper;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mgeolocation = new Mgeolocation;
  $this->_response_data = array();
  $this->data = array();
  $this->_user = array();
  $this->helper = new Helper();
    $url = Route::getCurrentRoute()->getActionName();
    $res = explode("@",$url);
    $method = $res[1];
    if(!in_array($method, array('register','login'))){
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
  function listCountrygt(){
      $limit=$this->request->input('limit');
      $offset=$this->request->input('offset');
      $role=$this->request->input('search_role');
      $status=$this->request->input('search_status');
      $list=$this->mgeolocation->getCountryListGt($role, $status, $limit, $offset);
      $total_size=0;
      $record=array();
      if(!empty($list) && isset($list[0]) && isset($list[0]->total_size)){
        $record=$this->helper->setEncryptValue($list, array('id'), true);
        $total_size=$list[0]->total_size;
      }
      $this->_response_data['status']="SUCCESS";
      $this->_response_data['list']=$record;
      $this->_response_data['total_size']=$total_size;
      $this->_response_data['code']="206";

    return $this->buildResponse();
  }

  function listGeolocationdt(){
    $postData = $this->request->input();
    $data = $this->mgeolocation->getGeolocationListDt($postData);
    return $data;
  }

  function listGeolocationById (){
    $id=$this->request->input('id');
    if($id){
        $list=$this->mgeolocation->listGeolocationById($id);
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

  function createGeolocation(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $latt=$this->request->input('latitude');
      $lang=$this->request->input('langtitude');
      $created_by=$this->_user['user_id'];
      $web = 'positionstack';
      if($lang != ""){
        $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://api.positionstack.com/v1/reverse?access_key=10855522aecda309e95914c6b533ae7a&query='.$latt.','.$lang.'',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => 'GET',
    ));

$response = curl_exec($curl);
// $apiResult = $response->data;

curl_close($curl);
// echo $response;
        $i_status=$this->mgeolocation->createGeolocation($lang,$latt,$response,$created_by,$web);
        if($i_status=='A'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="208";
        }else if($i_status=='E'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="105";
        }else{
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['code']="201";
        }
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="109";
      }

    return $this->buildResponse();
  }
  function updateGeolocation(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $id=$this->request->input('u_id');
      $latt=$this->request->input('u_latitude');
      $lang=$this->request->input('u_langtitude');
			$updated_by=$this->_user['user_id'];
      $web = 'positionstack';

      if($latt != ""){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://api.positionstack.com/v1/reverse?access_key=10855522aecda309e95914c6b533ae7a&query='.$latt.','.$lang.'',
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
    // $apiResult = $response->data;
        $i_status=$this->mgeolocation->updateGeolocation($id,$lang,$latt,$response,$updated_by,$web);
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
        $status=$this->mgeolocation->deleteGeolocation($id);
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

  function listGeolocationdt_google(){
    $postData = $this->request->input();
    $data = $this->mgeolocation->getGeolocationListDt($postData);
    return $data;
  }

  function listGeolocationById_google (){
    $id=$this->request->input('id');
    if($id){
        $list=$this->mgeolocation->listGeolocationById($id);
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

  function createGeolocation_google(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $latt=$this->request->input('latitude');
      $lang=$this->request->input('langtitude');
      $created_by=$this->_user['user_id'];
      if($lang != ""){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latt.','.$lang.'&key=AIzaSyDOvRJlOOIdvOzaJ_OU_FNMMlvbjZQei00',
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
        echo $response;
// echo $response;
        $i_status=$this->mgeolocation->createGeolocation($lang,$latt,$response,$created_by);
        if($i_status=='A'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="208";
        }else if($i_status=='E'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="105";
        }else{
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['code']="201";
        }
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="109";
      }

    return $this->buildResponse();
  }
  function updateGeolocation_google(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $id=$this->request->input('u_id');
      $latt=$this->request->input('u_latitude');
      $lang=$this->request->input('u_langtitude');
			$updated_by=$this->_user['user_id'];
      if($latt != ""){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latt.','.$lang.'&key=AIzaSyDOvRJlOOIdvOzaJ_OU_FNMMlvbjZQei00',
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
        echo $response;
    // $apiResult = $response->data;
        $i_status=$this->mgeolocation->updateGeolocation($id,$lang,$latt,$response,$updated_by);
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
  function deleteGeolocation_google(){
        $id=$this->request->input('id');
        if($id){
        $status=$this->mgeolocation->deleteGeolocation($id);
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
}
