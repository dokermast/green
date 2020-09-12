<?php

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

Route::view('/', 'welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'field'], function () {

        Route::get('/', 'FieldController@index')->name('fields');
        Route::get('/show/{field}', 'FieldController@show')->name('field_show');
        Route::get('/create', 'FieldController@create')->name('field_create');
        Route::post('/store', 'FieldController@store')->name('field_store');
        Route::get('/edit/{field}', 'FieldController@edit')->name('field_edit');
        Route::post('/update/{old_field}', 'FieldController@update')->name('field_update');
        Route::delete('/destroy/{field}', 'FieldController@destroy')->name('field_destroy');
    });

    Route::group(['prefix' => 'product'], function () {

        Route::get('/', 'ProductController@index')->name('products');
        Route::get('/create', 'ProductController@create')->name('product_create');
        Route::post('/store', 'ProductController@store')->name('product_store');
        Route::get('/edit/{product}', 'ProductController@edit')->name('product_edit');
        Route::post('/update/{product}', 'ProductController@update')->name('product_update');
        Route::delete('/destroy/{product}', 'ProductController@destroy')->name('product_destroy');
    });

    Route::group(['prefix' => 'email'], function () {

        Route::get('/create', 'EmailController@create')->name('email_form');
        Route::match(['post', 'get'], '/send', 'EmailController@send')->name('email_send');
    });

});

