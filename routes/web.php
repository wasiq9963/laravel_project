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
    }else{

        return view('subway.subwaydashboard');
    }
});

//dashboard
Route::get('/dashboard', function () {
    return view('subway.subwaydashboard');
});

//=======================================Category
//for fetch
Route::get('/category', 'CategoryController@index');

//insert route
//Route::get('/category/add','CategoryController@insertform');
Route::post('/category/add','CategoryController@insert');

//update route
Route::get('/category/edit/{id}','CategoryController@edit');
Route::post('/category/update','CategoryController@update');

//delete route
Route::get('/category/delete/{id}','CategoryController@catdelete');

//=======================================Brand

//fetch
Route::get('/brand','BrandController@index');

//insert
//Route::get('/brand/add','BrandController@insertform');
Route::post('/brand/add','BrandController@insert');

//update
Route::get('/brand/edit/{id}','BrandController@edit');
Route::post('/brand/update','BrandController@update');

//delete
Route::get('/brand/delete/{id}','BrandController@delete');


//=======================================Product
//insert
//Route::get('/product/add','ProductController@insertform');
Route::post('/product/add','ProductController@insert');

//fetch
Route::get('/product','ProductController@fetch');
//delete
Route::get('/product/delete/{id}','ProductController@delete');

//update
Route::get('/product/edit/{id}','ProductController@editfetch');
Route::post('/product/update','ProductController@update');

//=======================================Product
//insert
//Route::get('/product/add','ProductController@insertform');
Route::post('/item/add','ItemController@insert');

//fetch
Route::get('/item','ItemController@fetch');
//delete
Route::get('/item/delete/{id}','ItemController@delete');

//update
Route::get('/item/edit/{id}','ItemController@editfetch');
Route::post('/item/update','ItemController@update');

//========================================Department

//fetch
Route::get('/department','DepartmentController@index');

//insert
Route::post('/department/add','DepartmentController@insert');

//update
Route::get('/department/edit/{id}','DepartmentController@editfetch');
Route::post('/department/update','DepartmentController@update');

//delete
Route::get('/department/delete/{id}','DepartmentController@delete');

//========================================Employee

//fetch
Route::get('/employee','EmployeeController@index');

//insert
Route::post('/employee/add','EmployeeController@insert');

//delete
Route::get('/employee/delete/{id}','EmployeeController@delete');

//update
Route::get('/employee/edit/{id}','EmployeeController@editfetch');
Route::post('/employee/update','EmployeeController@update');

//view
Route::get('/employee/view/{id}','EmployeeController@view');

//========================================Shift

//fetch
Route::get('/shift',"ShiftController@index");

//insert
Route::post('/shift/add','ShiftController@insert');

//delete
Route::get('/shift/delete/{id}','ShiftController@delete');

//update
Route::get('/shift/edit/{id}','ShiftController@editfetch');
Route::post('/shift/update','ShiftController@update');

//=======================================Supplier

//fetch
Route::get('/supplier','SupplierController@index');

//insert
Route::post('/supplier/add','SupplierController@insert');

//delete
Route::get('/supplier/delete/{id}','SupplierController@delete');

//update
Route::get('/supplier/edit/{id}','SupplierController@edit');
Route::post('/supplier/update','SupplierController@update');

//fetch map info
Route::get('/supplier/map','SupplierController@fetchmap');

//=======================================Customer

//fetch
Route::get('/customer','CustomerController@index');

//insert
Route::post('/customer/add','CustomerController@insert');

//delete
Route::get('/customer/delete/{id}','CustomerController@delete');

//update
Route::get('/customer/edit/{id}','CustomerController@edit');
Route::post('/customer/update','CustomerController@update');

//fetch map info
Route::get('/customer/map','CustomerController@fetchmap');
//fetch map info
Route::get('/customer/map/search','CustomerController@fetchmapsearch');

//=======================================FrontEND Mart

Route::get('/mart','MartController@index');
Route::get('/mart/product','MartController@products');
Route::get('/mart/singlproduct','MartController@singleproduct');
Route::get('/mart/add-to-cart','MartController@addtocart');
Route::get('/mart/get-cart-items','MartController@getcartitems');
Route::get('/mart/remove-cart','MartController@removecart');
Route::get('/mart/update-cart','MartController@updatecart');

//=======================================FrontEND Subway

Route::get('/subway','SubwayController@index');
Route::get('/subway/items','SubwayController@items');
Route::get('/subway/singleitem','SubwayController@singleitem');
Route::get('/subway/get-cart-items','SubwayController@getcartitems');
Route::get('/subway/add-to-cart','SubwayController@addtocart');
Route::get('/subway/remove-cart','SubwayController@removecart');
Route::get('/subway/update-cart','SubwayController@updatecart');
Route::get('/subway/order-place','SubwayController@orderplace');
Route::get('/subway/cart-clear','SubwayController@cartclear');
Route::get('/subway/customer','SubwayController@customerinfo');
//sub detail 
Route::get('/subway/sub-detail','SubwayController@subdetail');
Route::get('/subway/fetch-sub-detail','SubwayController@fetchsubdetail');

Route::get('/order','OrderController@orders');
Route::get('/orderdetail/{id}','OrderController@orderdetail');
Route::get('/order/report/{id}','OrderController@report');

//=======================================Subway Store 
Route::get('/store','StoreController@index');

//insert route
//Route::get('/category/add','CategoryController@insertform');
Route::post('/store/add','StoreController@insert');

//update route
Route::get('/store/edit/{id}','StoreController@edit');
Route::post('/store/update','StoreController@update');

//delete route
Route::get('/store/delete/{id}','StoreController@delete');

//=======================================User
Route::get('/user','UserController@index');

//Insert route
Route::post('/user/add','UserController@add');

//delete route
Route::get('/user/delete/{id}','UserController@delete');

//update route
Route::get('/user/edit/{id}','UserController@editfetch');
Route::post('/user/update','UserController@update');

//subway customer 
Route::post('/subwaycustomer/add','SubwayController@customerinsert');




Auth::routes();

//Route::get('/dashboard', 'HomeController@index');







