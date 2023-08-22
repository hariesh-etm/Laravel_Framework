<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mpayment;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;
use Stripe\StripeClient;

class Paypal extends Controller
{

  private $_response_data;
  private $_user;
  private $mpayment;
  private $data;
  private $request;
  private $helper;
  private $stripe;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mpayment = new Mpayment;
  $this->_response_data = array();
  $this->data = array();
  $this->_user = array();
  $this->helper = new Helper();

    //session_start();
    $url = Route::getCurrentRoute()->getActionName();
    $res = explode("@",$url);
    $method = $res[1];
    if(!in_array($method, array('register','login','stripe','stripepayment','paypal'))){

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


  function paypal(){

    $json = file_get_contents('php://input');
    $body = json_decode($json);
    $this->mpayment->savepaymentresponse($json,"paypal");
    //$this->mpayment->savepaymentresponse($body,"paypalbody");
   // $this->mpayment->savepaymentresponse($body["id"],"paypal_id");
    $this->mpayment->savepaymentresponse($body->id,"paypal_id");
    $order_id = $body->resource->parent_payment;
    $status = $body->resource->state;
    $this->mpayment->savepaymentresponse($order_id,"paypal_orderid");
    $this->mpayment->savepaymentresponse($status,"paypal_status");

    $this->_response_data['status']="SUCCESS";
    $this->_response_data['code']="601";
    return $this->buildResponse();
  }






  }
