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

class Mcity extends Model
{
  private $city=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->city = DB::table('city');
  }
  public function getCityListGt($role, $status, $limit, $offset){
    $this->city->select('*');
    $this->city->selectRaw('COUNT(*) OVER() as total_size');
    $this->city->orderBy('created_at', 'DESC');
    if($limit)
    $this->city->limit($limit);
    if($offset)
    $this->city->offset($offset);
    $item=$this->city->get()->toArray();
    return $item;
  }

  public function getCityListDt($postData=null){
    $totalData =DB::table('city')->where('status',"1")->count();
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
    $posts = DB::table('city')
    ->leftJoin('country','country.country_id','=','city.country_id')
    ->leftJoin('state','state.state_id','=','city.state_id')
    ->select('city.*','country.country_name','state.state_name')
    ->where('city.status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('city')
    ->leftJoin('country','country.country_id','=','city.country_id')
    ->leftJoin('state','state.state_id','=','city.state_id')
    ->select('city.*','country.country_name','state.state_name')
    ->where('city.status',"1")
            ->orWhere('city_id', 'LIKE',"%{$search}%")

            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('city')
    ->leftJoin('country','country.country_id','=','city.country_id')
    ->leftJoin('state','state.state_id','=','city.state_id')
    ->select('city.*','country.country_name','state.state_name')
    ->where('city.status',"1")
            ->orWhere('city_id', 'LIKE',"%{$search}%")

            ->count();
    }
    $data = array();
    foreach($posts as $record ){
      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->city_id),
				"city_id"=>$record->city_id,
				"city_name"=>$record->city_name,
				"state_name"=>$record->state_name,
				"country_name"=>$record->country_name,
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

  public function getCityListById($id){
    $this->city->select('*');
    $this->city->where('city_id', $id);
    $item=$this->city->first();
    return $item;
  }

  public function createCity($city_name,$state_id,$country_id,$created_by){
    $i_status='E';
    $this->city->where('city_name', $city_name);
    $item=$this->city->get()->first();
    if(empty($item)){
      $user_data=array(
        'city_name'      => $city_name,
				'state_id'      => $state_id,
				'country_id'      => $country_id,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->city->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    return $i_status;
  }

  public function updateCity($city_id,$city_name,$state_id,$country_id,$updated_by){
    $i_status='E';
    $this->city->where('city_name', $city_name)->where('city_id','!=',$city_id);
    $item=$this->city->get()->first();
    $this->city = DB::table('city');
    if(empty($item)){
      $user_data=array(
        'city_name'      => $city_name,
				'state_id'      => $state_id,
				'country_id'      => $country_id,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->city->where('city.city_id', $city_id);
      if($this->city->update($user_data)){
        $i_status=$city_id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }

  public function deleteCity($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->city->where('city_id', $id);
    return $this->city->update($user_data);
  }
}
