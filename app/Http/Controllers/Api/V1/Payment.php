<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Mpayment;
use App\Models\Admin\Mcommon;
use Route;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
use Helper;
use Stripe\StripeClient;

class Payment extends Controller
{

  private $_response_data;
  private $_user;
  private $mpayment;
  private $mcommon;
  private $data;
  private $request;
  private $helper;
  private $stripe;

  public function __construct(Request $request){

  $this->request = $request;
  $this->mpayment = new Mpayment;
  $this->mcommon = new Mcommon;
  $this->_response_data = array();
  $this->data = array();
  $this->_user = array();
  $this->helper = new Helper();

    //session_start();
    $url = Route::getCurrentRoute()->getActionName();
    $res = explode("@",$url);
    $method = $res[1];
    if(!in_array($method, array('register','login','stripe','stripepayment'))){

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



  function stripe(){
    $payload = "";
    $endpoint_secret = 'we_1MJ9hND948ccqB2ZCVDhsf2c';// test
    $body = @file_get_contents('php://input');
    $this->mpayment->savepaymentresponse($body,"stripe");
    $json = file_get_contents('php://input');
    $body = json_decode($json, true);
    $order_id = $body['data']['object']['client_reference_id'];
    $status = $body['data']['object']['status'];
    $amount = $body['data']['object']['amount_total'];
    $trn_id = $body['data']['object']['id'];
    $type = $body['type'];
    if($status ){
        $this->mpayment->saveTransaction($order_id,$status,$type,$amount,$trn_id);

    }
    $this->_response_data['status']="SUCCESS";
    $this->_response_data['code']="601";
    return $this->buildResponse();
  }

  function stripepayment(){

    $item=$this->mcommon->getsetting();
    if(!empty($item)) {
      $secret=$item->stripe_secret;
      }else{
        $secret="sk_test_51MniqoSH0POOrXjL69Un7jSpmVJRfB7Xxm8izgZUwiIcMZ9f8aAsH1WAbZiDt3LzzksQLIbiZpRdbDhBZleFDdWX00dLcdCdg0";
    }

    $this->stripe = new StripeClient($secret);
    $createCheckoutSession=$this->request->input('createCheckoutSession');
    $productName=$this->request->input('productname');
    $productPrice=$this->request->input('price');
    $currency=$this->request->input('currency');
    $order_id=$this->request->input('order_id');
    $url=$this->request->input('url');
    $productID = "DP12345";

    if(!empty($createCheckoutSession)){
      // Convert product price to cent
      $stripeAmount = round($productPrice*100, 2);
      try {
          $checkout_session = $this->stripe->checkout->sessions->create([
              'line_items' => [[
                  'price_data' => [
                      'product_data' => [
                          'name' => $productName,
                      ],
                      'unit_amount' => $stripeAmount,
                      'currency' => 'inr',
                  ],
                  'quantity' => 1
              ]],
              'mode' => 'payment',
              'client_reference_id' => $order_id,
              'success_url' => $url.'?session_id={CHECKOUT_SESSION_ID}',
              'cancel_url' => $url,
          ]);
      } catch(Exception $e) {
          $api_error = $e->getMessage();
      }

      if(empty($api_error) && $checkout_session){
          $response = array(
              'status' => 1,
              'message' => 'Checkout Session created successfully!',
              'sessionId' => $checkout_session->id
          );
      }else{
          $response = array(
              'status' => 0,
              'error' => array(
                  'message' => 'Checkout Session creation failed! '.$api_error
              )
          );
      }
    }
    echo json_encode($response);
  }



  public function razorpay(){

    $json = file_get_contents('php://input');
    $body = json_decode($json, true);
    $value = $json;
    $this->mpayment->savepaymentresponse($value,"razorpay");
        if(!empty($body) && isset($body['payload']) && !empty($body['payload'])){
            $payload=$body['payload'];
            if(isset($payload['payment']) && !empty($payload['payment'])){
                $payment=$payload['payment'];
                if(isset($payment['entity']['notes']) && !empty($payment['entity']['notes'])){
                    $notes=$payment['entity']['notes'];
                        $payment_id=$payment['entity']['order_id'];
                        $order_id=$notes['merchant_order_id'];
                        $amount=$payment['entity']['amount'];
                        $pay_id=$payment['entity']['id'];
                          $amount = substr($amount, 0, -2);
                          $amount = (int)$amount;
                          // if($payment['entity']['status']=='captured') {
                          //   $statuss = "Paid";
                          //   $result = $this->users->update_transaction_payment_status($payment_id,$statuss,$pay_id);
                          //   if($result['user_id'] != ""){
                          //     $this->users->update_payment_status_usertable($result['user_id']);
                          //     $this->users->update_package_order_status($result['order_id']);
                          //   }
                          // }else if($payment['entity']['status']=='authorized'){
                          //   $statuss = "Authorized";
                          //   $this->users->update_transaction_payment_status($payment_id,$statuss,$pay_id);

                          // }else{
                          //   $statuss = 'Falied';
                          //   $this->users->update_transaction_payment_status($payment_id,$statuss,$pay_id);
                          // }
                }
            }
        }

  }





  }
