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

class Mpayment extends Model
{
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
  }

  public function savepaymentresponse($body,$type){

      $user_data=array(
        'body'  => $body,
        'type' => $type,
				'created_date'  =>date("Y-m-d H:i:s")
      );
      $user_id=DB::table('payment_response_webhook')->insertGetId($user_data);
    return $user_id;
  }

  public function saveTransaction($order_id,$status,$type,$amount,$trn_id)
{
    $val = array(
        'order_id' => $order_id,
        'amount' => $amount,
        'type' => $type,
        'transaction_id' => $trn_id,
        'status' => $status
    );
    $item=DB::table('order_transaction')->insertGetId($val);
  return $item;
}



}
