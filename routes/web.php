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

Route::get('/','SiteController@index');
Route::get('/home','HomeController@index');

Route::middleware('Admin')->prefix("admin")->group(function(){
    Route::get('/', 'AdminController@index');
    Route::resource('category','CategoryController')->except('show');
    Route::resource('location/ostan','OstanController')->except('show');
    Route::resource('location/shahr','ShahrController')->except('show');
    Route::resource('location/area','AreaController')->except('show');
    Route::resource('user','UserController')->except('show');
    Route::resource('ads/filter','FilterController');
    Route::post('ads/filter/add_item','FilterController@add_item');
    Route::delete('ads/filter/del_item/{id}' , 'FilterController@del_item');
    Route::get('ads/verified','AdsController@verified');
    Route::delete('ads/{id}','AdsController@destroy');
    Route::get('ads/{id}/show','AdsController@show');
    Route::post('ads/changeStatus','AdsController@changeStatus');
});

Route::get('ads/new', 'SiteController@new_ads');
Route::post('ads/new','SiteController@create_ads');
Route::post('get_filter', 'SiteController@get_filter');
Route::post('ads_image_upload','SiteController@ads_image_upload');
Route::post('del_ads_img','SiteController@del_ads_img');
Route::get('مکان/{location_name}','SiteController@getLocationAds');
Route::get('مکان/{location_name}/{cat_url}','SiteController@getCatAds');
Route::get('مکان/{location_name}/{cat_url}/{cat2_url}','SiteController@getCat2Ads');
Route::post('ads_filter','SiteController@ads_filter');

Auth::routes();


Route::get('adminlogin','UserController@adminlogin_form')->name('adminlogin');
Route::post('adminlogin','UserController@adminlogin');
Route::get('login','UserController@login_form')->name('login');
Route::post('login','UserController@login');
Route::post('active_code','UserController@active_code');

Route::get('ads/{ads_url}','SiteController@show_ads');
