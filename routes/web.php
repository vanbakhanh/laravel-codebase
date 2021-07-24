<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home.index')->middleware('verified');

Route::get('login/{provider}', 'Auth\SocialController@redirectToProvider')->name('social.login');
Route::get('login/{provider}/callback', 'Auth\SocialController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function () {
    // Change password
    Route::get('change-password', 'ChangePasswordController@edit')->name('change-password.edit');
    Route::post('change-password', 'ChangePasswordController@update')->name('change-password.update');

    // Profile
    Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('profile/update', 'ProfileController@update')->name('profile.update');
});

// Video/Audio player
Route::get('file/{id}', 'FileController@show')->name('file.show');
