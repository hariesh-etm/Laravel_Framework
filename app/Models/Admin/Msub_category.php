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

class Msub_category extends Model
{
  private $sub_category=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->sub_category = DB::table('sub_category');
  }
  public function getSub_categoryListGt($role, $status, $limit, $offset){
    $this->sub_category->select('*');
    $this->sub_category->selectRaw('COUNT(*) OVER() as total_size');
    $this->sub_category->orderBy('created_at', 'DESC');
    if($limit)
    $this->sub_category->limit($limit);
    if($offset)
    $this->sub_category->offset($offset);
    $item=$this->sub_category->get()->toArray();
    return $item;
  }

  public function getSub_categoryListDt($postData=null){
    $totalData =DB::table('sub_category')->where('status',"1")->count();
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
    $posts = DB::table('sub_category')
    ->where('status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('sub_category')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('category_id', 'LIKE',"%{$search}%")
						->orWhere('name', 'LIKE',"%{$search}%")
						->orWhere('slug', 'LIKE',"%{$search}%")

            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('sub_category')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('category_id', 'LIKE',"%{$search}%")
						->orWhere('name', 'LIKE',"%{$search}%")
						->orWhere('slug', 'LIKE',"%{$search}%")

            ->count();
    }
    $data = array();
    foreach($posts as $record ){

      $catrecords = DB::table('category')->where('id', $record->category_id)->first();
      if (empty($catrecords)) {
          $category_id = "-";
      } else {
          $category_id = $catrecords->name;
      }

      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->id),
				"id"=>$record->id,
				"category_id"=>$category_id,
				"name"=>$record->name,
				"slug"=>$record->slug,
				"serial"=>$record->serial,
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

  public function getSub_categoryListById($id){
    $this->sub_category->select('*');
    $this->sub_category->where('id', $id);
    $item=$this->sub_category->first();
    return $item;
  }

  public function createSub_category($category_id,$name,$slug,$serial,$created_by){
    $i_status='E';
    $this->sub_category->where('category_id', $category_id);
    $item=$this->sub_category->get()->first();
    if(empty($item)){
      $user_data=array(
        'category_id'      => $category_id,
				'name'      => $name,
				'slug'      => $slug,
				'serial'      => $serial,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->sub_category->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    return $i_status;
  }

  public function updateSub_category($id,$category_id,$name,$slug,$serial,$updated_by){
    $i_status='E';
    $this->sub_category->where('category_id', $category_id)->where('id','!=',$id);
    $item=$this->sub_category->get()->first();
    $this->sub_category = DB::table('sub_category');
    if(empty($item)){
      $user_data=array(
        'category_id'      => $category_id,
				'name'      => $name,
				'slug'      => $slug,
				'serial'      => $serial,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->sub_category->where('sub_category.id', $id);
      if($this->sub_category->update($user_data)){
        $i_status=$id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }

  public function deleteSub_category($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->sub_category->where('id', $id);
    return $this->sub_category->update($user_data);
  }

  public function getSubcategoryByCategory($id)
  {
    $this->sub_category->select('*');
    $this->sub_category->where('category_id', $id);
    $item=$this->sub_category->get();
    return $item;
  }

  public function getAllSubcategory()
  {
    $item = DB::table('sub_category')->where('status',1)->get();
    return $item;
  }
}
