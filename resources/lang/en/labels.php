<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'All',
        'yes'     => 'Yes',
        'no'      => 'No',
        'custom'  => 'Custom',
        'actions' => 'Actions',
        'active'  => 'Active',
        'confirmed' => 'Confirm New Password',
        'confirmed_delete' => 'Would you like to delete?',
        'buttons' => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'              => 'Hide',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'users' => [
            'email'        => 'E-mail',
            'password'     => 'Password',
            'active'       => 'Active',
            'inactive'     => 'Inactive',
            'placeholder' => [
                'email'        => 'Enter email',
                'password'     => 'Password',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name'
            ],
            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'last_updated'       => 'Last Updated',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'address'            => 'Address',
                'state'              => 'State',
                'city'               => 'City',
                'zipcode'            => 'Zip Code',
                'ssn'                => 'SSN',
                'update_information' => 'Update Information',
            ],

        ],
    ],

    'admin' => [
        'profile_updated' => 'Your profile has been updated.',
        'roles' => [
            'create'     => 'Create Role',
            'edit'       => 'Edit Role',
            'management' => 'Role Management',

            'table' => [
                'number_of_users' => 'Number of Users',
                'permissions'     => 'Permissions',
                'role'            => 'Role',
                'sort'            => 'Sort',
                'total'           => 'role total|roles total',
            ],
        ],

        'permissions' => [
            'create'     => 'Create Permission',
            'edit'       => 'Edit Permission',
            'management' => 'Permission Management',

            'table' => [
                'permission'   => 'Permission',
                'display_name' => 'Display Name',
                'sort'         => 'Sort',
                'status'       => 'Status',
                'total'        => 'role total|roles total',
            ],
        ],

        'users' => [
            'active'              => 'Active Users',
            'all_permissions'     => 'All Permissions',
            'change_password'     => 'Change Password',
            'change_password_for' => 'Change Password for :user',
            'create'              => 'Create User',
            'deactivated'         => 'Deactivated Users',
            'deleted'             => 'Deleted Users',
            'edit'                => 'Edit User',
            'edit-profile'        => 'Edit Profile',
            'management'          => 'User Management',
            'no_permissions'      => 'No Permissions',
            'no_roles'            => 'No Roles to set.',
            'permissions'         => 'Permissions',

            'table' => [
                'confirmed'      => 'Confirmed',
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'last_name'      => 'Last Name',
                'no_deactivated' => 'No Deactivated Users',
                'no_deleted'     => 'No Deleted Users',
                'roles'          => 'Roles',
                'total'          => 'user total|users total',
            ],

            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history'  => 'History',
                ],

                'content' => [
                    'overview' => [
                        'name'         => 'Name',
                        'avatar'       => 'Avatar',
                        'gender'       => 'Gender',
                        'confirmed'    => 'Confirmed',
                        'created_at'   => 'Created At',
                        'updated_at'   => 'Updated At',
                        'deleted_at'   => 'Deleted At',
                        'email'        => 'E-mail',
                        'last_updated' => 'Last Updated',
                        'name'         => 'Name',
                        'status'       => 'Status',
                    ],
                ],
            ],

            'view' => 'View User',
        ],

        'pages' => [
            'create'     => 'Create Page',
            'edit'       => 'Edit Page',
            'management' => 'Page Management',
            'title'      => 'Pages',

            'table' => [
                'title'     => 'Title',
                'status'    => 'Status',
                'createdat' => 'Created At',
                'updatedat' => 'Updated At',
                'createdby' => 'Created By',
                'all'       => 'All',
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'Register',
            'remember_me'        => 'Remember Me',
        ],

        'passwords' => [
            'forgot_password'                 => 'Forgot Your Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'macros' => [
            'country' => [
                'alpha'   => 'Country Alpha Codes',
                'alpha2'  => 'Country Alpha 2 Codes',
                'alpha3'  => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us'     => [
                    'us'       => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed'    => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'last_updated'       => 'Last Updated',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'address'            => 'Address',
                'state'              => 'State',
                'city'               => 'City',
                'zipcode'            => 'Zip Code',
                'ssn'                => 'SSN',
                'update_information' => 'Update Information',
            ],
        ],

    ],
];
