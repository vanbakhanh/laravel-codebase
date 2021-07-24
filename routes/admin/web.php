<?php

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'as' => 'admin.',
    'middleware' => [
        'auth',
        'role:' . config('authorization.roles.super-admin'),
        'timeout',
    ],
], function () {

    Route::get('/', 'DashboardController@index')->name('index');

    Route::resource('user', 'UserController');
});
