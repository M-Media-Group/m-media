<?php

return [
    //Environment=> test/production
    'env' => env('APP_ENV'),
    //Google Ads

    // Issue with caching config, reported here: https://github.com/Edujugon/laravel-google-ads/issues/47
    'production' => [
        'developerToken' => env('GOOGLE_ADS_DEVELOPER_TOKEN', config('google-ads.test.developerToken')),
        'clientCustomerId' => env('GOOGLE_ADS_CUSTOMER_ID', config('google-ads.test.clientCustomerId')),
        'userAgent' => env('APP_NAME'),
        'clientId' => env('GOOGLE_ADS_CLIENT_ID', config('google-ads.test.clientId')),
        'clientSecret' => env('GOOGLE_ADS_CLIENT_SECRET', config('google-ads.test.clientSecret')),
        'refreshToken' => env('GOOGLE_ADS_REFRESH_TOKEN', config('google-ads.test.refreshToken')),
    ],
    'local' => [
        'developerToken' => env('GOOGLE_ADS_DEVELOPER_TOKEN'),
        'clientCustomerId' => env('GOOGLE_ADS_CUSTOMER_ID'),
        'userAgent' => env('APP_NAME'),
        'clientId' => env('GOOGLE_ADS_CLIENT_ID'),
        'clientSecret' => env('GOOGLE_ADS_CLIENT_SECRET'),
        'refreshToken' => env('GOOGLE_ADS_REFRESH_TOKEN'),
    ],
    'oAuth2' => [
        'authorizationUri' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'redirectUri' => 'urn:ietf:wg:oauth:2.0:oob',
        'tokenCredentialUri' => 'https://www.googleapis.com/oauth2/v4/token',
        'scope' => 'https://www.googleapis.com/auth/adwords',
    ],
];
