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

/*Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('auth.login');
});*/
Route::get('/', function () {
			
    if (Auth::guest())
    {
        return view('auth.login');
    }
    else
    {
        return Redirect::action('DashboardController@index');
    }
});
//dashboard
Route::get('dashboard','DashboardController@index');

//=======================================Category
//for fetch
Route::get('category', 'CategoryController@index');

//insert route
//Route::get('category/add','CategoryController@insertform');
Route::post('category/add','CategoryController@insert');

//update route
Route::get('category/edit/{id}','CategoryController@edit');
Route::post('category/update','CategoryController@update');

//delete route
Route::get('category/delete/{id}','CategoryController@catdelete');

//=======================================Items
//insert
//Route::get('/product/add','ProductController@insertform');
Route::post('item/add','ItemController@insert');

//fetch
Route::get('item','ItemController@fetch');
//delete
Route::get('item/delete/{id}','ItemController@delete');

//update
Route::get('item/edit/{id}','ItemController@editfetch');
Route::post('item/update','ItemController@update');

//=======================================FrontEND Subway

Route::get('subway','SubwayController@index');
Route::get('subway/items','SubwayController@items');
Route::get('subway/singleitem','SubwayController@singleitem');
Route::get('subway/get-cart-items','SubwayController@getcartitems');
Route::get('subway/add-to-cart','SubwayController@addtocart');
Route::get('subway/remove-cart','SubwayController@removecart');
Route::get('subway/update-cart','SubwayController@updatecart');
Route::get('subway/order-place','SubwayController@orderplace');
Route::get('subway/cart-clear','SubwayController@cartclear');
Route::get('subway/customer','SubwayController@customerinfo');
//subway customer 
Route::post('subwaycustomer/add','SubwayController@customerinsert');

//sub detail 
Route::get('subway/sub-detail','SubwayController@subdetail');
Route::get('subway/fetch-sub-detail','SubwayController@fetchsubdetail');

Route::get('order','OrderController@index');
Route::get('order/info','OrderController@orders');
Route::get('orderdetail/{id}','OrderController@orderdetail');
Route::get('order/report/{id}','OrderController@report');

//order status update
Route::get('order/status','OrderController@statusupdate');




//=======================================Subway Store 
Route::get('store','StoreController@index');

//insert route
//Route::get('/category/add','CategoryController@insertform');
Route::post('store/add','StoreController@insert');

//update route
Route::get('store/edit/{id}','StoreController@edit');
Route::post('store/update','StoreController@update');

//delete route
Route::get('store/delete/{id}','StoreController@delete');

//=======================================User
Route::get('user','UserController@index');

//Insert route
Route::post('user/add','UserController@add');

//delete route
Route::get('user/delete/{id}','UserController@delete');

//update route
Route::get('user/edit/{id}','UserController@editfetch');
Route::post('user/update','UserController@update');

//=======================================Store Report
Route::get('storereport','StorereportController@index');
Route::get('storereport/fetch','StorereportController@storefetch');
Route::get('orderslist/report','StorereportController@report');

//=======================================vegetable
Route::get('vegetable','VegetableController@index');


Route::post('vegetable/add','VegetableController@insert');

//update route
Route::get('vegetable/edit/{id}','VegetableController@edit');
Route::post('vegetable/update','VegetableController@update');

//delete
Route::get('vegetable/delete/{id}','VegetableController@delete');

//=======================================sauce
Route::get('sauce','SauceController@index');


Route::post('sauce/add','SauceController@insert');

//update route
Route::get('sauce/edit/{id}','SauceController@edit');
Route::post('sauce/update','SauceController@update');

//delete
Route::get('sauce/delete/{id}','SauceController@delete');







Auth::routes();

//Route::get('/dashboard', 'HomeController@index');







