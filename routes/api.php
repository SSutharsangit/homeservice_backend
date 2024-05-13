<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProviderController;

Route::post('/login', 'App\Http\Controllers\AuthControllerController@login');
Route::post('/forgot-password', 'App\Http\Controllers\AuthControllerController@sendResetLinkEmail');
Route::get('/users', 'App\Http\Controllers\AuthControllerController@getAll');
Route::put('/users/{id}', 'App\Http\Controllers\AuthControllerController@update');
Route::Delete('/users/{id}', 'App\Http\Controllers\AuthControllerController@delete');

Route::get('/service-types', 'App\Http\Controllers\ServiceTypeController@index');
Route::get('/service-types/{id}/', 'App\Http\Controllers\ServiceTypeController@show');
Route::post('/service-types', 'App\Http\Controllers\ServiceTypeController@store');
Route::put('/service-types/{id}/', 'App\Http\Controllers\ServiceTypeController@update');
Route::delete('/service-types/{id}/', 'App\Http\Controllers\ServiceTypeController@delete');

Route::get('/customers', 'App\Http\Controllers\CustomerController@index');
Route::get('/customers/{id}/', 'App\Http\Controllers\CustomerController@show');
Route::post('/customers', 'App\Http\Controllers\CustomerController@store');
Route::put('/customers/{id}/', 'App\Http\Controllers\CustomerController@update');
Route::delete('/customers/{id}/', 'App\Http\Controllers\CustomerController@delete');

Route::get('/providers', 'App\Http\Controllers\ProviderController@index');
Route::get('/providers/{id}/', 'App\Http\Controllers\ProviderController@show');
Route::post('/providers', 'App\Http\Controllers\ProviderController@store');
Route::put('/providers/{id}/', 'App\Http\Controllers\ProviderController@update');
Route::delete('/providers/{id}/', 'App\Http\Controllers\ProviderController@delete');

Route::get('/requests', 'App\Http\Controllers\SRequestController@index');
Route::get('/requests/{id}/', 'App\Http\Controllers\SRequestController@show');
Route::post('/requests', 'App\Http\Controllers\SRequestController@store');
Route::put('/requests/{id}/', 'App\Http\Controllers\SRequestController@update');
Route::delete('/requests/{id}/', 'App\Http\Controllers\SRequestController@delete');

Route::get('/services', 'App\Http\Controllers\ServiceController@index');
Route::get('/services/{id}/', 'App\Http\Controllers\ServiceController@show');
Route::post('/services', 'App\Http\Controllers\ServiceController@store');
Route::put('/services/{id}/', 'App\Http\Controllers\ServiceController@update');
Route::delete('/services/{id}/', 'App\Http\Controllers\ServiceController@delete');
Route::get('/services/{ser_id}/provider-service/', 'App\Http\Controllers\ServiceController@getAllByService');

// Route::get('/users', 'App\Http\Controllers\UserController@index');
// Route::get('/users/{id}/', 'App\Http\Controllers\UserController@show');
// Route::post('/users', 'App\Http\Controllers\UserController@store');
// Route::put('/users/{id}/', 'App\Http\Controllers\UserController@update');
// Route::delete('/users/{id}/', 'App\Http\Controllers\UserController@delete');

Route::get('/rating', 'App\Http\Controllers\RatingController@index');
Route::get('/rating/{id}/', 'App\Http\Controllers\RatingController@show');
Route::post('/rating', 'App\Http\Controllers\RatingController@store');
Route::put('/rating/{id}/', 'App\Http\Controllers\RatingController@update');
Route::delete('/rating/{id}/', 'App\Http\Controllers\RatingController@delete');

Route::get('/provider-service', 'App\Http\Controllers\ServiceProviderController@index');
Route::get('/provider-service/{id}', 'App\Http\Controllers\ServiceProviderController@show');
Route::post('/provider-service', 'App\Http\Controllers\ServiceProviderController@store');
Route::put('/provider-service/{id}', 'App\Http\Controllers\ServiceProviderController@update');
Route::delete('/provider-service/{id}', 'App\Http\Controllers\ServiceProviderController@delete');
Route::get('/provider-service/{id}/ratings', 'App\Http\Controllers\ServiceProviderController@getAllRating');


