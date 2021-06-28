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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['web']], function () {

	Route::get('/dashboard','App\Http\Controllers\RegistrationController@dashBoard');
	Route::post('/user_login','App\Http\Controllers\RegistrationController@userLogin');
	Route::get('/login','App\Http\Controllers\RegistrationController@login');
	Route::get('/logout','App\Http\Controllers\RegistrationController@logout');
	Route::get('/register','App\Http\Controllers\RegistrationController@register');
	Route::get('/setpassword/{uniqid}','App\Http\Controllers\RegistrationController@setPassword');
});

