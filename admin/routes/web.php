<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::view('admin/admin_template','admin.admin_template');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users','UsersController');
Route::resource('roles','RolesController');
Route::get('index', function()
{
    return view('index');
});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::view('admin/adminlogin','admin.adminlogin');
Route::get('/main', 'MainController@index');
Route::post('/main/checklogin', 'MainController@checklogin');
 Route::get('main/successlogin', 'MainController@successlogin');
 Route::get('logout', 'MainController@logout');
Auth::routes();
Route::view('register','register');

Route::resource('banner','BannerController');
Route::resource('configuration','ConfigurationController');
Route::resource('category','CategoryController');
Route::resource('product','ProductController');
//Route::get("addmore","HomeController@addMore");

//Route::post("addmore","HomeController@addMorePost");
 Route::resource('product_attributes','ProductAttributeController');
// Route::post('product/insert', 'ProductController@insert')->name('product.insert');
// Route::resource('product_images','Product_ImageController');
Route::get('product/create/{id}', 'ProductController@getValues');
Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'ProductController@myformAjax'));
Route::resource('coupon','CouponController');
Route::view('Eshopper','frontend.home');
Route::resource('homes','HomesController');
//Route::get('/home/{name}','HomesController@products');
Route::resource('login','HomesController');
Route::get('/login', 'HomeController@login')->name('login');
Route::match(['GET','POST'],'/login-register','HomesController@register');
Route::get('/main', 'MainController@index');
Route::post('/login-register/checklogin', 'HomesController@checklogin');
Route::get('login-register/successlogin', 'HomesController@successlogin');
Route::get('logout', 'HomesController@logout');
Route::get('/products/{url}','HomesController@products');
Route::get('prod/{id}','HomesController@prod');
