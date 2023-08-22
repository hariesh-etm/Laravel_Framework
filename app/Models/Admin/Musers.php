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

class Musers extends Model
{
  private $users=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->users = DB::table('users');
  }
  public function getUsersListGt($role, $status, $limit, $offset){
    $this->users->select('*');
    $this->users->selectRaw('COUNT(*) OVER() as total_size');
    $this->users->orderBy('created_at', 'DESC');
    if($limit)
    $this->users->limit($limit);
    if($offset)
    $this->users->offset($offset);
    $item=$this->users->get()->toArray();
    return $item;
  }

  public function getUsersListDt($postData=null){
    $totalData =DB::table('users')->where('status',"1")->count();
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
    $posts = DB::table('users')
    ->where('status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('users')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('fullname', 'LIKE',"%{$search}%")
						->orWhere('email', 'LIKE',"%{$search}%")
						->orWhere('mobile', 'LIKE',"%{$search}%")

            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('users')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('fullname', 'LIKE',"%{$search}%")
						->orWhere('email', 'LIKE',"%{$search}%")
						->orWhere('mobile', 'LIKE',"%{$search}%")

            ->count();
    }
    $data = array();
    foreach($posts as $record ){

      $rolerecords = DB::table('role')->where('id', $record->role)->first();
            if (empty($rolerecords)) {
                $role = "-";
            } else {
                $role = $rolerecords->role_name;
            }

      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->id),
				"id"=>$record->id,
				"username"=>$record->username,
				"password"=>$record->password,
				"fullname"=>$record->fullname,
				"email"=>$record->email,
				"mobile"=>$record->mobile,
				"role"=>$role,
				"active"=>$record->active,
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

  public function getUsersListById($id){
    $this->users->select('*');
    $this->users->where('id', $id);
    $item=$this->users->first();
    return $item;
  }

  public function createUsers($username,$password,$fullname,$email,$mobile,$role,$active,$created_by){
    $i_status='E';
    $this->users->where('username', $this->helper->encrypt($username));
    $item=$this->users->get()->first();
    if(empty($item)){
      $user_data=array(
        'username'      => $this->helper->encrypt($username),
        'password'      => $this->helper->encrypt($password),
				'fullname'      => $fullname,
				'email'      => $email,
				'mobile'      => $mobile,
				'role'      => $role,
				'active'      => $active,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->users->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    return $i_status;
  }

  public function updateUsers($id,$username,$password,$fullname,$email,$mobile,$role,$active,$updated_by){
    $i_status='E';
    $this->users->where('username', $this->helper->encrypt($username))->where('id','!=',$id);
    $item=$this->users->get()->first();
    $this->users = DB::table('users');
    if(empty($item)){
      $user_data=array(
        'username'      => $this->helper->encrypt($username),
				'password'      => $this->helper->encrypt($password),
				'fullname'      => $fullname,
				'email'      => $email,
				'mobile'      => $mobile,
				'role'      => $role,
				'active'      => $active,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->users->where('users.id', $id);
      if($this->users->update($user_data)){
        $i_status=$id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }

  public function deleteUsers($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->users->where('id', $id);
    return $this->users->update($user_data);
  }
}
