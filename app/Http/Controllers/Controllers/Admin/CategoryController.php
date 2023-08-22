<?php
namespace App\Http\Controllers\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Mcategory;
use Session;
use Helper;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    private $mcategory;
    private $data;
    private $method;
    private $helper;
    private $_user;
    public function __construct(){
      $this->mcategory = new Mcategory;
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
          }
        return $next($request);
      });
      }
    function urlTokenizer($method){
      return $uri_method=str_replace(" ", '', lcfirst(ucwords(str_replace("-"," ",$method))));
    }
    function manageCategory(){
      return view('admin.category.list_category', $this->data);
    }
    function addCategory(){
      return view('admin.category.add_category', $this->data);
    }
    function editCategory($key){
        $user_id=$this->helper->decodeData($key);
        $item=$this->mcategory->getCategoryListById($user_id);
        if(!empty($item)) {
          $this->data['record']=$item;
          }else{
            $this->data['record']="";
        }
        return view('admin.category.update_category', $this->data);
    }
}
