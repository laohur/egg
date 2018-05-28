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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); //用户注册登入登出

Route::resource('/product','ProductController');

Route::get("/",'ProductController@index');  //展示products列表
Route::get("/products",'ProductController@index');  //展示products列表
Route::get("/admin",'ProductController@admin');  //展示管理列表
Route::get("/search/{keyword}",'ProductController@search');  //返回查询json
Route::get("/product/{product_id}",'ProductController@show');  //展示单个产品
Route::get("/product/create",'ProductController@create');  //新产品填写表单页
Route::post("/product",'ProductController@store');  //提交新产品
Route::get("/product/{product_id}/edit",'ProductController@edit');  //产品修改页面
Route::patch("/product/{product_id}",'ProductController@update');  //提交修改产品
Route::delete("/product/{product_id}",'ProductController@destory');  //删除产品
