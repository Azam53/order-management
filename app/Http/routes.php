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

//Authentication routes  
Route::auth();
//Landing page to startoff
Route::get('/home', 'HomeController@index');

// route for order operations and protected by middleware for only registered user
Route::group(['middleware' => 'auth.basic'], function()
{
     Route::resource('order', 'OrderController');   
     Route::get('search', 'SearchController@index')->name('search');
     Route::resource('product', 'ProductController');   
});

