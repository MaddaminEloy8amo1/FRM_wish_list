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

Route::get('/', 'WishDataController@welcome');
Route::get('/admin', 'WishDataController@admin');
Route::get('/userswish', 'WishDataController@adminpanel');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/wishData', 'WishDataController');
});

