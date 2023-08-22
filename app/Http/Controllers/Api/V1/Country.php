<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mcountry;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;


class Country extends Controller
{

  private $_response_data;
  private $_user;
  private $mcountry;
  private $data;
  private $request;
  private $helper;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mcountry = new Mcountry;
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
      $list=$this->mcountry->getCountryListGt($role, $status, $limit, $offset);
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

  function listCountrydt(){
    $postData = $this->request->input();
    $data = $this->mcountry->getCountryListDt($postData);
    return $data;
  }

  function listCountryById (){
    $id=$this->request->input('id');
    if($id){
        $list=$this->mcountry->getCountryListById($id);
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

  function createCountry(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $country_name=$this->request->input('country_name');
			// $iso3=$this->request->input('iso3');
			// $iso2=$this->request->input('iso2');
			// $numeric_code=$this->request->input('numeric_code');
			$phone_code=$this->request->input('phone_code');
			$capital=$this->request->input('capital');
			// $currency=$this->request->input('currency');
			$currency_name=$this->request->input('currency_name');
			$currency_symbol=$this->request->input('currency_symbol');
			$tld=$this->request->input('tld');
			$is_active=$this->request->input('is_active');
			$created_by=$this->_user['user_id'];
      if($country_name != ""){
        $i_status=$this->mcountry->createCountry($country_name,$phone_code,$capital,$currency_name,$currency_symbol,$tld,$is_active,$created_by);
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
  function updateCountry(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $country_id=$this->request->input('u_country_id');
			$country_name=$this->request->input('u_country_name');
			$phone_code=$this->request->input('u_phone_code');
			$capital=$this->request->input('u_capital');
			// $currency=$this->request->input('currency');
			$currency_name=$this->request->input('u_currency_name');
			$currency_symbol=$this->request->input('u_currency_symbol');
			$tld=$this->request->input('u_tld');
			$is_active=$this->request->input('u_is_active');
			$updated_by=$this->_user['user_id'];
      if($country_id != ""){
        $i_status=$this->mcountry->updateCountry($country_id,$country_name,$phone_code,$capital,$currency_name,$currency_symbol,$tld,$is_active,$updated_by);
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
  function deleteCountry(){
        $id=$this->request->input('id');
        if($id){
        $status=$this->mcountry->deleteCountry($id);
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
