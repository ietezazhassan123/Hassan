<?php

use Illuminate\Http\Request;

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


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'UserController@details');
});



// This is for product controller
Route::apiResource('products','ProductController');


// This is for rating and its associate controller is Review Controller
Route::group(['prefix'=>'products'],function(){
      Route::apiResource('{product_id}/reviews','ReviewController');
});