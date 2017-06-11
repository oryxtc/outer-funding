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

Route::get('/home', 'HomeController@index')->name('home');

//注册 登录 忘记密码
Auth::routes();

//发送验证码
Route::post('/sendValidatorCode', 'ValidatorController@sendValidatorCode');

//后台管理
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
