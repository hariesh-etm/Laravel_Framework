<?php

namespace App\Http\Controllers\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Route;
use Helper;
use Session;
use App;
use PDF;
use App\Models\Admin\Mcommon;

class Admin extends Controller
{
    private $data;
    private $method;
    private $helper;
    private $_user;
    private $mcommon;

    public function __construct(){
      $this->data=array();
      $this->_user = array();
      $this->mcommon = new Mcommon;
      $this->helper = new Helper();
      $url = Route::getCurrentRoute()->getActionName();
      $res = explode("@",$url);
      $this->method = $this->urlTokenizer($res[1]);
      $this->middleware(function ($request, $next) {
        if((!session()->has('auth_token')) && $this->method != "login"){
          Redirect::to('login')->send();
          }
          if(session()->has('auth_token'))
          {
           //echo session('auth_token');
           $this->_user = $this->helper->getAuthentication();
          }
        return $next($request);
      });
      }
    function urlTokenizer($method){
      return $uri_method=str_replace(" ", '', lcfirst(ucwords(str_replace("-"," ",$method))));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(){
        if((session()->has('auth_token'))){
            Redirect::to('/')->send();
            }
        return view('admin.login');
      }
      function dashboard(){
        // echo $this->_user['role'];
        return view('admin.dashboard', $this->data);
      }
      function stripe(){
        // echo $this->_user['role'];
        $item=$this->mcommon->getsetting();
        if(!empty($item)) {
          $this->data['stripe_key']=$item->stripe_key;
          $this->data['stripe_secret']=$item->stripe_secret;
          }else{
            $this->data['stripe_key']="pk_test_51MniqoSH0POOrXjLmt6yGV27JbFYGqQM5RmK7qdVv7ed8JbSn6q3Tx9PVx7lqRB4VeiECT2Wg9UsC1eGlPyy9tGz00qtrFsdWM";
            $this->data['stripe_secret']="";
        }
        return view('admin.stripe', $this->data);
      }
      function setting(){
        $item=$this->mcommon->getsetting();
        if(!empty($item)) {
          $this->data['id']=$item->id;
          $this->data['type']=$item->type;
          $this->data['razorpay_key']=$item->razorpay_key;
          $this->data['razorpay_secret']=$item->razorpay_secret;
          $this->data['stripe_key']=$item->stripe_key;
          $this->data['stripe_secret']=$item->stripe_secret;
          $this->data['paypal_client_id']=$item->paypal_client_id;
          $this->data['paypal_secret']=$item->paypal_secret;
          $this->data['razorpay_option']=$item->razorpay_option;
          $this->data['stripe_option']=$item->stripe_option;
          $this->data['paypal_option']=$item->paypal_option;
          }else{
            $this->data['id']="";
            $this->data['type']="";
            $this->data['razorpay_key']="";
            $this->data['razorpay_secret']="";
            $this->data['stripe_key']="";
            $this->data['stripe_secret']="";
            $this->data['paypal_client_id']="";
            $this->data['paypal_secret']="";
            $this->data['razorpay_option']="";
            $this->data['stripe_option']="";
            $this->data['paypal_option']="";
        }

        return view('admin.setting', $this->data);
      }
      function email_setting(){
        $item=$this->mcommon->general_setting();
        if(!empty($item)) {
          $this->data['zepto_mail_url']=$item[0]->option_value;
          $this->data['zepto_from_mail']=$item[1]->option_value;
          $this->data['zepto_mail_bounce_address']=$item[2]->option_value;
          $this->data['zepto_mail_key']=$item[3]->option_value;
          $this->data['zepto_mail_name']=$item[4]->option_value;
          }else{
            $this->data['zepto_mail_url']="";
            $this->data['zepto_from_mail']="";
            $this->data['zepto_mail_bounce_address']="";
            $this->data['zepto_mail_key']="";
            $this->data['zepto_mail_name']="";
        }
        return view('admin.email_setting', $this->data);
      }
      function general_setting(){
        $item=$this->mcommon->general_setting();
        if(!empty($item)) {
          $this->data['site_name']=$item[5]->option_value;
          $this->data['site_description']=$item[6]->option_value;
          }else{
            $this->data['site_name']="";
            $this->data['site_description']="";
        }
        return view('admin.general_setting', $this->data);
      }
      function paypal(){
        return view('admin.paypal', $this->data);
      }
      function pdf(){
        return view('admin.pdf', $this->data);
      }

      function kanban(){
        return view('admin.kanban', $this->data);
      }

      function project(){
        return view('admin.project', $this->data);
      }

      function htmltopdf(){
        $data = [
          'name'         => 'John Doe',
          'address'      => 'USA',
          'price' => '5,400.00',
          'email'        => 'www.jawharajewellery.ae'
      ];
      $pdf = PDF::loadView('admin.invoice', $data);
      return $pdf->stream('invoice.pdf');
      }
      function form_validation(){
        return view('admin.form_validation', $this->data);
      }

      function api_details(){
        return view('admin.apidetails', $this->data);
      }

      function changelang(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();

      }
      function razorpay(){
        // echo $this->_user['role'];
        $item=$this->mcommon->getsetting();
        if(!empty($item)) {
          $key=$item->razorpay_key;
          $secret=$item->razorpay_secret;
          }else{
            $key="rzp_test_jayV1taNQTxS36";
            $secret="oyavzcFeDMHO6RvtzMsaVJph";
        }
        $price = 10 * 100;
        $currency = "INR";
        $order_id = "123";
        // $key = "rzp_test_jayV1taNQTxS36";
        // $secret = "oyavzcFeDMHO6RvtzMsaVJph";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "amount": ' . $price . ',
                "currency": "' . $currency . '",
                "receipt": "' . $order_id . '"

              }',
            CURLOPT_HTTPHEADER => array(
              "Authorization: Basic " . base64_encode($key . ":" . $secret),
              'Content-Type: application/json'
            ),
            //CURLOPT_HTTPHEADER, array('Content-Type:application/json','rzp_test_jayV1taNQTxS36','oyavzcFeDMHO6RvtzMsaVJph','Authorization: Basic cnpwX3Rlc3RfS1JoVXdadWQ5WFlXUlg6Q2hZdUNtOWdQc2NqanR5RGNtWUZRcWw3'),
        ));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
          $error_msg = curl_error($curl);
         // print_r($error_msg);
        }
        curl_close($curl);
        $res = json_decode($response);
       // print_r($res);

        $this->data['payment_id']=$res->id;

        return view('admin.razorpay', $this->data);
      }
     public function logout(Request $request)
    {
        //session_destroy();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
        //Redirect::to('/')->send();
    }




}
