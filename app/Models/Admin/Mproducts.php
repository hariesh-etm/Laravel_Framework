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

class Mproducts extends Model
{
  private $products=null;
  protected $db;
  private $helper;
  public function __construct(){
    $this->helper = new Helper();
    $this->products = DB::table('products');
  }
  public function getproductsListGt($role, $status, $limit, $offset){
    $this->products->select('*');
    $this->products->selectRaw('COUNT(*) OVER() as total_size');
    $this->products->orderBy('created_at', 'DESC');
    if($limit)
    $this->products->limit($limit);
    if($offset)
    $this->products->offset($offset);
    $item=$this->products->get()->toArray();
    return $item;
  }

  public function getproductsListDt($postData=null){
    $totalData =DB::table('products')->where('status',"1")->count();
    $totalFiltered = $totalData;
    $draw = $postData['draw'];
    $limit = $postData['length'];
    $start = $postData['start'];
    $order = $postData['order'][0]['column'];
    $dir = $postData['order'][0]['dir'];
    $column = $postData['columns'][$order]['data'];
    $searchValue = $postData['search']['value'];
    
    
    if($postData['columns'][0]['search']['value'] != "" || $postData['columns'][1]['search']['value'] != ""  || $postData['columns'][2]['search']['value'] != "" || $postData['columns'][3]['search']['value'] != "" || $postData['columns'][4]['search']['value'] != "" || $postData['columns'][5]['search']['value'] != "" || $postData['columns'][6]['search']['value'] != "" || $postData['columns'][7]['search']['value'] != "")
        {
            
          $id = $postData['columns'][0]['search']['value'];
          $product_name = $postData['columns'][1]['search']['value'];
          $product_desc = $postData['columns'][2]['search']['value'];
          $price = $postData['columns'][3]['search']['value'];
          $offer_price = $postData['columns'][4]['search']['value'];
          $category_id = $postData['columns'][5]['search']['value'];
          $sub_category_id = $postData['columns'][6]['search']['value'];
          $created_date = $postData['columns'][7]['search']['value'];
            $posts =  DB::table('products')
                    ->where('status',"1")
                    ->Where(function ($query)  use ($id) {
                        if(!empty($id)){ 
                        $query->where('id','LIKE',"%{$id}%"); 
                        }
                             
                    })
                    
                    ->Where(function ($query)  use ($product_name) {
                        if(!empty($product_name)){ 
                        $query->where('product_name','LIKE',"%{$product_name}%"); 
                        }
                             
                    })->Where(function ($query)  use ($product_desc) {
                        if(!empty($product_desc)){ 
                        $query->where('product_desc','LIKE',"%{$product_desc}%"); 
                        }
                             
                    })->Where(function ($query)  use ($price) {
                        if(!empty($price)){ 
                        $query->where('price','LIKE',"%{$price}%"); 
                        }
                             
                    })->Where(function ($query)  use ($offer_price) {
                        if(!empty($offer_price)){ 
                        $query->where('offer_price','LIKE',"%{$offer_price}%"); 
                        }
                             
                    })->Where(function ($query)  use ($category_id) {
                      if(!empty($category_id)){ 

                      $cat = DB::table('category')->where('status',"1")->where('name','LIKE',"%{$category_id}%")->get();

                      if(!empty($cat)){
                        $cats = array();
                        foreach($cat as $catrec){
                          array_push($cats,$catrec->id);
                        }
                      }
                      $query->whereIn('category_id',$cats); 
                      }
                           
                    })->Where(function ($query)  use ($sub_category_id) {
                        if(!empty($sub_category_id)){ 
                          $cat = DB::table('sub_category')->where('status',"1")->where('name','LIKE',"%{$sub_category_id}%")->get();
                          if(!empty($cat)){
                            $cats = array();
                            foreach($cat as $catrec){
                              array_push($cats,$catrec->id);
                            }
                          }
                          $query->whereIn('sub_category_id',$cats); 
                        
                        }
                             
                    })->Where(function ($query)  use ($created_date) {
                        if(!empty($created_date)){ 
                        $query->where('created_date','LIKE',"%{$created_date}%"); 
                        }
                             
                    })
                  
             

                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($column,$dir)
                    ->get();

            $totalFiltered = DB::table('products')
                   ->where('status',"1")
                   ->Where(function ($query)  use ($id) {
                    if(!empty($id)){ 
                    $query->where('id','LIKE',"%{$id}%"); 
                    }
                         
                })
                
                ->Where(function ($query)  use ($product_name) {
                    if(!empty($product_name)){ 
                    $query->where('product_name','LIKE',"%{$product_name}%"); 
                    }
                         
                })->Where(function ($query)  use ($product_desc) {
                    if(!empty($product_desc)){ 
                    $query->where('product_desc','LIKE',"%{$product_desc}%"); 
                    }
                         
                })->Where(function ($query)  use ($price) {
                    if(!empty($price)){ 
                    $query->where('price','LIKE',"%{$price}%"); 
                    }
                         
                })->Where(function ($query)  use ($offer_price) {
                    if(!empty($offer_price)){ 
                    $query->where('offer_price','LIKE',"%{$offer_price}%"); 
                    }
                         
                })->Where(function ($query)  use ($category_id) {
                  if(!empty($category_id)){ 

                  $cat = DB::table('category')->where('status',"1")->where('name','LIKE',"%{$category_id}%")->get();

                  if(!empty($cat)){
                    $cats = array();
                    foreach($cat as $catrec){
                      array_push($cats,$catrec->id);
                    }
                  }
                  $query->whereIn('category_id',$cats); 
                  }
                       
                })->Where(function ($query)  use ($sub_category_id) {
                    if(!empty($sub_category_id)){ 
                      $cat = DB::table('sub_category')->where('status',"1")->where('name','LIKE',"%{$sub_category_id}%")->get();
                      if(!empty($cat)){
                        $cats = array();
                        foreach($cat as $catrec){
                          array_push($cats,$catrec->id);
                        }
                      }
                      $query->whereIn('sub_category_id',$cats); 
                    
                    }
                         
                })
                
                ->Where(function ($query)  use ($created_date) {
                    if(!empty($created_date)){ 
                    $query->where('created_date','LIKE',"%{$created_date}%"); 
                    }
                         
                })
                 
                    ->count();
        
   }else if(empty($searchValue)){
    $posts = DB::table('products')
    ->where('status',"1")
        ->offset($start)
        ->limit($limit)
        ->orderBy($column,$dir)
        ->get();
    } else {
    $search = $searchValue;
    $posts =  DB::table('products')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('product_name', 'LIKE',"%{$search}%")
						->orWhere('product_desc', 'LIKE',"%{$search}%")
						->orWhere('price', 'LIKE',"%{$search}%")
						->orWhere('offer_price', 'LIKE',"%{$search}%")
						->orWhere('category_id', 'LIKE',"%{$search}%")
						->orWhere('sub_category_id', 'LIKE',"%{$search}%")
						->orWhere('image_url', 'LIKE',"%{$search}%")

            ->offset($start)
            ->limit($limit)
            ->orderBy($column,$dir)
            ->get();

    $totalFiltered = DB::table('products')
            ->where('status',"1")
            ->orWhere('id', 'LIKE',"%{$search}%")
						->orWhere('product_name', 'LIKE',"%{$search}%")
						->orWhere('product_desc', 'LIKE',"%{$search}%")
						->orWhere('price', 'LIKE',"%{$search}%")
						->orWhere('offer_price', 'LIKE',"%{$search}%")
						->orWhere('category_id', 'LIKE',"%{$search}%")
						->orWhere('sub_category_id', 'LIKE',"%{$search}%")
						->orWhere('image_url', 'LIKE',"%{$search}%")

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

      $subcatrecords = DB::table('sub_category')->where('id', $record->sub_category_id)->first();
      if (empty($subcatrecords)) {
          $sub_category_id = "-";
      } else {
          $sub_category_id = $subcatrecords->name;
      }

      $data[] = array(
        "list_id"=>$this->helper->encodeData($record->id),
				"id"=>$record->id,
				"product_name"=>$record->product_name,
				"product_desc"=>$record->product_desc,
				"price"=>$record->price,
				"offer_price"=>$record->offer_price,
				"category_id"=>$category_id,
				"sub_category_id"=>$sub_category_id,
				"image_url"=>$record->image_url,
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

  public function getproductsListById($id){
    $this->products->select('*');
    $this->products->where('id', $id);
    $item=$this->products->first();
    return $item;
  }

  public function createproducts($product_name,$product_desc,$price,$offer_price,$category_id,$sub_category_id,$image_url,$created_by){
    $i_status='E';
    $this->products->where('product_name', $product_name);
    $item=$this->products->get()->first();
    if(empty($item)){
      $user_data=array(
        'product_name'      => $product_name,
				'product_desc'      => $product_desc,
				'price'      => $price,
				'offer_price'      => $offer_price,
				'category_id'      => $category_id,
				'sub_category_id'      => $sub_category_id,
				'image_url'      => $image_url,
				'created_by'      => $created_by,
				'created_date'      =>date("Y-m-d H:i:s")
      );
      $user_id=$this->products->insertGetId($user_data);
      $i_status=$user_id;
    }else{
      $i_status='A';
    }
    return $i_status;
  }


  public function updateproducts($id,$product_name,$product_desc,$price,$offer_price,$category_id,$sub_category_id,$image_url,$updated_by){
    $i_status='E';
    $this->products->where('product_name', $product_name)->where('id','!=',$id);
    $item=$this->products->get()->first();
    $this->products = DB::table('products');
    if(empty($item)){
      $user_data=array(
        'product_name'      => $product_name,
				'product_desc'      => $product_desc,
				'price'      => $price,
				'offer_price'      => $offer_price,
				'category_id'      => $category_id,
				'sub_category_id'      => $sub_category_id,
				'image_url'      => $image_url,
				'updated_by'      => $updated_by,
				'updated_date'      =>date("Y-m-d H:i:s")
      );
      $this->products->where('products.id', $id);
      if($this->products->update($user_data)){
        $i_status=$id;
      }
    }else{
      $i_status=false;
    }
    return $i_status;
  }

  public function deleteproducts($id){
    $user_data=array(
      'status'    => 0,
    );
    $this->products->where('id', $id);
    return $this->products->update($user_data);
  }

  public function imageupload($image_url, $id){
    $user_data=array(
      'image_url'    => $image_url,
    );
    $this->products->where('id', $id);
    return $this->products->update($user_data);

  }
  public function getallproduct(){
    $records= $this->products->get();
     if(!empty($records)){
         return array('status'=>'S','record'=>$records);
     }else{
         return array('status'=>'E');
     }
  }
  public function getid($id){
     $getuser= $this->products->where('id',$id)->get();
      if(!empty($getuser)){
          return array('status'=>'S','record'=>$getuser);
      }else{
          return array('status'=>'E');
      }
   }

   public function getAllproducts(){
    $result= $this->products->where('status',1)->get();
    if(!empty($result)){
        return array('status'=>'S','record'=>$result);
    }else{
        return array('status'=>'E');
    }
   }
}
