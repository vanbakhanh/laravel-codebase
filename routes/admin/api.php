<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group([
    'namespace' => 'Auth',
], function () {

    Route::post('login', 'LoginController@login');

    Route::group([
        'middleware' => 'auth:api',
    ], function () {

        Route::post('logout', 'LoginController@logout');
    });
});

Route::group([
    'middleware' => [
        'auth:api',
        'role:' . config('authorization.roles.super-admin'),
    ],
], function () {

    Route::resource('users', 'UserController');
});
