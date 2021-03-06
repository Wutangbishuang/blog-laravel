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

Route::get('/', function () {
    return view('welcome');
});
Route::any('admin/login','Admin\LoginController@login');
Route::get('admin/code','Admin\LoginController@code');

Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::any('pass','IndexController@pass');
    Route::get('quit','LoginController@quit');


    Route::post('cate/changeorder','CategoryController@changeOrder');

    Route::any('upload','CommonController@upload');//缩略图失败

    Route::resource('article','ArtController');

    Route::resource('category','CategoryController');

    Route::resource('links','LinksController');
    Route::post('links/changeorder','LinksController@changeOrder');

    Route::resource('navs','NavsController');
    Route::post('navs/changeorder','NavsController@changeOrder');

    Route::resource('config','ConfigController');
    Route::post('config/changeorder','ConfigController@changeOrder');
    Route::post('config/content','ConfigController@changeContent');
    Route::get('config/putf','ConfigController@putFile');
});
