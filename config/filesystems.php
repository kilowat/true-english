<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'audio' => [
            'driver' => 'local',
            'root' => storage_path('app/public/audio'),
            'url' => env('APP_URL').'/storage/audio',
            'visibility' => 'public',
        ],
        'anki' => [
            'driver' => 'local',
            'root' => storage_path('app/public/anki'),
            'url' => env('APP_URL').'/storage/anki',
            'visibility' => 'public',
        ],
        'excel' => [
            'driver' => 'local',
            'root' => storage_path('app/public/excel'),
            'url' => env('APP_URL').'/storage/excel',
            'visibility' => 'public',
        ],
        'custom' => [
            'driver' => 'local',
            'root' => storage_path('app/public/custom'),
            'url' => env('APP_URL').'/storage/custom',
            'visibility' => 'public',
        ],
        'audio_archive' => [
            'driver' => 'local',
            'root' => storage_path('app/public/audio_archive'),
            'url' => env('APP_URL').'/storage/audio_archive',
            'visibility' => 'public',
        ],
        'phrases' => [
            'driver' => 'local',
            'root' => storage_path('app/public/phrases'),
            'url' => env('APP_URL').'/storage/phrases',
            'visibility' => 'public',
        ],
        'forvo' => [
            'driver' => 'local',
            'root' => storage_path('app/public/forvo'),
            'url' => env('APP_URL').'/storage/forvo',
            'visibility' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],
        'google' => [
            'driver' => 'google',
            'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
            'folderId' => env('GOOGLE_DRIVE_FOLDER_ID'),
        ],
        'db_backup' => [
            'driver' => 'local',
            'root' => storage_path('app/db_backup'),
            'url' => env('APP_URL').'/storage/db_backup',
            'visibility' => 'private',
        ],
    ],

];
