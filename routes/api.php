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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('show', 'VueController@listVideo');
Route::post('upload', 'VueController@upload');
Route::post('getSub', 'VueController@getSub');
Route::post('sub', 'VueController@sub');
Route::post('testUpload', 'VueController@testUpload');

Route::group(['middleware' => 'auth:api'], function () {
});
