<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '134243171665-dk78i1urlusb58h9pvoln513s7lavnqs.apps.googleusercontent.com',
        'client_secret' => '42GhZh8WCF5tzULSRrFfU2Nq',
//        'redirect' => 'http://web-2oclock.herokuapp.com/auth/google/callback',
//        'redirect' => 'http://dev.toang.com/auth/google/callback',
        'redirect' => env('GOOGLE_REDIRECT')
    ],
];
