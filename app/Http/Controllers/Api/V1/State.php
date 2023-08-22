<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mstate;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;


class State extends Controller
{

  private $_response_data;
  private $_user;
  private $mstate;
  private $data;
  private $request;
  private $helper;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mstate = new Mstate;
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
  function listStategt(){
      $limit=$this->request->input('limit');
      $offset=$this->request->input('offset');
      $role=$this->request->input('search_role');
      $status=$this->request->input('search_status');
      $list=$this->mstate->getStateListGt($role, $status, $limit, $offset);
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

  function listStatedt(){
    $postData = $this->request->input();
    $data = $this->mstate->getStateListDt($postData);
    return $data;
  }

  function listStateById (){
    $id=$this->request->input('id');
    if($id){
        $list=$this->mstate->getStateListById($id);
        $record=array();
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

  function createState(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $state_name=$this->request->input('state_name');
			$country_id=$this->request->input('country_id');
			$created_by=$this->_user['user_id'];
      if($state_name != ""){
        $i_status=$this->mstate->createState($state_name,$country_id,$created_by);
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
  function updateState(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $state_id=$this->request->input('u_state_id');
			$state_name=$this->request->input('u_state_name');
			$country_id=$this->request->input('u_country_id');
			$updated_by=$this->_user['user_id'];
      if($state_id != ""){
        $i_status=$this->mstate->updateState($state_id,$state_name,$country_id,$updated_by);
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
  function deleteState(){
        $id=$this->request->input('id');
        if($id){
        $status=$this->mstate->deleteState($id);
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

            function getStateByCountry(){
                $id=$this->request->input('id');
                if($id){
                    $list=$this->mstate->getStateByCountry($id);
                    $record=array();
                    if(!empty($list) && isset($list[0])){
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
}
