<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Api\V1\Role;
use App\Http\Controllers\Api\V1\Users;
use App\Http\Controllers\Api\V1\Country;
use App\Http\Controllers\Api\V1\State;
use App\Http\Controllers\Api\V1\City;
use App\Http\Controllers\Api\V1\Category;
use App\Http\Controllers\Api\V1\Sub_category;
use App\Http\Controllers\Api\V1\Products;
use App\Http\Controllers\Api\V1\Payment;
use App\Http\Controllers\Api\V1\Paypal;
use App\Http\Controllers\Api\V1\Role_permission;
use App\Http\Controllers\Api\V1\Geolocation;
use App\Http\Controllers\Api\V1\Trip;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::apiResource('users', UserController::class);

Route::Post('v1/login', [Admin::class, 'login']);
Route::Post('v1/googlelogin', [Admin::class, 'googlelogin']);
Route::Get('v1/generateuser', [Admin::class, 'generateuser']);
Route::Post('v1/admin/form-valid', [Admin::class, 'formvalid']);
Route::Post('v1/updatesetting', [Admin::class, 'updatesetting']);
Route::Post('v1/updateemailsetting', [Admin::class, 'updateemailsetting']);
Route::Post('v1/updategeneralsetting', [Admin::class, 'updategeneralsetting']);
Route::Post('v1/stripe', [Payment::class, 'stripe']);
Route::Post('v1/razorpay', [Payment::class, 'razorpay']);
Route::Post('v1/stripepayment', [Payment::class, 'stripepayment']);
Route::POST('v1/paypal', [Paypal::class, 'paypal']);
Route::Post('v1/userlog', [Admin::class, 'userlog']);
Route::Post('v1/useractivity', [Admin::class, 'useractivity']);


Route::get('v1/role/list-roledt', [Role::class, 'listRoledt']);
Route::post('v1/role/create-role', [Role::class, 'createRole']);
Route::post('v1/role/update-role', [Role::class, 'updateRole']);
Route::delete('v1/role/delete-role', [Role::class, 'deleteRole']);
Route::get('v1/role/get-roledt', [Role::class, 'listRoleById']);


Route::get('v1/users/list-usersdt', [Users::class, 'listUsersdt']);
Route::post('v1/users/create-users', [Users::class, 'createUsers']);
Route::post('v1/users/update-users', [Users::class, 'updateUsers']);
Route::delete('v1/users/delete-users', [Users::class, 'deleteUsers']);
Route::get('v1/users/get-usersdt', [Users::class, 'listUsersById']);


Route::get('v1/country/list-countrydt', [Country::class, 'listCountrydt']);
Route::post('v1/country/create-country', [Country::class, 'createCountry']);
Route::post('v1/country/update-country', [Country::class, 'updateCountry']);
Route::delete('v1/country/delete-country', [Country::class, 'deleteCountry']);
Route::get('v1/country/get-countrydt', [Country::class, 'listCountryById']);



Route::get('v1/state/list-statedt', [State::class, 'listStatedt']);
Route::post('v1/state/create-state', [State::class, 'createState']);
Route::post('v1/state/update-state', [State::class, 'updateState']);
Route::delete('v1/state/delete-state', [State::class, 'deleteState']);
Route::get('v1/state/getStateByCountry', [State::class, 'getStateByCountry']);
Route::get('v1/state/get-statedt', [State::class, 'listStateById']);

Route::get('v1/city/list-citydt', [City::class, 'listCitydt']);
Route::post('v1/city/create-city', [City::class, 'createCity']);
Route::post('v1/city/update-city', [City::class, 'updateCity']);
Route::delete('v1/city/delete-city', [City::class, 'deleteCity']);
Route::get('v1/city/get-citydt', [City::class, 'listCityById']);

Route::get('v1/category/list-categorydt', [Category::class, 'listCategorydt']);
Route::post('v1/category/create-category', [Category::class, 'createCategory']);
Route::post('v1/category/update-category', [Category::class, 'updateCategory']);
Route::delete('v1/category/delete-category', [Category::class, 'deleteCategory']);
Route::get('v1/category/get-categorydt', [Category::class, 'listCategoryById']);


Route::get('v1/sub_category/list-sub_categorydt', [Sub_category::class, 'listSub_categorydt']);
Route::post('v1/sub_category/create-sub_category', [Sub_category::class, 'createSub_category']);
Route::post('v1/sub_category/update-sub_category', [Sub_category::class, 'updateSub_category']);
Route::delete('v1/sub_category/delete-sub_category', [Sub_category::class, 'deleteSub_category']);
Route::get('v1/sub_category/get-sub_categorydt', [Sub_category::class, 'listSub_categoryById']);
Route::get('v1/sub_category/getSubcategoryByCategory', [Sub_category::class, 'getSubcategoryByCategory']);


Route::get('v1/products/list-productsdt', [Products::class, 'listproductsdt']);
Route::get('v1/products/get-allproductsdt', [Products::class, 'getAllProducts']);
Route::post('v1/products/create-products', [Products::class, 'createproducts']);
Route::post('v1/products/update-products', [Products::class, 'updateproducts']);
Route::delete('v1/products/delete-products', [Products::class, 'deleteproducts']);
Route::get('v1/role/get-productsdt', [Products::class, 'listproductsById']);

Route::get('v1/role_permission/list-role_permissiondt', [Role_permission::class, 'listRole_permissiondt']);
Route::post('v1/role_permission/create-role_permission', [Role_permission::class, 'createRole_permission']);
Route::post('v1/role_permission/update-role_permission', [Role_permission::class, 'updateRole_permission']);
Route::delete('v1/role_permission/delete-role_permission', [Role_permission::class, 'deleteRole_permission']);
Route::get('v1/role_permission/list-role_permission-ById', [Role_permission::class, 'listRole_permissionById']);

Route::get('v1/geolocation/list-geolocationdt', [Geolocation::class, 'listGeolocationdt']);
Route::post('v1/geolocation/create-geolocation', [Geolocation::class, 'createGeolocation']);
Route::post('v1/geolocation/update-geolocation', [Geolocation::class, 'updateGeolocation']);
Route::delete('v1/geolocation/delete-geolocation', [Geolocation::class, 'deleteGeolocation']);
Route::get('v1/geolocation/get-geolocationdt', [Geolocation::class, 'listGeolocationById']);

Route::get('v1/geolocation/list-geolocationdt-google', [Geolocation::class, 'listGeolocationdt_google']);
Route::post('v1/geolocation/create-geolocation-google', [Geolocation::class, 'createGeolocation_google']);
Route::post('v1/geolocation/update-geolocation-google', [Geolocation::class, 'updateGeolocation_google']);
Route::delete('v1/geolocation/delete-geolocation-google', [Geolocation::class, 'deleteGeolocation_google']);
Route::get('v1/geolocation/get-geolocationdt-google', [Geolocation::class, 'listGeolocationById_google']);

Route::get('v1/trip/get-location', [Trip::class, 'getLocation']);
Route::get('v1/trip/list-tripdt', [Trip::class, 'listTripdt']);
Route::post('v1/trip/create-trip', [Trip::class, 'createTrip']);
Route::post('v1/trip/update-trip', [Trip::class, 'updateTrip']);
Route::get('v1/trip/get-tripDt', [Trip::class, 'listTripById']);

Route::get('v1/trip/get-location-text', [Trip::class, 'getLocationTest']);
Route::get('v1/trip/get-alltripDt', [Trip::class, 'getalltrip']);
