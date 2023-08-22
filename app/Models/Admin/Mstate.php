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

class Mstate extends Model
{
  private $state=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->state = DB::table('state');
  }
  public function getStateListGt($role, $status, $limit, $offset){
    $this->state->select('*');
    $this->state->selectRaw('COUNT(*) OVER() as total_size');
    $this->state->orderBy('created_at', 'DESC');
    if($limit)
    $this->state->limit($limit);
    if($offset)
    $this->state->offset($offset);
    $item=$this->state->get()->toArray();
    return $item;
  }

  public function getStateListDt($postData=null){
    $totalData =DB::table('state')->where('status',"1")->count();
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
    $posts = DB::table('state')
    ->leftJoin('country','country.country_id','=','state.country_id')
    ->select('state.*','country.country_name')
    ->where('state.status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('state')
    ->leftJoin('country','country.country_id','=','state.country_id')
    ->select('state.*','country.country_name')
    ->where('state.status',"1")
            ->orWhere('state.state_id', 'LIKE',"%{$search}%")
            ->orWhere('state.state_name', 'LIKE',"%{$search}%")
            ->orWhere('country.country_name', 'LIKE',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('state')
    ->leftJoin('country','country.country_id','=','state.country_id')
    ->select('state.*','country.country_name')
    ->where('state.status',"1")
            ->orWhere('state_id', 'LIKE',"%{$search}%")

            ->count();
    }
    $data = array();
    foreach($posts as $record ){
      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->state_id),
				"state_id"=>$record->state_id,
				"state_name"=>$record->state_name,
				// "country_id"=>$record->country_id,
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

  public function getStateListById($id){
    $this->state->select('*');
    $this->state->where('state_id', $id);
    $item=$this->state->first();
    return $item;
  }

  public function createState($state_name,$country_id,$created_by){
    $i_status='E';
    $this->state->where('state_name', $state_name);
    $item=$this->state->get()->first();
    if(empty($item)){
      $user_data=array(
        'state_name'      => $state_name,
				'country_id'      => $country_id,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->state->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    return $i_status;
  }

  public function updateState($state_id,$state_name,$country_id,$updated_by){
    $i_status='E';
    $this->state->where('state_name', $state_name)->where('state_id','!=',$state_id);
    $item=$this->state->get()->first();
    $this->state = DB::table('state');
    if(empty($item)){
      $user_data=array(
        'state_name'      => $state_name,
				'country_id'      => $country_id,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->state->where('state.state_id', $state_id);
      if($this->state->update($user_data)){
        $i_status=$state_id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }

  public function deleteState($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->state->where('state_id', $id);
    return $this->state->update($user_data);
  }

  public function getAllState(){
    $item = DB::table('state')->where('status',1)->get();
    return $item;
  }

  public function getStateByCountry($id){
    $item = DB::table('state')->where('country_id',$id)->where('status',1)->get();
    return $item;
  }
}
