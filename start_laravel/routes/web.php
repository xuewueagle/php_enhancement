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

Route::get('article',function(){
    return view('article');
});


//Route::get('article/index','ArticleController@index');
//Route::get('article/create','ArticleController@create');

// 分组路由
Route::prefix('article')->group(function(){
    Route::get('index','ArticleController@index');
    Route::get('create','ArticleController@index');
    // 路由参数--限制了第一个参数只能为数字
    Route::get('edit/{id}/{name}','ArticleController@edit')->where('id','[0-9]+');
     Route::get('edits/{id}/{name}','ArticleController@edits')->where('id','[0-9]+');
});



//Route::prefix('home/article')->namespace('Home')->group(function () {
//    Route::get('index', 'ArticleController@index');
//    Route::get('create', 'ArticleController@create');
//});

// 多级目录--开发中推荐使用路由group嵌套方式
Route::prefix('home')->namespace('Home')->group(function () {
    Route::prefix('article')->group(function () {
        Route::get('index', 'ArticleController@index');
        Route::get('create', 'ArticleController@create');
    });
});

Route::prefix('database')->group(function(){
    Route::get('insert','DatabaseController@insert');
    Route::get('get', 'DatabaseController@get');
});

Route::prefix('model')->group(function () {
    Route::get('index', 'ModelController@index');
    Route::get('get', 'ModelController@get');
    Route::get('store', 'ModelController@store');
    Route::get('update', 'ModelController@update');
    Route::get('delete', 'ModelController@delete');
});

