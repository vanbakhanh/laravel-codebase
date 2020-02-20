<?php

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['permission:' . config('authorization.permissions.view-admin'), 'timeout']], function () {
    /**
     * All route names are prefixed with 'admin.'.
     */
    Route::get('/', 'DashboardController@index')->name('index');

    Route::resource('user', 'UserController', [
        'names' => [
            'index' => 'user',
        ]
    ]);
});
