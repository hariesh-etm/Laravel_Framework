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

class Mcountry extends Model
{
  private $country=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->country = DB::table('country');
  }
  public function getCountryListGt($role, $status, $limit, $offset){
    $this->country->select('*');
    $this->country->selectRaw('COUNT(*) OVER() as total_size');
    $this->country->orderBy('created_at', 'DESC');
    if($limit)
    $this->country->limit($limit);
    if($offset)
    $this->country->offset($offset);
    $item=$this->country->get()->toArray();
    return $item;
  }

  public function getCountryListDt($postData=null){
    $totalData =DB::table('country')->where('status',"1")->count();
    $totalFiltered = $totalData;
    $draw = $postData['draw'];
    $limit = $postData['length'];
    $start = $postData['start'];
    $order = $postData['order'][0]['column'];
    $dir = $postData['order'][0]['dir'];
    $column = $postData['columns'][$order]['data'];
    $searchValue = $postData['search']['value'];
    if(empty($searchValue))
    {
    $posts = DB::table('country')
    ->where('status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('country')
            ->where('status',"1")
            ->orWhere('country_id', 'LIKE',"%{$search}%")

            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('country')
            ->where('status',"1")
            ->orWhere('country_id', 'LIKE',"%{$search}%")

            ->count();
    }
    $data = array();
    foreach($posts as $record ){
      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->country_id),
				"country_id"=>$record->country_id,
				"country_name"=>$record->country_name,
				"iso3"=>$record->iso3,
				"iso2"=>$record->iso2,
				"numeric_code"=>$record->numeric_code,
				"phone_code"=>$record->phone_code,
				"capital"=>$record->capital,
				"currency"=>$record->currency,
				"currency_name"=>$record->currency_name,
				"currency_symbol"=>$record->currency_symbol,
				"tld"=>$record->tld,
				"is_active"=>$record->is_active,
				"created_date"=> date("d-M-Y H:i A", strtotime($record->created_date))
      );
    }
    $json_data = array(
    "draw"            => intval($draw),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
    );
    echo json_encode($json_data);
  }

  public function getCountryListById($id){
    $this->country->select('*');
    $this->country->where('country_id', $id);
    $item=$this->country->first();
    return $item;
  }

  public function createCountry($country_name,$phone_code,$capital,$currency_name,$currency_symbol,$tld,$is_active,$created_by){
    $i_status='E';
    $this->country->where('country_name', $country_name);
    $item=$this->country->get()->first();
    if(empty($item)){
      $user_data=array(
        'country_name'      => $country_name,
				'phone_code'      => $phone_code,
				'capital'      => $capital,
				'currency_name'      => $currency_name,
				'currency_symbol'      => $currency_symbol,
				'tld'      => $tld,
				'is_active'      => $is_active,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->country->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    return $i_status;
  }

  public function updateCountry($country_id,$country_name,$phone_code,$capital,$currency_name,$currency_symbol,$tld,$is_active,$updated_by){
    $i_status='E';
    $this->country->where('country_name', $country_name)->where('country_id','!=',$country_id);
    $item=$this->country->get()->first();
    $this->country = DB::table('country');
    if(empty($item)){
      $user_data=array(
        'country_name'      => $country_name,
				'phone_code'      => $phone_code,
				'capital'      => $capital,
				'currency_name'      => $currency_name,
				'currency_symbol'      => $currency_symbol,
				'tld'      => $tld,
				'is_active'      => $is_active,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->country->where('country.country_id', $country_id);
      if($this->country->update($user_data)){
        $i_status=$country_id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }

  public function deleteCountry($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->country->where('country_id', $id);
    return $this->country->update($user_data);
  }

public function getAllcountry(){
    $item = DB::table('country')->where('status',1)->get();
    return $item;
}

}
