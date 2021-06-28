<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1'  , function ($api) {


    $api->group(['namespace' => 'App\Http\Controllers', 'middleware' => ['jwt.token.expiry'] ], function ($api) {
    });


    $api->group(['namespace' => 'App\Http\Controllers' ], function ($api) {
        $api->post('/register','RegistrationController@registerUser');
        $api->post('/setpassword','RegistrationController@setUserPassword');
        $api->post('/create_blog','RegistrationController@createBlog');
        $api->delete('/deleteBlog','RegistrationController@deleteBlog');
        $api->post('/getBlogDetails','RegistrationController@getBlogDetails');
        $api->post('/getBlogAnalytics','RegistrationController@getBlogAnalytics');
        $api->post('/getBlogStatistics','RegistrationController@getBlogStatistics');
    });

});

