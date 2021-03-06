<?php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/product/view', 'ProductController@addproductview');

Route::post('/add/product/insert','ProductController@addproductinsert');

Route::get('/delete/product/{product_id}','ProductController@deleteproduct');
Route::get('/edit/product/{product_id}','ProductController@editproduct');
Route::post('edit/product/insert','ProductController@editproductinsert');
Route::get('/restore/product/{product_id}','ProductController@restoreproduct');
Route::get('/force/delete/product/{product_id}','ProductController@forcedeleteproduct');
Route::get('/add/category/view','CategoryController@addcategoryview');
Route::post('/add/category/insert','CategoryController@addcategoryinsert');
Route::get('/contact/message/view','HomeController@contactmessageview');
Route::get('/change/menu/status/{category_id}','HomeController@changemenustatus');

//frontend controller
Route::get('contact','FrontendController@contact');
Route::get('about','FrontendController@about');
Route::get('/','FrontendController@index');
Route::get('/product/details/{product_id}','FrontendController@productdetails');
Route::get('/category/wise/product/{category_id}','FrontendController@categorywiseproduct');
Route::post('/contact/insert','FrontendController@contactinsert');
Route::get('/add/to/cart/{product_id}','FrontendController@addtocart');
Route::get('/cart','FrontendController@cart');
Route::get('/cart/{coupon_name}','FrontendController@cart');
Route::get('/delete/form/cart/{cart_id}','FrontendController@deleteformcart');
Route::get('/clear/cart','FrontendController@clearcart');
Route::post('/update/cart','FrontendController@updatecart');
Route::get('/customer/login','FrontendController@customerlogin');
Route::post('/customer/login/insert','FrontendController@customerlogininsert');


Route::get('/customer/dashboard','CouponController@customerdashboard');

//coupon controller
Route::get('/coupon/add/view','CouponController@couponaddview');
Route::post('/coupon/add/insert','CouponController@couponaddinsert');
