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
//use App\Entity\PdtImages;

Route::get('/', function () {
    return view('welcome');
    
    //return PdtImages::all();
    //return view('login');
});

//Route::get('/login',function(){
//    return view('login');
//});

//Route::get('/register',function(){
//    return view('register');
//});

Route::any('/service/validate_code/create','service\ValidateController@create');

Route::get('/login','view\MemberController@login');

Route::get('/register','view\MemberController@register');
