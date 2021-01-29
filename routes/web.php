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

Route::prefix("admin")->group(function(){
    Route::get('/', 'AdminController@index');
    Route::resource('category','CategoryController')->except('show');
    Route::resource('location/ostan','OstanController')->except('show');
    Route::resource('location/shahr','ShahrController')->except('show');
    Route::resource('location/area','AreaController')->except('show');
    Route::resource('ads/filter','FilterController');
    Route::post('ads/filter/add_item','FilterController@add_item');
    Route::delete('ads/filter/del_item/{id}' , 'FilterController@del_item');
});

Route::get('ads/new', 'SiteController@new_ads');
Route::post('get_filter', 'SiteController@get_filter');
Route::post('ads_image_upload','SiteController@ads_image_upload');
Route::post('del_ads_img','SiteController@del_ads_img');
