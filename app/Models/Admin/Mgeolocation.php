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

class Mgeolocation extends Model
{
  private $country=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->geo_location = DB::table('geo_location');
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

  public function getGeolocationListDt($postData=null){
    $totalData =DB::table('geo_location')->where('status',"1")->count();
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
    $posts = DB::table('geo_location')
    ->where('status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('geo_location')
            ->where('status',"1")
            ->orWhere('country_id', 'LIKE',"%{$search}%")

            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('geo_location')
            ->where('status',"1")
            ->orWhere('country_id', 'LIKE',"%{$search}%")

            ->count();
    }
    $data = array();
    foreach($posts as $record ){
      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->id),
				"id"=>$record->id,
				"lang"=>$record->lang,
				"latt"=>$record->latt,
				"resp"=>$record->resp,
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

  public function listGeolocationById($id){
    $this->geo_location->select('*');
    $this->geo_location->where('id', $id);
    $item=$this->geo_location->first();
    return $item;
  }

  public function createGeolocation($lang,$latt,$apiResult,$created_by,$web){
    $i_status='E';
    $this->geo_location->where('lang', $lang);
    $this->geo_location->where('latt', $latt);
    $item=$this->geo_location->get()->first();
    if(empty($item)){
      $user_data=array(
                'latt'      => $latt,
				'lang'      => $lang,
				'resp'      => $apiResult,
                'status'    => '1',
                'web'       => $web,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->geo_location->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    // print_r($i_status);
    return $i_status;
  }

  public function updateGeolocation($id,$lang,$latt,$apiResult,$updated_by){
    $i_status='E';
    $this->geo_location->where('lang', $lang);
    $this->geo_location->where('latt', $latt);
    $item=$this->geo_location->get()->first();
    $this->country = DB::table('geo_location');
    if(empty($item)){
      $user_data=array(
        'latt'      => $latt,
        'lang'      => $lang,
        'resp'      => $apiResult,
        'status'    => '1',
        'web'       => $web,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->geo_location->where('geo_location.id', $id);
      if($this->geo_location->update($user_data)){
        $i_status=$id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }

  public function deleteGeolocation($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->geo_location->where('id', $id);
    return $this->geo_location->update($user_data);
  }

public function getAllcountry(){
    $item = DB::table('country')->where('status',1)->get();
    return $item;
}

}
