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

class Mail extends Controller
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
    if(!in_array($method, array('register','login','generateuser'))){

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
function sendmail($mail,$message,$subject){
    // $mail=$this->request->input('mail');
    // $message=$this->request->input('message');

    $item=$this->mcommon->general_setting();
    if(!empty($item)) {
      $zepto_mail_url=$item[0]->option_value;
      $zepto_from_mail=$item[1]->option_value;
      $zepto_mail_bounce_address=$item[2]->option_value;
      $zepto_mail_key=$item[3]->option_value;
      $zepto_mail_name=$item[4]->option_value;
      }else{
        $zepto_mail_url="https://api.zeptomail.in/v1.1/email";
        $zepto_from_mail="noreply@flutterappz.com";
        $zepto_mail_bounce_address="support@bounce.flutterappz.com";
        $zepto_mail_key="Zoho-enczapikey PHtE6r0IRrjti2YsoRlVsf7qH8D2YIIq/u5ieQYVuY0XDfMDHk1QotkrxjPl+RstVaZKR/OTmos9t+jJsOOCJm+8NjxJWmqyqK3sx/VYSPOZsbq6x00bs1wYcUDeUYTretdr0yfSut7fNA==";
        $zepto_mail_name="flutterappz";
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $zepto_mail_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '{
    "bounce_address":"'.$zepto_mail_bounce_address.'",
    "from": { "address": "'.$zepto_from_mail.'","name":"'.$zepto_mail_name.'"},
    "to": [{"email_address": {"address": "'.$mail.'","name": "hariesh"}}],
    "subject":"'.$subject.'",
    "htmlbody":"'.$message.'",
    }',
        CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "authorization: ".$zepto_mail_key."\"",
            "cache-control: no-cache",
            "content-type: application/json",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    // if ($err) {
    //     echo "cURL Error #:" . $err;
    // } else {
    //     echo $response;
    // }


  }
}
