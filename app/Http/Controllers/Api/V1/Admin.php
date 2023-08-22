<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mcommon;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;
use PDF;

class Admin extends Controller
{

  private $_response_data;
  private $_user;
  private $mcommon;
  private $data;
  private $request;
  private $helper;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mcommon = new Mcommon;
  $this->_response_data = array();
  $this->data = array();
  $this->_user = array();
  $this->helper = new Helper();

    //session_start();
    $url = Route::getCurrentRoute()->getActionName();
    $res = explode("@",$url);
    $method = $res[1];
    if(!in_array($method, array('register','login','generateuser','googlelogin'))){

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
      $this->_response_data['code']="110";
      $this->_response_data['message']=$validator->errors();
      return true;
    }else{
      return false;
    }
  }


  function login(){
    $rules=$this->helper->makeValidateRules($this->request->all());
    $this->checkValidator($rules);
    $username=$this->request->input('username');
    $password=$this->request->input('password');
    // echo $this->helper->encrypt($username);


    if($username && $password){
      $user=$this->mcommon->verifyUser($username, $password);
      if(!empty($user)){
        if($user->status=='1'){
          $auth_token=$this->helper->encrypt($this->helper->encodeData($user->id)."|".$user->role."|".time());
          $session_data = [
            'auth_token'  => $auth_token,
            'display_name' => $username,
            'logged_in' => true,
          ];
          session()->put('auth_token', $auth_token);
          session()->put('role', $user->role);
          session()->put('display_name', $username);
          session()->put('logged_in', true);
          session()->put('user_id', $user->id);
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['auth_token']=$auth_token;
          $this->_response_data['redirect']='dashboard';
          $this->_response_data['code']="203";

        }else if($user->status=='BLOCKED'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="106";
        }else{
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="107";
        }
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="103";
      }
    }else{
      $this->_response_data['status']="FAILED";
      $this->_response_data['code']="102";
    }
    return $this->buildResponse();
  }

  function googlelogin(){
    $rules=$this->helper->makeValidateRules($this->request->all());
    $this->checkValidator($rules);
    $username=$this->request->input('username');
    $password=$this->request->input('password');
    // echo $this->helper->encrypt($username);


    if($username && $password){
      $user=$this->mcommon->verifygoogleUser($username, $password);
      if(!empty($user)){
        if($user->status=='1'){
          $auth_token=$this->helper->encrypt($this->helper->encodeData($user->id)."|".$user->role."|".time());
          $session_data = [
            'auth_token'  => $auth_token,
            'display_name' => $username,
            'logged_in' => true,
          ];
          session()->put('auth_token', $auth_token);
          session()->put('role', $user->role);
          session()->put('display_name', $username);
          session()->put('logged_in', true);
          session()->put('user_id', $user->id);
          $this->_response_data['status']="SUCCESS";
          $this->_response_data['auth_token']=$auth_token;
          $this->_response_data['redirect']='dashboard';
          $this->_response_data['code']="203";

        }else if($user->status=='BLOCKED'){
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="106";
        }else{
          $this->_response_data['status']="FAILED";
          $this->_response_data['code']="107";
        }
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="103";
      }
    }else{
      $this->_response_data['status']="FAILED";
      $this->_response_data['code']="102";
    }
    return $this->buildResponse();
  }

  function generateuser(){

    $record=$this->mcommon->createUsers();
      if(!empty($record)){
        $this->_response_data['status']="SUCCESS";
        $this->_response_data['code']="203";
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="102";
      }
  }

  function formvalid(){

    $rules=$this->helper->makeValidateRules($this->request->all());
    if($this->checkValidator($rules)){
      return $this->buildResponse();
    }
    $name=$this->request->input('name');
    $phone=$this->request->input('phone');
    $email=$this->request->input('email');
    $aadhar=$this->request->input('aadhar');
    $pancard=$this->request->input('pancard');
    if($name !="" && $phone !="" && $email !="" && $aadhar !="" && $pancard !=""){
      $this->_response_data['status']="SUCCESS";
      $this->_response_data['code']="203";
    }else{
      $this->_response_data['status']="FAILED";
      $this->_response_data['code']="102";
    }
    return $this->buildResponse();
  }

  function updatesetting(){

    $rules=$this->helper->makeValidateRules($this->request->all());
    if($this->checkValidator($rules)){
      return $this->buildResponse();
    }
    $id=$this->request->input('id');
    $type=$this->request->input('type');
    $razorpay_key=$this->request->input('razorpay_key');
    $razorpay_secret=$this->request->input('razorpay_secret');
    $stripe_key=$this->request->input('stripe_key');
    $stripe_secret=$this->request->input('stripe_secret');
    $paypal_client_id=$this->request->input('paypal_client_id');
    $paypal_secret=$this->request->input('paypal_secret');
    $paypal_option=$this->request->input('paypal_option');
    $razorpay_option=$this->request->input('razorpay_option');
    $stripe_option=$this->request->input('stripe_option');
    $updated_by=$this->_user['user_id'];
    //if($type !=""){
      $record=$this->mcommon->updatesetting($id,$type,$razorpay_key,$razorpay_secret,$stripe_key,$stripe_secret,$paypal_client_id,$paypal_secret,$updated_by,$paypal_option,$razorpay_option,$stripe_option);
      if($record['status'] == 'S'){
        $this->_response_data['status']="SUCCESS";
        $this->_response_data['code']="301";
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="302";
      }
    // }else{
    //   $this->_response_data['status']="FAILED";
    //   $this->_response_data['code']="102";
    // }
    return $this->buildResponse();

  }

  function updateemailsetting(){

    $rules=$this->helper->makeValidateRules($this->request->all());
    if($this->checkValidator($rules)){
      return $this->buildResponse();
    }
    $zepto_mail_url=$this->request->input('zepto_mail_url');
    $zepto_from_mail=$this->request->input('zepto_from_mail');
    $zepto_mail_bounce_address=$this->request->input('zepto_mail_bounce_address');
    $zepto_mail_key=$this->request->input('zepto_mail_key');
    $zepto_mail_name=$this->request->input('zepto_mail_name');
    $updated_by=$this->_user['user_id'];
    $record=$this->mcommon->updateemailsetting($zepto_mail_url,$zepto_from_mail,$zepto_mail_bounce_address,$zepto_mail_key,$zepto_mail_name,$updated_by);
    if($record['status'] == 'S'){
      $this->_response_data['status']="SUCCESS";
      $this->_response_data['code']="301";
    }else{
      $this->_response_data['status']="FAILED";
      $this->_response_data['code']="302";
    }
    return $this->buildResponse();
  }
  function updategeneralsetting(){
    $rules=$this->helper->makeValidateRules($this->request->all());
    if($this->checkValidator($rules)){
      return $this->buildResponse();
    }
    $site_name=$this->request->input('site_name');
    $site_description=$this->request->input('site_description');
    $updated_by=$this->_user['user_id'];
    $record=$this->mcommon->updategeneralsetting($site_name,$site_description,$updated_by);
    if($record['status'] == 'S'){
      $this->_response_data['status']="SUCCESS";
      $this->_response_data['code']="301";
    }else{
      $this->_response_data['status']="FAILED";
      $this->_response_data['code']="302";
    }
    return $this->buildResponse();
  }

  public function useractivity(){
    $page_code=$this->request->input('page_code');
    $ip_address=$this->request->input('ip_address');
    $user_id=$this->_user['user_id'];
    if($user_id !=""){
      $record=$this->mcommon->useractivity($user_id,$page_code,$ip_address);
      if($record['status'] == 'S'){
        $this->_response_data['status']="SUCCESS";
        $this->_response_data['code']="206";
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="207";
      }
    }else{
      $this->_response_data['status']="FAILED";
      $this->_response_data['code']="207";
    }
    return $this->buildResponse();
  }

  public function userlog(){
    $page_code=$this->request->input('page_code');
    $ip_address=$this->request->input('ip_address');
    $user_id=$this->_user['user_id'];
    if($user_id !=""){
      $record=$this->mcommon->userlog($user_id,$page_code,$ip_address);
      if($record['status'] == 'S'){
        $this->_response_data['status']="SUCCESS";
        $this->_response_data['code']="206";
      }else{
        $this->_response_data['status']="FAILED";
        $this->_response_data['code']="207";
      }
    }else{
      $this->_response_data['status']="FAILED";
      $this->_response_data['code']="207";
    }
    return $this->buildResponse();
  }



  }
