<?php
namespace App\Http\Controllers\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Msub_category;
use App\Models\Admin\Mcategory;

use Session;
use Helper;
use Illuminate\Support\Facades\Redirect;

class Sub_categoryController extends Controller
{
    private $msub_category;
    private $mcategory;
    private $data;
    private $method;
    private $helper;
    private $_user;
    public function __construct(){
      $this->msub_category = new Msub_category;
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
    function manageSub_category(){
        $category=$this->mcategory->getAllcategory();
        if(!empty($category)) {
            $this->data['category']=$category;
            }else{
              $this->data['category']="";
          }
      return view('admin.sub_category.list_sub_category', $this->data);
    }
    function addSub_category(){
      return view('admin.sub_category.add_sub_category', $this->data);
    }
    function editSub_category($key){
        $user_id=$this->helper->decodeData($key);
        $item=$this->msub_category->getSub_categoryListById($user_id);
        if(!empty($item)) {
          $this->data['record']=$item;
          }else{
            $this->data['record']="";
        }
        return view('admin.sub_category.update_sub_category', $this->data);
    }
}
