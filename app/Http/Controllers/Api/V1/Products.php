<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mproducts;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;


class Products extends Controller
{

  private $_response_data;
  private $_user;
  private $mproducts;
  private $data;
  private $request;
  private $helper;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mproducts = new Mproducts;
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
  function listproductsgt(){
      $limit=$this->request->input('limit');
      $offset=$this->request->input('offset');
      $role=$this->request->input('search_role');
      $status=$this->request->input('search_status');
      $list=$this->mproducts->getproductsListGt($role, $status, $limit, $offset);
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

  function listproductsdt(){
    $postData = $this->request->input();
    $data = $this->mproducts->getproductsListDt($postData);
    return $data;
  }

  function getAllProducts(){
    $data = $this->mproducts->getAllproducts();
    return $data;
  }

  function listproductsById (){
    $id=$this->request->input('id');
    if($id){
        $list=$this->mproducts->getproductsListById($id);
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

  function createproducts(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $product_name=$this->request->input('product_name');
			$product_desc=$this->request->input('product_desc');
			$price=$this->request->input('price');
			$offer_price=$this->request->input('offer_price');
			$category_id=$this->request->input('category_id');
			$sub_category_id=$this->request->input('sub_category_id');
			$image_url=$this->request->input('image_url');
			$created_by=$this->_user['user_id'];
      if($product_name != "" && $product_desc != "" && $price != "" && $offer_price != "" && $category_id != "" && $sub_category_id != "" ){
        $i_status=$this->mproducts->createproducts($product_name,$product_desc,$price,$offer_price,$category_id,$sub_category_id,$image_url,$created_by);
        if($i_status=='A'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="208";
        }else if($i_status=='E'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="105";
        }else{
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['code']="201";
          $id = $i_status;
          $image_url = '';
          $invalid_image_format = false;
          // $image_url = $request->input('media');
          if (isset($_FILES['media']) && !empty($_FILES['media'])) {
          $media_name = $_FILES['media']['name'];
          $media_type = $_FILES['media']['type'];
          $media_tmp_name = $_FILES['media']['tmp_name'];
          $media_error = $_FILES['media']['error'];
          $media_size = $_FILES['media']['size'];
          $tmp = explode(".", $media_name);
          $media_ext = array_pop($tmp);
          if ($media_ext == 'gif' || $media_ext == 'jpg' || $media_ext == 'jpeg' || $media_ext == 'png' || $media_ext == 'PNG') {
          $file_name = md5("product|" . date('Y-m-d H:i:s'));
          $target_dir = "cdn/product/o/".$id;
          $return = $this->helper->saveCdn($media_ext, $media_tmp_name, $media_error, $file_name, $target_dir);
          if ($return['status'] == 'S') {
          $m_target_dir = "cdn/product/m/".$id;
          $this->helper->imageCrop($return['url'], $m_target_dir, $file_name, $media_ext, 360, 360); //resize the image
          $image_url = $m_target_dir . '/' . $file_name . '.' . $media_ext;
          } else {
          $invalid_image_format = true;
          }
          } else {
          $invalid_image_format = true;
          }

          if (!empty($image_url)) {
          $this->mproducts->imageupload($image_url, $id);
          }
}
        }
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="109";
      }

    return $this->buildResponse();
  }
  function updateproducts(){
      $rules=$this->helper->makeValidateRules($this->request->all());
      $this->checkValidator($rules);
      $id=$this->request->input('u_id');
			$product_name=$this->request->input('u_product_name');
			$product_desc=$this->request->input('u_product_desc');
			$price=$this->request->input('u_price');
			$offer_price=$this->request->input('u_offer_price');
			$category_id=$this->request->input('u_category_id');
			$sub_category_id=$this->request->input('u_sub_category_id');
			$image_url=$this->request->input('image_url');
			$updated_by=$this->_user['user_id'];
      if($id != "" && $product_name != "" && $product_desc != "" && $price != "" && $offer_price != "" && $category_id != "" && $sub_category_id != "" ){
        $i_status=$this->mproducts->updateproducts($id,$product_name,$product_desc,$price,$offer_price,$category_id,$sub_category_id,$image_url,$updated_by);
        if($i_status){
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['code']="202";
          $id = $i_status;
          $image_url = '';
          $invalid_image_format = false;
          // $image_url = $request->input('media');
          if (isset($_FILES['umedia']) && !empty($_FILES['umedia'])) {
          $media_name = $_FILES['umedia']['name'];
          $media_type = $_FILES['umedia']['type'];
          $media_tmp_name = $_FILES['umedia']['tmp_name'];
          $media_error = $_FILES['umedia']['error'];
          $media_size = $_FILES['umedia']['size'];
          $tmp = explode(".", $media_name);
          $media_ext = array_pop($tmp);
          if ($media_ext == 'gif' || $media_ext == 'jpg' || $media_ext == 'jpeg' || $media_ext == 'png' || $media_ext == 'PNG') {
          $file_name = md5("product|" . date('Y-m-d H:i:s'));
          $target_dir = "cdn/product/o/".$id;
          $return = $this->helper->saveCdn($media_ext, $media_tmp_name, $media_error, $file_name, $target_dir);
          if ($return['status'] == 'S') {
          $m_target_dir = "cdn/product/m/".$id;
          $this->helper->imageCrop($return['url'], $m_target_dir, $file_name, $media_ext, 360, 360); //resize the image
          $image_url = $m_target_dir . '/' . $file_name . '.' . $media_ext;
          } else {
          $invalid_image_format = true;
          }
          } else {
          $invalid_image_format = true;
          }

          if (!empty($image_url)) {
          $this->mproducts->imageupload($image_url, $id);
          }
}
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
  function deleteproducts(){
        $id=$this->request->input('id');
        if($id){
        $status=$this->mproducts->deleteproducts($id);
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
