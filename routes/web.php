<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::group(['middleware' => 'auth', 'prefix' => 'admin','namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/addresses/create-district',  'AddressController@createDistrict')->name('create-district');
    Route::get('/addresses/create-ward',  'AddressController@createWard')->name('create-ward');
    Route::resource('/addresses', 'AddressController');
    Route::resource('/features', 'FeatureController');
});
Route::get('/home', 'HomeController@index')->name('home');
