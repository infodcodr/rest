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
    Route::get('table', 'Api\Admin\TableController@index');
    Route::post('table', 'Api\Admin\TableController@store');
    Route::post('table/{id}', 'Api\Admin\TableController@show');
    Route::post('table/{id}/update', 'Api\Admin\TableController@update');
    Route::post('table/{id}/remove', 'Api\Admin\TableController@destroy');
    Route::post('table/{id}/setposition', 'Api\Admin\TableController@setposition');
    Route::get('table/{id}/get', 'Api\Admin\TableController@getTables');
    Route::get('table/{id}/generate', 'Api\Admin\TableController@generate');

    Route::get('menu', 'Api\Admin\MenuController@index');
    Route::post('menu', 'Api\Admin\MenuController@store');
    Route::post('menu/search', 'Api\Admin\MenuController@search');
    Route::post('menu/{id}', 'Api\Admin\MenuController@show');
    Route::post('menu/{id}/update', 'Api\Admin\MenuController@update');
    Route::post('menu/{id}/remove', 'Api\Admin\MenuController@destroy');

    Route::get('item', 'Api\Admin\ItemsController@index');
    Route::post('item', 'Api\Admin\ItemsController@store');
    Route::post('item/search', 'Api\Admin\ItemsController@search');
    Route::post('item/{id}', 'Api\Admin\ItemsController@show');
    Route::post('item/{id}/update', 'Api\Admin\ItemsController@update');
    Route::post('item/{id}/remove', 'Api\Admin\ItemsController@destroy');

    Route::get('restaurants', 'Api\Admin\RestaurantController@index');
    Route::post('restaurants', 'Api\Admin\RestaurantController@store');
    Route::post('restaurants/search', 'Api\Admin\RestaurantController@search');
    Route::post('restaurants/{id}', 'Api\Admin\RestaurantController@show');
    Route::post('restaurants/{id}/update', 'Api\Admin\RestaurantController@update');
    Route::post('restaurants/{id}/remove', 'Api\Admin\RestaurantController@destroy');

    Route::get('user', 'Api\Admin\UserController@index');
    Route::post('user', 'Api\Admin\UserController@store');
    Route::post('user/search', 'Api\Admin\UserController@search');
    Route::post('user/{id}', 'Api\Admin\UserController@show');
    Route::post('user/{id}/update', 'Api\Admin\UserController@update');
    Route::post('user/{id}/remove', 'Api\Admin\UserController@destroy');

    Route::get('branch', 'Api\Admin\BranchController@index');
    Route::post('branch', 'Api\Admin\BranchController@store');
    Route::post('branch/search', 'Api\Admin\BranchController@search');
    Route::post('branch/{id}', 'Api\Admin\BranchController@show');
    Route::post('branch/{id}/update', 'Api\Admin\BranchController@update');
    Route::post('branch/{id}/remove', 'Api\Admin\BranchController@destroy');

    Route::get('role', 'Api\Admin\RoleController@index');
    Route::post('role', 'Api\Admin\RoleController@store');
    Route::post('role/search', 'Api\Admin\RoleController@search');
    Route::post('role/{id}', 'Api\Admin\RoleController@show');
    Route::post('role/{id}/update', 'Api\Admin\RoleController@update');
    Route::post('role/{id}/remove', 'Api\Admin\RoleController@destroy');

    Route::get('permission', 'Api\Admin\PermissionController@index');
    Route::post('permission', 'Api\Admin\PermissionController@store');
    Route::post('permission/search', 'Api\Admin\PermissionController@search');
    Route::post('permission/{id}', 'Api\Admin\PermissionController@show');
    Route::post('permission/{id}/update', 'Api\Admin\PermissionController@update');
    Route::post('permission/{id}/remove', 'Api\Admin\PermissionController@destroy');

    Route::get('order', 'Api\Admin\OrderController@index');
    Route::post('order', 'Api\Admin\OrderController@store');
    Route::post('order/search', 'Api\Admin\OrderController@search');
    Route::post('order/{id}', 'Api\Admin\OrderController@show');
    Route::post('order/{id}/update', 'Api\Admin\OrderController@update');
    Route::post('order/{id}/remove', 'Api\Admin\OrderController@destroy');
    Route::post('order/{id}/generate', 'Api\Admin\OrderController@generate');

    Route::get('cart', 'Api\Admin\CartController@index');
    Route::post('cart', 'Api\Admin\CartController@store');
    Route::post('cart/{id}', 'Api\Admin\CartController@show');
    Route::post('cart/{id}/update', 'Api\Admin\CartController@update');
    Route::post('cart/{id}/remove', 'Api\Admin\CartController@destroy');

});

Route::get('cart/{table_id}', 'Api\CartController@index');
Route::post('cart', 'Api\CartController@store');
Route::post('cart/{id}', 'Api\CartController@show');
Route::post('cart/{id}/update', 'Api\CartController@update');
Route::post('cart/{id}/remove', 'Api\CartController@destroy');

Route::post('order', 'Api\OrderController@store');

Route::get('order/{id}', 'Api\OrderController@index');
Route::get('order/detail/{id}', 'Api\OrderController@show');
Route::get('table/{id}', 'Api\TableController@show');
Route::post('table/{id}/update', 'Api\TableController@update');
Route::get('branch/{id}', 'Api\BranchController@show');
