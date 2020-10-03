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


// Contact Routes
Route::get('app/details', 'contactController@details');
Route::get('app/show', 'contactController@show');
Route::post('app/createContact', 'ContactController@addContact');
Route::get('app/getContact', 'ContactController@getContact');
Route::post('app/editContact', 'ContactController@editContact');
Route::post('app/deleteContact', 'ContactController@deleteContact');

// Address routes
Route::post('app/createAddress', 'ContactController@addAddress');
Route::get('app/getAddress', 'ContactController@getAddress');
Route::post('app/editAddress', 'ContactController@editAddress');
Route::post('app/deleteAddress', 'ContactController@deleteAddress');

// example of Vue Spa
Route::any('{slug}', function(){
return view('welcome');
});
