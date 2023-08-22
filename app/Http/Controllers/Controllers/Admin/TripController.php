<?php
namespace App\Http\Controllers\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Mrole_permission;
use App\Models\Admin\Mrole;
use Session;
use Helper;
use Illuminate\Support\Facades\Redirect;

class TripController extends Controller
{
    private $mrole_permission;
    private $mrole;
    private $data;
    private $method;
    private $helper;
    private $_user;
    public function __construct(){
      $this->mrole_permission = new Mrole_permission;
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
          }
        return $next($request);
      });
      }
    function urlTokenizer($method){
      return $uri_method=str_replace(" ", '', lcfirst(ucwords(str_replace("-"," ",$method))));
    }
    function manage_trip(){

      return view('admin.trip.list_trip', $this->data);
    }



}
