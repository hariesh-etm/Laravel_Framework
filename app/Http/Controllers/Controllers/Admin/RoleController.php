<?php
namespace App\Http\Controllers\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Mrole;
use Session;
use Helper;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    private $mrole;
    private $data;
    private $method;
    private $helper;
    private $_user;
    public function __construct(){
      $this->mrole = new Mrole;
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
           if($this->_user['role']!="2"){
            Redirect::to('login')->send();
           }
          }
        return $next($request);
      });
      }
    function urlTokenizer($method){
      return $uri_method=str_replace(" ", '', lcfirst(ucwords(str_replace("-"," ",$method))));
    }
    function manageRole(){
      return view('admin.role.list_role', $this->data);
    }
    function addRole(){
      return view('admin.role.add_role', $this->data);
    }
    function editRole($key){
        $user_id=$this->helper->decodeData($key);
        $item=$this->mrole->getRoleListById($user_id);
        if(!empty($item)) {
          $this->data['record']=$item;
          }else{
            $this->data['record']="";
        }
        return view('admin.role.update_role', $this->data);
    }
}
