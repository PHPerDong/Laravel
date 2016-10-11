<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::any('login', 'View\LoginController@login');

Route::any('category', 'View\categoryController@category');

Route::get('/Service/category/parent_id/{parent_id}', 'Service\categoryController@getCategoryByParentId');

Route::get('prductlist/parent_id/{parent_id}', 'View\ProductController@prductlist');

Route::get('productContent/id/{id}', 'View\ProductController@productContent');

Route::get('addCart/product_id/{product_id}', 'Service\CartController@addCart');//添加到购物车

Route::get('cart/', 'Service\CartController@cart');//购物车页面

Route::any('register','View\RegisterController@register');

Route::get('create','Service\ValidateCodeController@create');//测试验证码

Route::post('regirsts', 'Service\MemberController@regirsts');

Route::post('logins', 'Service\MemberController@logins');


