<?php
namespace App\Http\Controllers\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Mcountry;
use App\Models\Admin\Mstate;
use App\Models\Admin\Mcity;
use Session;
use Helper;
use Illuminate\Support\Facades\Redirect;

class CityController extends Controller
{
    private $mcity;
    private $data;
    private $method;
    private $helper;
    private $_user;
    public function __construct(){
      $this->mcountry = new Mcountry;
      $this->mstate = new Mstate;
      $this->mcity = new Mcity;
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
    function manageCity(){
        $country = $this->mcountry->getAllcountry();
        $this->data['country'] = $country;
        $state = $this->mstate->getAllstate();
        $this->data['state'] = $state;
      return view('admin.city.list_city', $this->data);
    }
    function addCity(){
        $country = $this->mcountry->getAllcountry();
        $this->data['country'] = $country;
        $state = $this->mstate->getAllstate();
        $this->data['state'] = $state;
      return view('admin.city.add_city', $this->data);
    }
    function editCity($key){
        $user_id=$this->helper->decodeData($key);
        $country = $this->mcountry->getAllcountry();
        $this->data['country'] = $country;
        $state = $this->mstate->getAllstate();
        $this->data['state'] = $state;
        $item=$this->mcity->getCityListById($user_id);
        if(!empty($item)) {
          $this->data['record']=$item;
          }else{
            $this->data['record']="";
        }
        return view('admin.city.update_city', $this->data);
    }
}
