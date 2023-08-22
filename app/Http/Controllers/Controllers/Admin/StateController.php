<?php
namespace App\Http\Controllers\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Mstate;
use App\Models\Admin\Mcountry;
use Session;
use Helper;
use Illuminate\Support\Facades\Redirect;

class StateController extends Controller
{
    private $mstate;
    private $data;
    private $method;
    private $helper;
    private $_user;
    public function __construct(){
      $this->mstate = new Mstate;
      $this->mcountry = new Mcountry;
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
    function manageState(){
        $country = $this->mcountry->getAllcountry();
        $this->data['country'] = $country;
      return view('admin.state.list_state', $this->data);
    }
    function addState(){
        $country = $this->mcountry->getAllcountry();
        $this->data['country'] = $country;
      return view('admin.state.add_state', $this->data);
    }
    function editState($key){
        $user_id=$this->helper->decodeData($key);
        $country = $this->mcountry->getAllcountry();
        $this->data['country'] = $country;
        $item=$this->mstate->getStateListById($user_id);
        if(!empty($item)) {
          $this->data['record']=$item;
          }else{
            $this->data['record']="";
        }
        return view('admin.state.update_state', $this->data);
    }
}
