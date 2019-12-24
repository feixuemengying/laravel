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

use Illuminate\Support\Facades\Route;

Route::get('/', function () { //闭包函数
    return view('welcome');
});
Route::namespace("Auth")->group(function(){ //group分组路由,并使用namespce子命名空间
    Route::match(['get','post'],'login', 'LoginController@index')->name('login'); //name路由命名
});

Route::middleware("auth")->prefix('chain_pay')->namespace('ChainPay')->group(function(){ //路由登陆中间件auth,路由前缀chain_pay
    Route::get('openssl','OpensslController@openssl');
});
Route::prefix('chain_pay')->namespace('ChainPay')->group(function(){
    Route::get('jiami/{rsa_prefix}','OpensslController@jiami');
    Route::post('jiemi','OpensslController@jiemi')->name("ChainPay.jiemi");  
}); //路由前缀,路由子命名空间,路由分组