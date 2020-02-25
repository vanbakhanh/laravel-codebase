<?php

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
