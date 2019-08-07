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

Route::prefix('v1')->group(function () {
    Route::group([
        'namespace' => 'Api',
        'middleware' => 'auth:jwt'
    ], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::put('/{id}', 'UserController@update')->where('id', '[0-9]+');
        });

        Route::group(['prefix' => 'websites'], function () {
            Route::post('/add', 'WebsiteController@add');
        });
    });
});
