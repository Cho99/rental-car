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

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/addresses/create-district', 'AddressController@createDistrict')->name('create-district');
    Route::get('/addresses/create-ward', 'AddressController@createWard')->name('create-ward');
    Route::get('/cars/list_register', 'CarController@listRegister')->name('cars.list_register');
    Route::get('/cars/register/{id}', 'CarController@register')->name('cars.register');
    Route::post('/cars/register/accept/{id}', 'CarController@accept');
    Route::post('/cars/register/reject/{id}', 'CarController@reject');
    Route::post('/cars/register/block/{id}', 'CarController@block');
    Route::post('/cars/register/unblock/{id}', 'CarController@unblock');
    Route::resource('/cars', 'CarController');
    Route::resource('/addresses', 'AddressController');
    Route::resource('/features', 'FeatureController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/rules', 'RuleController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/cars', 'CarController');
    Route::get('/cars/create/step-one', 'CarController@stepOne')->name('create-step-one');
    Route::get('/vehicles/{did}', 'CarController@getVehicle');
    Route::post('/cars/create/step-two', 'CarController@createStepOne')->name('create-step-two');
    Route::post('/cars/create/step-three', 'CarController@createStepTwo')->name('create-step-three');
    Route::post('/cars/create/step-final', 'CarController@createFinal')->name('create-final');
});

Route::get('/home', 'HomeController@index')->name('home');
