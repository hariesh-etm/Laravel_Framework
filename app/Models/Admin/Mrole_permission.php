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

class Mrole_permission extends Model
{
  private $role_permission=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->role_permission = DB::table('role_permission');
  }
  public function getRole_permissionListGt($role, $status, $limit, $offset){
    $this->role_permission->select('*');
    $this->role_permission->selectRaw('COUNT(*) OVER() as total_size');
    $this->role_permission->orderBy('created_at', 'DESC');
    if($limit)
    $this->role_permission->limit($limit);
    if($offset)
    $this->role_permission->offset($offset);
    $item=$this->role_permission->get()->toArray();
    return $item;
  }

  public function getRole_permissionListDt($postData=null){
    $totalData =DB::table('role_permission')->where('status',"1")->count();
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
    $posts = DB::table('role_permission')
    ->where('status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('role_permission')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('role_id', 'LIKE',"%{$search}%")
						
            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('role_permission')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('role_id', 'LIKE',"%{$search}%")
						
            ->count();
    }
    $data = array();
    foreach($posts as $record ){

      $records = DB::table('role')->where('id', $record->role_id)->first();
      if (empty($records)) {
          $role = "-";
      } else {
          $role = $records->role_name;
      }
      if($record->create_option == "1"){
        $create_option = "Yes";
      }else{
        $create_option = "No";
      }
      if($record->read_option == "1"){
        $read_option = "Yes";
      }else{
        $read_option = "No";
      }
      if($record->update_option == "1"){
        $update_option = "Yes";
      }else{
        $update_option = "No";
      }
      if($record->delete_option == "1"){
        $delete_option = "Yes";
      }else{
        $delete_option = "No";
      }

      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->id),
				"id"=>$record->id,
				"role_id"=>$role,
				"page_type"=>$record->page_type,
				"create_option"=>$create_option,
				"read_option"=>$read_option,
				"update_option"=>$update_option,
				"delete_option"=>$delete_option,
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

  public function getRole_permissionListById($id){
    $this->role_permission->select('*');
    $this->role_permission->where('id', $id);
    $item=$this->role_permission->first();
    return $item;
  }

  public function getAllRole_permission($role_id){
    $this->role_permission->select('*');
    $this->role_permission->where('role_id', $role_id);
    $this->role_permission->where('status', "1");
    $item=$this->role_permission->get()->toArray();
    return $item;
  }

  public function getrolepermission($role_id,$page_type){
    $this->role_permission->select('*');
    $this->role_permission->where('role_id', $role_id);
    $this->role_permission->where('page_type', $page_type);
    $this->role_permission->where('status', "1");
    $item=$this->role_permission->first();
    return $item;
  }

  public function createRole_permission($role_id,$page_type,$create_option,$read_option,$update_option,$delete_option,$created_by){
    $i_status='E';
    $this->role_permission->where('role_id', $role_id);
    $this->role_permission->where('page_type', $page_type);
    $item=$this->role_permission->get()->first();
    if(empty($item)){
      $user_data=array(
        'role_id'      => $role_id,
				'page_type'      => $page_type,
				'create_option'      => $create_option,
				'read_option'      => $read_option,
				'update_option'      => $update_option,
				'delete_option'      => $delete_option,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->role_permission->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    return $i_status;
  }

  public function updateRole_permission($id,$role_id,$page_type,$create_option,$read_option,$update_option,$delete_option,$updated_by){
    $i_status='E';
    $this->role_permission->where('role_id', $role_id)->where('id','!=',$id);
    $this->role_permission->where('page_type', $page_type);
    $item=$this->role_permission->get()->first();
    $this->role_permission = DB::table('role_permission');
    if(empty($item)){
      $user_data=array(
        'role_id'      => $role_id,
				'page_type'      => $page_type,
				'create_option'      => $create_option,
				'read_option'      => $read_option,
				'update_option'      => $update_option,
				'delete_option'      => $delete_option,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->role_permission->where('role_permission.id', $id);
      if($this->role_permission->update($user_data)){
        $i_status=$id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }
  
  public function deleteRole_permission($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->role_permission->where('id', $id);
    return $this->role_permission->update($user_data);
  }
}
