<?php

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

Route::group(['namespace' => 'Auth'], function () {
    // Register
    Route::post('register', 'RegisterController@register');

    // Login
    Route::post('login', 'LoginController@login');
    Route::post('login/social', 'SocialController@login');

    // Refresh token
    Route::post('token/refresh', 'LoginController@refresh');

    // Reset password
    Route::post('password/email', 'ForgotPasswordController@sendResetTokenEmail');
    Route::post('password/verify-token', 'VerifyResetPasswordTokenController@verify');
    Route::post('password/reset', 'ResetPasswordController@reset');

    // Verify email
    Route::get('email/verify/{id}', 'VerificationController@verify')->name('api.verification.verify')->middleware('signed');

    Route::group(['middleware' => 'auth:api'], function () {
        // Resend email verification
        Route::get('email/resend', 'VerificationController@resend');

        // Logout
        Route::post('logout', 'LoginController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
    // User
    Route::post('user', 'UserController@update');

    // Change password
    Route::post('change-password', 'ChangePasswordController@update');

    // Profile
    Route::get('me', 'ProfileController@show');
    Route::post('me', 'ProfileController@update');

    // File
    Route::post('upload', 'FileController@upload')->name('file.upload');

    // Payment
    Route::group(['prefix' => 'payment'], function () {
        Route::post('subscription/create', 'StripePaymentController@createSubscription');
        Route::get('payment-method/list', 'StripePaymentController@getListPaymentMethod');
        Route::get('payment-method/retrieve', 'StripePaymentController@retrievePaymentMethod');
        Route::post('payment-method/update', 'StripePaymentController@updatePaymentMethod');
        Route::post('payment-method/attach', 'StripePaymentController@attachPaymentMethod');
        Route::post('payment-method/detach', 'StripePaymentController@detachPaymentMethod');
    });
});

// Payment
Route::group(['prefix' => 'payment'], function () {
    Route::post('webhook', 'StripeWebhookController@handleWebhook');
    Route::post('token/create', 'StripePaymentController@createToken');
    Route::post('payment-method/create', 'StripePaymentController@createPaymentMethod');
    Route::post('charge/create', 'StripePaymentController@createCharge');
});

// PUBLIC api for aws
Route::group(['namespace' => 'Aws', 'prefix' => 'aws'], function () {
    // media convert subscribe
    Route::any('mediaconvert/subscriber', 'McSubscriberController@subscribe')
        ->name('aws.mc.subscriber');
});
