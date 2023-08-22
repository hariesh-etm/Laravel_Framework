<?php
namespace App\Http\Controllers\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Mproducts;
use App\Models\Admin\Msub_category;
use App\Models\Admin\Mcategory;
use App\Models\Admin\Mrole_permission;
use Session;
use Helper;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    private $mrole_permission;
    private $mproducts;
    private $data;
    private $method;
    private $helper;
    private $_user;
    public function __construct(){
      $this->mproducts = new Mproducts;
      $this->msub_category = new Msub_category;
      $this->mcategory = new Mcategory;
      $this->mrole_permission = new Mrole_permission;
      $this->data=array();
      $this->_user = array();
      $this->helper = new Helper();
      $url = Route::getCurrentRoute()->getActionName();
      $res = explode("@",$url);
      $this->method = $this->urlTokenizer($res[1]);
      $this->middleware(function ($request, $next) {
        if((!session()->has('auth_token')) && $this->method != "login"){
          Redirect::to('login')->send();
          }
          if(session()->has('auth_token'))
          {
           $this->_user = $this->helper->getAuthentication();
           //print_r($this->_user);
            $role_id = $this->_user['role'];
            $rolerec=$this->mrole_permission->getrolepermission($role_id,"products");
            if(!empty($rolerec)) {
                $this->data['permission']=$rolerec;
                if($rolerec->read_option == "0"){
                  Redirect::to('/')->send();
                }
              }else{
                  $this->data['permission']="";
              }
          }
        return $next($request);
      });
      
      }
    function urlTokenizer($method){
      return $uri_method=str_replace(" ", '', lcfirst(ucwords(str_replace("-"," ",$method))));
    }
    function manageproductslist(){
        $category=$this->mcategory->getAllcategory();
        if(!empty($category)) {
            $this->data['category']=$category;
            }else{
              $this->data['category']="";
          }
          $sub_category=$this->msub_category->getAllSubcategory();
        if(!empty($sub_category)) {
            $this->data['sub_category']=$sub_category;
            }else{
              $this->data['sub_category']="";
          }
      return view('admin.products.list_products', $this->data);
    }

    function manageproductsgrid(){
        $category=$this->mcategory->getAllcategory();
        if(!empty($category)) {
            $this->data['category']=$category;
            }else{
              $this->data['category']="";
          }
          $sub_category=$this->msub_category->getAllSubcategory();
        if(!empty($sub_category)) {
            $this->data['sub_category']=$sub_category;
            }else{
              $this->data['sub_category']="";
          }
      return view('admin.products.grid_products', $this->data);
    }

    function products(){
      $item=$this->mproducts->getallproduct();
      if($item['status']=="S") {
        $this->data['products'] = $item['record'];
      }else{
        $this->data['products'] ="";
      }
      return view('front.productslist', $this->data);
      }
      

      function viewproducts($key){
        $product_id=$this->helper->decodeData($key);
        $item=$this->mproducts->getproductsListById($product_id);
        if(!empty($item)) {
          $this->data['record']=$item;
          }else{
            $this->data['record']="";
        }
        return view('admin.products.viewproduct', $this->data);
    }

  }


