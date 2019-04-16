<?php

Auth::routes();
//guest Middleware
Route::group(['middleware' => 'guest'], function(){
            Route::get('/UserHome','UserProductController@getproduct')->name('UserHome');
            Route::get('/UserHome/product/{id}','UserProductController@show')->name('product.show');
            Route::get('/signup','UserController@getSignup')->name('user.signup');
            Route::post('/signup','UserController@postSignup')->name('user.signup');
            Route::get('/signin','UserController@getSignin')->name('user.signin');
            Route::post('/signin','UserController@postSignin')->name('user.signin');  
                });

//Auth Middleware
Route::group(['middleware' => 'auth'], function () {
			Route::get('/UserHome','UserProductController@getproduct')->name('UserHome');
            Route::get('/UserHome/product/{id}','UserProductController@show')->name('product.show');
            Route::get('/user/profile','UserController@getProfile')->name('user.profile');
            Route::get('/user/logout','UserController@logout')->name('user.logout');
            Route::get('/AddToCart/{id}','UserProductController@addToCart')->name('addToCart');
            Route::get('Cart','UserProductController@cart')->name('Cart');
            Route::get('checkout','UserProductController@checkout')->name('checkout');
            Route::get('/UserHome/product/{id}','UserProductController@show')->name('product.show');
            Route::post('/review','UserProductController@storereview')->name('review.store');
            Route::get('/category/products','UserProductController@products')->name('category.product');
            Route::get('/whishlist/{id}','WhishlistController@store')->name('whishlist');
                });
            
               
//IsAdmin Middleware
Route::group(['middleware' => 'IsAdmin'], function (){
                Route::get('/', 'AdminController@admin')->name('adminhome');
            // Admin Users Route
            Route::get('user/create','UserController@create')->name('user.create');

            Route::get('users','UserController@index')->name('users');
            Route::post('user/store','UserController@store')->name('user.store');
            Route::get('user/delete/{id}','UserController@delete')->name('user.delete');
            Route::get('user/deleteAdmin/{id}','UserController@deleteAdmin')->name('user.deleteAdmin');
            Route::get('user/admin/{id}','UserController@admin')->name('user.admin');

                //categories Route
            Route::get('/category','CategoriesController@create');
            Route::post('store','CategoriesController@store');
            Route::get('show','CategoriesController@index');
            Route::get('/{category}/delete','CategoriesController@delete');
            Route::get('/category/edit/{id}','CategoriesController@edit')->name('category.edit');
            Route::post('/category/update/{id}','CategoriesController@update')->name('category.update');
            
                //products Routes
            Route::get('/product/create','ProductController@create');
            Route::post('/product/store','ProductController@store');
            Route::get('/products','ProductController@index');
            Route::get('/product/delete/{id}','ProductController@delete')->name('product.delete');
            Route::get('/product/edit/{id}','ProductController@edit')->name('product.edit');
            Route::post('/product/update/{id}','ProductController@update')->name('product.update');
            
            //Orders Route
            Route::get('/orders','OrderController@getAllOrders')->name('orders');
            Route::get('/order/cancel/{id}','OrderController@cancelOrder')->name('order.cancel');
            Route::get('/order/approve/{id}','OrderController@approveOrder')->name('order.approve');
            Route::get('/ads','AdminController@create')->name('ads.add');
            Route::Post('/ads/store','AdminController@store')->name('ads.store');
 });
	
  	


