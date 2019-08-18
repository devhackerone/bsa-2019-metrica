<?php

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

Route::prefix('v1')->group(function () {
    Route::group([
        'prefix' => 'auth',
        'namespace' => 'Api\\Auth'
    ], function () {
        Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');
        Route::post('/reset-password', 'ResetPasswordController@sendPasswordResetLink');
        Route::get('/me', 'AuthController@getCurrentUser')->middleware('auth:api');
    });

    Route::group([
        'namespace' => 'Api',
        'middleware' => 'auth:api'
    ], function () {
        Route::group([
            'prefix' => 'users'
        ], function () {
            Route::put('/me', 'UserController@update');
        });

        Route::group([
            'prefix' => 'websites'
        ], function () {
            Route::get('/', 'WebsiteController@getCurrentUserWebsite');
            Route::post('/', 'WebsiteController@add');
            Route::put('/{id}', 'WebsiteController@update');
        });
        Route::group([
            'prefix' => 'visitors'
        ], function () {
            Route::get('/', 'VisitorController@getAllVisitors');
            Route::get('/by-table', 'VisitorController@getVisitorsByParameter');
            Route::get('/new', 'VisitorController@getNewVisitors');
            Route::get('/new/count', 'VisitorController@getNewVisitorsCountForFilterData');
            Route::get('/bounce-rate/total', 'VisitorController@getBounceRate');
        });

        Route::group([
            'prefix' => 'sessions',
        ], function () {
            Route::get('/', 'SessionController@getAllSessions');
            Route::get('/average', 'SessionController@getAverageSession');
        });

        Route::group([
           'prefix' => 'chart-visits'
        ], function() {
            Route::get('/', 'VisitController@getPageViews');
        });
    });
});

Route::get('/v1/health', function () {
    return "healthy";
});
