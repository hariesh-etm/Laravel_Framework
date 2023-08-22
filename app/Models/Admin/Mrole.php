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

class Mrole extends Model
{
  private $role=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->role = DB::table('role');
  }
  public function getRoleListGt($role, $status, $limit, $offset){
    $this->role->select('*');
    $this->role->selectRaw('COUNT(*) OVER() as total_size');
    $this->role->orderBy('created_at', 'DESC');
    if($limit)
    $this->role->limit($limit);
    if($offset)
    $this->role->offset($offset);
    $item=$this->role->get()->toArray();
    return $item;
  }

  public function getRoleListDt($postData=null){
    $totalData =DB::table('role')->where('status',"1")->count();
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
    $posts = DB::table('role')
    ->where('status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('role')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('role_name', 'LIKE',"%{$search}%")

            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('role')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('role_name', 'LIKE',"%{$search}%")

            ->count();
    }
    $data = array();
    foreach($posts as $record ){
      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->id),
				"id"=>$record->id,
				"role_name"=>$record->role_name,
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

  public function getRoleListById($id){
    $this->role->select('*');
    $this->role->where('id', $id);
    $item=$this->role->first();
    return $item;
  }

  public function createRole($role_name,$created_by){
    $i_status='E';
    $this->role->where('role_name', $role_name);
    $item=$this->role->get()->first();
    if(empty($item)){
      $user_data=array(
        'role_name'      => $role_name,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->role->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    return $i_status;
  }

  public function updateRole($id,$role_name,$updated_by){
    $i_status='E';
    $this->role->where('role_name', $role_name)->where('id','!=',$id);
    $item=$this->role->get()->first();
    $this->role = DB::table('role');
    if(empty($item)){
      $user_data=array(
        'role_name'      => $role_name,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->role->where('role.id', $id);
      if($this->role->update($user_data)){
        $i_status=$id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }

  public function deleteRole($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->role->where('id', $id);
    return $this->role->update($user_data);
  }
  public function getAllRole()
  {
    $item = DB::table('role')->where('status',1)->get();
    return $item;
  }
}
