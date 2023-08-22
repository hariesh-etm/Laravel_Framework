<?php
 
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mrole_permission;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;


class Role_permission extends Controller
{

  private $_response_data;
  private $_user;
  private $mrole_permission;
  private $data;
  private $request;
  private $helper;
  
  public function __construct(Request $request){

  $this->request = $request;
  $this->mrole_permission = new Mrole_permission;
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
  function listRole_permissiongt(){
      $limit=$this->request->input('limit');
      $offset=$this->request->input('offset');
      $role=$this->request->input('search_role');
      $status=$this->request->input('search_status');
      $list=$this->mrole_permission->getRole_permissionListGt($role, $status, $limit, $offset);
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

  function listRole_permissiondt(){
    $postData = $this->request->input();
    $data = $this->mrole_permission->getRole_permissionListDt($postData);
    return $data;
  }

  function getAllRole_permission($role_id){
    $data = $this->mrole_permission->getAllRole_permission($role_id);
    return $data;
  }

  function listRole_permissionById (){
    $id=$this->request->input('id');
    if($id){
        $list=$this->mrole_permission->getRole_permissionListById($id);
        if(!empty($list)){
        $this->_response_data['status']="SUCCESS";
        $this->_response_data['list']=$list;
        $this->_response_data['code']="206"; 
        }else{
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="207";
        } 
    }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="109";
    }
    return $this->buildResponse();
 }

  function createRole_permission(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $role_id=$this->request->input('role_id');
			$page_type=$this->request->input('page_type');
			$create_option=$this->request->input('create_option');
			$read_option=$this->request->input('read_option');
			$update_option=$this->request->input('update_option');
			$delete_option=$this->request->input('delete_option');
			$created_by=$this->_user['user_id'];
      if($role_id != ""){
        $i_status=$this->mrole_permission->createRole_permission($role_id,$page_type,$create_option,$read_option,$update_option,$delete_option,$created_by);
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
  function updateRole_permission(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $id=$this->request->input('id');
			$role_id=$this->request->input('u_role_id');
			$page_type=$this->request->input('u_page_type');
			$create_option=$this->request->input('create_option');
			$read_option=$this->request->input('read_option');
			$update_option=$this->request->input('update_option');
			$delete_option=$this->request->input('delete_option');
			$updated_by=$this->_user['user_id'];
      if($id != "" && $role_id != ""){
        $i_status=$this->mrole_permission->updateRole_permission($id,$role_id,$page_type,$create_option,$read_option,$update_option,$delete_option,$updated_by);
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
  function deleteRole_permission(){
        $id=$this->request->input('id');
        if($id){
        $status=$this->mrole_permission->deleteRole_permission($id);
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