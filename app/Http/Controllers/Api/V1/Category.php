<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mcategory;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;


class Category extends Controller
{

  private $_response_data;
  private $_user;
  private $mcategory;
  private $data;
  private $request;
  private $helper;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mcategory = new Mcategory;
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
  function listCategorygt(){
      $limit=$this->request->input('limit');
      $offset=$this->request->input('offset');
      $role=$this->request->input('search_role');
      $status=$this->request->input('search_status');
      $list=$this->mcategory->getCategoryListGt($role, $status, $limit, $offset);
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

  function listCategorydt(){
    $postData = $this->request->input();
    $data = $this->mcategory->getCategoryListDt($postData);
    return $data;
  }

  function listCategoryById (){
    $id=$this->request->input('id');
    if($id){
        $list=$this->mcategory->getCategoryListById($id);
        $record=array();
        if(!empty($list)){
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

  function createCategory(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $name=$this->request->input('name');
			$slug=$this->request->input('slug');
			$serial=$this->request->input('serial');
			$created_by=$this->_user['user_id'];
      if($name != "" && $slug != ""){
        $i_status=$this->mcategory->createCategory($name,$slug,$serial,$created_by);
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
  function updateCategory(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $id=$this->request->input('u_id');
			$name=$this->request->input('u_name');
			$slug=$this->request->input('u_slug');
			$serial=$this->request->input('u_serial');
			$updated_by=$this->_user['user_id'];
      if($id != "" && $name != "" && $slug != ""){
        $i_status=$this->mcategory->updateCategory($id,$name,$slug,$serial,$updated_by);
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
  function deleteCategory(){
        $id=$this->request->input('id');
        if($id){
        $status=$this->mcategory->deleteCategory($id);
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
