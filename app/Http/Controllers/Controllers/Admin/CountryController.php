<?php
namespace App\Http\Controllers\controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Mcountry;
use Session;
use Helper;
use Illuminate\Support\Facades\Redirect;

class CountryController extends Controller
{
    private $mcountry;
    private $data;
    private $method;
    private $helper;
    private $_user;
    public function __construct(){
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
    function manageCountry(){
      return view('admin.country.list_country', $this->data);
    }
    function addCountry(){
      return view('admin.country.add_country', $this->data);
    }
    function editCountry($key){
        $user_id=$this->helper->decodeData($key);
        $item=$this->mcountry->getCountryListById($user_id);
        if(!empty($item)) {
          $this->data['record']=$item;
          }else{
            $this->data['record']="";
        }
        return view('admin.country.update_country', $this->data);
    }
}
