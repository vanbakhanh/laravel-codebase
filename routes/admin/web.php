<?php

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => [
        'auth',
        'role:' . config('authorization.roles.super-admin'),
        'timeout',
    ],
], function () {

    Route::get('/', 'DashboardController@index')->name('index');

    Route::resource('user', 'UserController', [
        'names' => [
            'index' => 'user',
        ],
    ]);
});
