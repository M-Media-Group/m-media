<?php

return [
    //Environment=> test/production
    'env' => 'test',
    //Google Ads
    'production' => [
        'developerToken' => 'YOUR-DEV-TOKEN',
        'clientCustomerId' => 'CLIENT-CUSTOMER-ID',
        'userAgent' => 'YOUR-NAME',
        'clientId' => 'CLIENT-ID',
        'clientSecret' => 'CLIENT-SECRET',
        'refreshToken' => 'REFRESH-TOKEN',
    ],
    'test' => [
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
