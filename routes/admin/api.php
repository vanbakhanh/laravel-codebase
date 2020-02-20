<?php

Route::group(['namespace' => 'Auth'], function () {

    // Refresh token
    Route::post('login', 'LoginController@login');

    Route::group(['middleware' => 'auth:api'], function () {

        // Logout
        Route::post('logout', 'LoginController@logout');
    });
});

Route::group(['middleware' => ['auth:api', 'permission:' . config('authorization.permissions.view-admin') ]], function () {

    // User
    Route::resource('users', 'UserController');
});
