<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Contants For The Application
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the default constants below you wish
    | to use as your default constants for the application.
    |
     */

    'allow_file_extension' => 'jpeg,gif,jpg,png,mp4,mov,mp3,ogg,m4a,aac',
    'mimes' => [
        'mp4' => 'video/mp4',
        '3gp' => 'video/3gpp',
        'mov' => 'video/quicktime',
        'avi' => 'video/avi',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'mp3' => 'audio/mpeg',
        'ogg' => 'audio/ogg',
        'm4a' => 'audio/mp4',
        'aac' => 'audio/aac',
    ],
    'image_file_extensions' => [
        'jpeg',
        'gif',
        'jpg',
        'png',
    ],
    'audio_file_extensions' => [
        'mp3',
        'ogg',
        'm4a',
        'aac',
    ],
    'video_file_extensions' => [
        'mp4',
        'mov',
    ],
    'file_type' => [
        'image' => 0,
        'audio' => 1,
        'video' => 2,
    ],
    'file_type_extensions' => [
        'mp4' => 'video',
        '3gp' => 'video',
        'mov' => 'video',
        'avi' => 'video',
        'png' => 'image',
        'jpg' => 'image',
        'jpeg' => 'image',
        'gif' => 'image',
        'mp3' => 'audio',
        'ogg' => 'audio',
        'm4a' => 'audio',
        'aac' => 'audio',
    ],
    'transcode_extension' => 'mp4',
    'expire_link_duration' => 1800, // 30mins
    'video_upload_folder' => 'videos',
    'image_upload_folder' => 'images',
    'audio_upload_folder' => 'audios',
    'other_upload_folder' => 'others',
    'path' => [
        'user' => [
            'avatar' => 'users/avatars/',
        ],
    ],
    'resize' => [
        'thumbnail' => [
            'width' => 300,
            'height' => 300,
        ],
        'mobile' => [
            'width' => 300,
            'height' => 300,
        ],
    ],
    'pagination' => 15,
    'video_convert_status' => [
        'init' => 0,
        'error' => 1,
        'complete' => 2,
    ],

];
