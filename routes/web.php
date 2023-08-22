<?php

//use App\Http\Controllers\Controller\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/', [UserController::class, 'index']);
Route::any('/', [Controllers\Admin\Admin::class, 'dashboard']);

Route::get('paywithpaypal', [Controllers\Admin\PaypalController::class, 'payWithPaypal'])->name("paywithpaypal");
Route::post('paypal', [Controllers\Admin\PaypalController::class, 'postPaymentWithpaypal'])->name("paypal");
Route::get('paypal', [Controllers\Admin\PaypalController::class, 'getPaymentStatus'])->name("status");
Route::get('sitemap.xml', [Controllers\Frontend\Sitemapcontroller::class, 'index']);

Route::group(['middleware' => 'prevent-back-history'],function(){
Route::any('login', [Controllers\Admin\Admin::class, 'login']);
Route::any('logout', [Controllers\Admin\Admin::class, 'logout']);
Route::any('stripe', [Controllers\Admin\Admin::class, 'stripe']);
Route::any('razorpay', [Controllers\Admin\Admin::class, 'razorpay']);
Route::get('changelang', [Controllers\Admin\Admin::class, 'changelang']);

Route::get('apidetails', [Controllers\Admin\Admin::class, 'api_details']);
Route::get('form-validation', [Controllers\Admin\Admin::class, 'form_validation']);
Route::get('pdf', [Controllers\Admin\Admin::class, 'pdf']);
Route::get('kanban-board', [Controllers\Admin\Admin::class, 'kanban']);
Route::get('project', [Controllers\Admin\Admin::class, 'project']);
Route::any('htmltopdf', [Controllers\Admin\Admin::class, 'htmltopdf']);
Route::any('setting', [Controllers\Admin\Admin::class, 'setting']);
Route::any('email_setting', [Controllers\Admin\Admin::class, 'email_setting']);
Route::any('general_setting', [Controllers\Admin\Admin::class, 'general_setting']);

Route::any('manage-role', [Controllers\Admin\RoleController::class, 'manageRole']);
Route::any('add-role', [Controllers\Admin\RoleController::class, 'addRole']);
Route::any('edit-role/{key}', [Controllers\Admin\RoleController::class, 'editRole']);

Route::any('manage-users', [Controllers\Admin\UsersController::class, 'manageUsers']);
Route::any('add-users', [Controllers\Admin\UsersController::class, 'addUsers']);
Route::any('edit-users/{key}', [Controllers\Admin\UsersController::class, 'editUsers']);

Route::any('manage-country', [Controllers\Admin\CountryController::class, 'manageCountry']);
Route::any('add-country', [Controllers\Admin\CountryController::class, 'addCountry']);
Route::any('edit-country/{key}', [Controllers\Admin\CountryController::class, 'editCountry']);

Route::any('manage-state', [Controllers\Admin\StateController::class, 'manageState']);
Route::any('add-state', [Controllers\Admin\StateController::class, 'addState']);
Route::any('edit-state/{key}', [Controllers\Admin\StateController::class, 'editState']);

Route::any('manage-city', [Controllers\Admin\CityController::class, 'manageCity']);
Route::any('add-city', [Controllers\Admin\CityController::class, 'addCity']);
Route::any('edit-city/{key}', [Controllers\Admin\CityController::class, 'editCity']);

Route::any('manage-category', [Controllers\Admin\CategoryController::class, 'manageCategory']);
Route::any('add-category', [Controllers\Admin\CategoryController::class, 'addCategory']);
Route::any('edit-category/{key}', [Controllers\Admin\CategoryController::class, 'editCategory']);

Route::any('manage-sub_category', [Controllers\Admin\Sub_categoryController::class, 'manageSub_category']);
Route::any('add-sub_category', [Controllers\Admin\Sub_categoryController::class, 'addSub_category']);
Route::any('edit-sub_category/{key}', [Controllers\Admin\Sub_categoryController::class, 'editSub_category']);

Route::any('manage-products-list', [Controllers\Admin\ProductsController::class, 'manageproductslist']);
Route::any('manage-products-grid', [Controllers\Admin\ProductsController::class, 'manageproductsgrid']);
Route::any('add-products', [Controllers\Admin\ProductsController::class, 'addproducts']);
Route::any('edit-products/{key}', [Controllers\Admin\ProductsController::class, 'editproducts']);
Route::any('view-product/{key}', [Controllers\Admin\ProductsController::class, 'viewproducts']);

Route::any('manage-role_permission', [Controllers\Admin\Role_permissionController::class, 'manageRole_permission']);
Route::any('add-role_permission', [Controllers\Admin\Role_permissionController::class, 'addRole_permission']);
Route::any('edit-role_permission/{key}', [Controllers\Admin\Role_permissionController::class, 'editRole_permission']);

Route::any('manage-geolocation-positionstack', [Controllers\Admin\GeolocationController::class, 'manage_geolocation_positionstack']);
Route::any('manage-geolocation-google', [Controllers\Admin\GeolocationController::class, 'manage_geolocation_google']);

Route::any('manage-trip', [Controllers\Admin\TripController::class, 'manage_trip']);

});
