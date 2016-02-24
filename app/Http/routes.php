<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('auth/google', 'Auth\AuthController@google');
    Route::get('auth-callback', 'Auth\AuthController@callback');
    Route::get('map/{id}', 'MapController@show');
    Route::get('maps', 'MapController@index');
    Route::get('map/{id}/points', 'MapController@getPoints');
    Route::get('user/{id}/maps', 'MapController@getUserMaps');

    Route::get('/', function()
    {
        return View::make('index');
    });
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::post('map/store', 'MapController@store');
    Route::post('point/store', 'PointController@store');
    Route::delete('point/{id}', 'PointController@destroy');

    Route::get('logout', 'Auth\AuthController@logout');
    Route::get('auth/user', 'Auth\AuthController@getUserData');
});

Route::get('test/me', 'MapController@test');

