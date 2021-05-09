<?php

use App\Http\Controllers\OrderController;
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

Auth::routes();

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/chart', 'HomeController@chart')->name('chart');
    Route::get('/addresses/create-district', 'AddressController@createDistrict')->name('create-district');
    Route::get('/addresses/create-ward', 'AddressController@createWard')->name('create-ward');
    Route::get('/cars/list_register', 'CarController@listRegister')->name('cars.list_register');
    Route::get('/cars/register/{id}', 'CarController@register')->name('cars.register');
    Route::post('/cars/register/accept/{id}', 'CarController@accept');
    Route::post('/cars/register/reject/{id}', 'CarController@reject');
    Route::post('/cars/register/block/{id}', 'CarController@block');
    Route::post('/cars/register/unblock/{id}', 'CarController@unblock');
    Route::resource('/cars', 'CarController');
    Route::resource('addresses', 'AddressController');
    Route::resource('features', 'FeatureController');
    Route::resource('categories', 'CategoryController');
    Route::resource('rules', 'RuleController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cars/create/step-one', 'CarController@stepOne')->name('create-step-one');
    Route::get('/vehicles/{did}', 'CarController@getVehicle');
    Route::post('/cars/create/step-two', 'CarController@createStepOne')->name('create-step-two');
    Route::get('/cars/create/step-two', 'CarController@createStepTwoView')->name('create-step-two');
    Route::post('/cars/create/step-three', 'CarController@createStepTwo')->name('create-step-three');
    Route::get('/cars/create/step-three', 'CarController@createStepThreeView')->name('create-step-three');
    Route::post('/cars/create/step-final', 'CarController@createFinal')->name('create-final');
    Route::get('/orders/{order}/accept','OrderController@accept')->name('orders.accept');
    Route::get('/orders/{order}/reject','OrderController@reject')->name('orders.reject');
    Route::get('/orders/{order}/borrowed','OrderController@borrowed')->name('orders.borrowed');
    Route::get('/orders/{order}/close','OrderController@close')->name('orders.close');
    Route::get('/orders/{order}/cancel','OrderController@cancel')->name('orders.cancel');
    Route::get('/my_orders/{order}/cancel', 'ClientController@cancel')->name('my_orders.cancel');
    Route::get('/my_orders', 'ClientController@getOrderRequest')->name('my_orders.index');
    Route::get('/my_orders/{order}', 'ClientController@show')->name('my_orders.show');
    Route::resource('orders', 'OrderController');
    Route::resource('users', 'UserController');
});
Route::resource('/cars', 'CarController');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/list-car', 'HomeController@getCars')->name('list-car');
Route::post('/review', 'HomeController@review');