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
//User Route
Route::apiResource('/users','Api\Admin\UserController');

//Categries Route
Route::apiResource('/categories','Api\Admin\CategoryController');

//Products Route
Route::apiResource('/{category}/products','Api\Admin\ProductController');

//Review route
Route::apiResource('/{product}/reviews','Api\Admin\ReviewController');


//Orders Route
Route::apiResource('/{user}/orders','Api\Admin\OrderController');

Route::get('/product/{order}','Api\Admin\OrderController@orderProducts')->name('order.products');

Route::group(['prefix'=>'user'],function(){
	Route::post('/register','Api\User\UserController@register');
	Route::post('/login','Api\User\UserController@login');
	Route::get('/logout','Api\User\UserController@logout');
	Route::get('/{product}/addToCart','Api\User\CartController@addToCart');
	Route::get('/getCart','Api\User\CartController@getCart');

});
