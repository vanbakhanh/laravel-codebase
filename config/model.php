<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Contants For The Application
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the default constants below you wish
    | to use as your default constants for the application.
    |
    */

    'user' => [
        'status' => [
            'active' => 1,
            'inactive' => 0,
        ],
    ],

    'profile' => [
        'gender' => [
            'value' => [
                'male' => 0,
                'female' => 1,
                'other' => 2,
            ],
            'text' => [
                0 => 'Male',
                1 => 'Female',
                2 => 'Other',
            ],
        ],
        'avatar_default' => 'default.png',
    ],

];
