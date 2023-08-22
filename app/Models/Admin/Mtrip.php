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

class Mtrip extends Model
{
  private $country=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->trip = DB::table('trip');
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

  public function getTripListDt($postData=null,$id){
    $totalData =DB::table('trip')->where('user_id',$id)->count();
    $totalFiltered = $totalData;
    $draw = $postData['draw'];
    $limit = $postData['length'];
    $start = $postData['start'];
    $order = $postData['order'][0]['column'];
    $dir = $postData['order'][0]['dir'];
    $column = $postData['columns'][$order]['data'];
    $searchValue = $postData['search']['value'];
    if($column == "0"){
      $column = "id";
    }
    if(empty($searchValue))
    {
    $posts = DB::table('trip')
    ->where('user_id',$id)
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('trip')
    ->where('user_id',$id)


            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('trip')
    ->where('user_id',$id)


            ->count();
    }
    $data = array();
    foreach($posts as $record ){
      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->id),
				"id"=>$record->id,
				"start_location"=>$record->start_location,
				"start_km"=>$record->start_km,
				"end_location"=>$record->end_location,
				"end_km"=>$record->end_km,
        "total_km"=>$record->total_km,
        "start_lat_long"=>$record->start_lat_long,
        "end_lat_long"=>$record->end_lat_long,
				"created_date"=> date("d-M-Y H:i A", strtotime($record->created_date)),
				"updated_date"=> date("d-M-Y H:i A", strtotime($record->updated_date))
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

  public function listTripById($id){
    $this->trip->select('*');
    $this->trip->where('id', $id);
    $item=$this->trip->first();
    return $item;
  }

  public function createTrip($start_km,$lang,$latt,$location,$created_by){
    $i_status='E';
    $this->trip->where('start_km', $start_km);
    $item=$this->trip->get()->first();
    if(empty($item)){
      $user_data=array(
                'user_id'   => $created_by,
                'start_km'  => $start_km,
                'start_lat_long'  => $latt.','.$lang,
				'start_location'      => $location,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->trip->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    // print_r($i_status);
    return $i_status;
  }

  public function updateTrip($id,$end_km,$lang,$latt,$location,$updated_by){
    $i_status='E';
    $this->trip->where('end_km', $end_km);
    $this->trip->where('user_id', $updated_by);
    $item=$this->trip->get()->first();
    $this->trip = DB::table('trip');
    if(empty($item)){
        $this->trip->where('id',$id);
        $data = $this->trip->get()->first();
        $start_km = $data->start_km;
        $total_km = $end_km - $start_km ;
      $user_data=array(
        'end_km'    => $end_km,
        'end_lat_long'  => $latt.','.$lang,
        'end_location'  => $location,
        'total_km'      => $total_km,
		'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->trip->where('trip.id', $id);
      if($this->trip->update($user_data)){
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
    $this->trip->where('id', $id);
    return $this->trip->update($user_data);
  }

public function getalltrip($id){
    $item = DB::table('trip')->where('user_id',$id)->get();
    return $item;
}

}
