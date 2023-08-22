<?php

namespace App\Models\Admin;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Helper;

class Mcommon extends Model
{
  use HasFactory, Notifiable;
  private $users=null;
  private $personal_info=null;
  private $contact_info=null;
  protected $db;
  private $users_tb;
  private $helper;
  public function __construct(){
    $this->users = DB::table('users');
    $this->helper = new Helper();
  }
  public function verifyUser($username, $password){
    $this->users->select('*');
    $this->users->where('username', $this->helper->encrypt($username));
    $this->users->where('password', $this->helper->encrypt($password));
    $this->users->where('active', 1);
    $item=$this->users->first();
    return $item;
  }

  public function verifygoogleUser($username, $password){
    $this->users->select('*');
    $this->users->where('username', $this->helper->encrypt($username));
    $this->users->where('password', $this->helper->encrypt($password));
    $this->users->where('active', 1);
    $item=$this->users->first();
    if(!empty($item)){
      return $item;
    }else{
    
      $user_data=array(
        'username'  => $this->helper->encrypt($username),
        'password'  => $this->helper->encrypt($password),
        'fullname'  => $username,
        'role'      => 2,
        'status'    => 1,
        'active'    => 1,
        'created_by'=> 0,
        'created_date'=>date("Y-m-d H:i:s")
      );
      $user_id= DB::table('users')->insertGetId($user_data);
      $item = DB::table('users')->where('username', $this->helper->encrypt($username))->where('password', $this->helper->encrypt($password))->first();
      return $item;
    }
  }

  public function createUsers(){
    $admin = "admin";
    $user = "user";
    $i_status='E';
    $this->users->where('username', $this->helper->encrypt($admin));
    $item=$this->users->get()->first();
    if(empty($item)){
      $user_data=array(
        'username'  => $this->helper->encrypt($admin),
        'password'  => $this->helper->encrypt($admin),
        'fullname'  => $admin,
        'role'      => 2,
        'status'    => 1,
        'active'    => 1,
        'created_by'=> 0,
        'creation_date'=>date("Y-m-d H:i:s")
      );
      $user_id=$this->users->insertGetId($user_data);
    }else{
      $i_status='A';
    }

    $this->users->where('username', $this->helper->encrypt($user));
    $item=$this->users->get()->first();
    if(empty($item)){
      $user_data=array(
        'username'  => $this->helper->encrypt($user),
        'password'  => $this->helper->encrypt($user),
        'fullname'  => $user,
        'role'      => 1,
        'status'    => 1,
        'active'    => 1,
        'created_by'=> 0,
        'creation_date'=>date("Y-m-d H:i:s")
      );
      $user_id=$this->users->insertGetId($user_data);
    }else{
      $i_status='A';
    }
    return $i_status;
  }

  public function getsetting(){
    $item = DB::table('payment_setting')->where('status',"1")->first();
    return $item;
  }
   public function general_setting(){
    $item = DB::table('options')->get()->toArray();
    return $item;
   }

  public function updatesetting($id,$type,$razorpay_key,$razorpay_secret,$stripe_key,$stripe_secret,$paypal_client_id,$paypal_secret,$updated_by,$paypal_option,$razorpay_option,$stripe_option){
    $user_data=array(
      'type'  => $type,
      'razorpay_key'  => $razorpay_key,
      'razorpay_secret'  => $razorpay_secret,
      'stripe_key'  => $stripe_key,
      'stripe_secret'  => $stripe_secret,
      'paypal_client_id'  => $paypal_client_id,
      'paypal_secret'  => $paypal_secret,
      'paypal_option'  => $paypal_option,
      'razorpay_option'  => $razorpay_option,
      'stripe_option'  => $stripe_option,
      'status'    => 1,
      'updated_by'=> $updated_by,
      'updated_date'=>date("Y-m-d H:i:s")
    );
    
    if($id == ""){
      if(DB::table('payment_setting')->insertGetId($user_data)){
        return array('status'=>'S');
      }else{
        return array('status'=>'E');
      }
    }else{
      if(DB::table('payment_setting')->where('id', $id)->update($user_data)){
        return array('status'=>'S');
      }else{
        return array('status'=>'E');
      }
    }
  }

  public function updateemailsetting($zepto_mail_url,$zepto_from_mail,$zepto_mail_bounce_address,$zepto_mail_key,$zepto_mail_name,$updated_by){
    DB::table('options')->where('option_key', "zepto_mail_url")->update(array('option_value'  => $zepto_mail_url));
    DB::table('options')->where('option_key', "zepto_from_mail")->update(array('option_value'  => $zepto_from_mail));
    DB::table('options')->where('option_key', "zepto_mail_bounce_address")->update(array('option_value'  => $zepto_mail_bounce_address));
    DB::table('options')->where('option_key', "zepto_mail_key")->update(array('option_value'  => $zepto_mail_key));
    $user_data=array(
      'option_value'  => $zepto_mail_name,
      'updated_by'=> $updated_by,
      'updated_date'=>date("Y-m-d H:i:s")
    );
    if(DB::table('options')->where('option_key', "zepto_mail_name")->update($user_data)){
      return array('status'=>'S');
    }else{
      return array('status'=>'E');
    }
  }

  public function updategeneralsetting($site_name,$site_description,$updated_by){
    DB::table('options')->where('option_key', "site_name")->update(array('option_value'  => $site_name));
    $user_data=array(
      'option_value'  => $site_description,
      'updated_by'=> $updated_by,
      'updated_date'=>date("Y-m-d H:i:s")
    );
    if(DB::table('options')->where('option_key', "site_description")->update($user_data)){
      return array('status'=>'S');
    }else{
      return array('status'=>'E');
    }
  }

  public function useractivity($user_id,$page_code,$ip_address){
    $user_data=array(
      'user_id'  => $user_id,
      'page_code'  => $page_code,
      'ip_address'  => $ip_address,
      'created_date_time'=>date("Y-m-d H:i:s")
    );
    if(DB::table('app_activity_log')->insertGetId($user_data)){
      return array('status'=>'S');
    }else{
      return array('status'=>'E');
    }
  }
  public function userlog($user_id,$page_code,$ip_address){
    $item = DB::table('app_open_close_log')->where('user_id',$user_id)->where('open_close_status',"1")->first();
    if(!empty($item)){

  
      $todate = date("Y-m-d H:i:s");
      $today = strtotime($todate);
      $fromdate = $item->opend_date_time;
      //$fromdate= strtotime($fromdate);
      $diff = abs(strtotime($fromdate) - strtotime($todate));
      $tmins = $diff/60;
      $hours = floor($tmins/60);
      $mins = $tmins%60;
      $total = $hours.".".$mins;
      //$total = round(abs($today-$fromdate)/60/60);
      $user_data=array(
        'user_id'  => $user_id,
        'close_page_code'  => $page_code,
        'ip_address'  => $ip_address,
        'open_close_status' => "0",
        'closed_date_time'=>$todate,
        'total_time'=>$total
      );
      if(DB::table('app_open_close_log')->where('id', $item->id)->update($user_data)){
        return array('status'=>'S');
      }else{
        return array('status'=>'E');
      }
    }else{
      $user_data=array(
        'user_id'  => $user_id,
        'open_page_code'  => $page_code,
        'ip_address'  => $ip_address,
        'open_close_status' => "1",
        'opend_date_time'=>date("Y-m-d H:i:s")
      );
      if(DB::table('app_open_close_log')->insertGetId($user_data)){
        return array('status'=>'S');
      }else{
        return array('status'=>'E');
      }
    }
  }
}
