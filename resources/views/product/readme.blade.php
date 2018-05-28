<!-- index.blade.php
路由

Route::get('/home', 'HomeController@index')->name('home'); //用户注册登入登出  http://localhost/home

Route::resource('/product','ProductController');

Route::get("/",'ProductController@index');  //同下 http://localhost
Route::get("/products",'ProductController@index');  //展示index列表  http://localhost/product
Route::get("/admin",'ProductController@admin');  //展示管理列表  http://localhost/admin
Route::get("/search/{keyword}",'ProductController@search');  //返回查询json  http://localhost/search/银行
Route::get("/product/{product_id}",'ProductController@show');  //展示单个产品  http://localhost/product/1
Route::get("/product/create",'ProductController@create');  //新产品填写表单页  http://localhost/product/create
Route::post("/product",'ProductController@store');  //提交新产品   post  http://localhost/product
Route::get("/product/{product_id}/edit",'ProductController@edit');  //产品修改页面  http://localhost/product/1/edit
Route::patch("/product/{product_id}",'ProductController@update');  //提交修改产品  patch http://localhost/product/1
Route::delete("/product/{product_id}",'ProductController@destory');  //删除产品  del http://localhost/product/1

静态资源在/public/

-->