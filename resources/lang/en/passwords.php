<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'reset' => 'Your password has been reset!',
    'sent' => 'We have emailed your password reset link!',
    'throttled' => 'Please wait before retrying.',
    'token' => 'This password reset token is invalid.',
    'user' => "We can't find a user with that email address.",
    'incorrect' => 'The current password you entered is incorrect.',
    'changed' => 'Your password has been changed.',
    'email_reset' => [
        'greeting' => 'Hello!',
        'reason' => 'You are receiving this email because we received a password reset request for your account.',
        'token' => 'Your password reset code is: :token',
        'expired' => 'This password reset token will expire in :minutes minutes.',
        'remind' => 'If you did not request a password reset, no further action is required.',
    ],
    'email_create' => [
        'subject' => 'Created Account In CodeBase',
        'greeting' => 'Hello!',
        'reason' => 'We have just created you an account in Codebase',
        'password' => 'This is your password: :password' 
    ]
];
