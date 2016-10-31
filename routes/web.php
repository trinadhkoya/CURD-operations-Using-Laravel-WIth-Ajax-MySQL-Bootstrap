<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','CustomerController@index');
Route::post('/newCustomer',   	'CustomerController@newCustomer');
Route::get('/getUpdate',    	'CustomerController@getUpdate');
Route::put('/newCustomer',  	'CustomerController@newCustomerUpdate');
Route::post('/deleteCustomer',	'CustomerController@deleteCustomer');
