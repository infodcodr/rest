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

Route::group([ 'prefix' => 'auth'], function (){
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'Api\AuthController@login');
        Route::post('signup', 'Api\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::post('getuser', 'Api\AuthController@getUser');
    });
});

Route::group([ 'prefix' => 'admin'], function (){
    Route::post('table', 'Api\Admin\TableController@store');
    Route::post('table/{id}', 'Api\Admin\TableController@show');
    Route::post('table/{id}/update', 'Api\Admin\TableController@update');
    Route::post('table/{id}/remove', 'Api\Admin\TableController@destroy');

    Route::post('menu', 'Api\Admin\MenuController@store');
    Route::post('menu/{id}', 'Api\Admin\MenuController@show');
    Route::post('menu/{id}/update', 'Api\Admin\MenuController@update');
    Route::post('menu/{id}/remove', 'Api\Admin\MenuController@destroy');

    Route::post('item', 'Api\Admin\ItemsController@store');
    Route::post('item/{id}', 'Api\Admin\ItemsController@show');
    Route::post('item/{id}/update', 'Api\Admin\ItemsController@update');
    Route::post('item/{id}/remove', 'Api\Admin\ItemsController@destroy');

    Route::post('order', 'Api\Admin\OrderController@store');
    Route::post('order/{id}', 'Api\Admin\OrderController@show');
    Route::post('order/{id}/update', 'Api\Admin\OrderController@update');
    Route::post('order/{id}/remove', 'Api\Admin\OrderController@destroy');

});

Route::get('table/{id}', 'TableController@index');
