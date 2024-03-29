<?php

return [

    //Analytics
    'google_tag_id' => env('GOOGLE_TAG_ID', null),

    //Area data
    'area_name' => env('APP_AREA_NAME', 'Villefranche sur Mer'),
    'area_short_name' => env('APP_AREA_SHORT_NAME', 'Villefranche'),

    //App branding
    'logo_url' => env('LOGO_URL', '/images/logo.svg'),
    'logo_png_url' => env('LOGO_PNG_URL', '/images/logo.png'),

    'favicon_url' => env('FAVICON_URL', '/favicon.ico'),

    //App social media
    'instagram_username' => env('APP_INSTAGRAM_USERNAME', null),
    'instagram_password' => env('APP_INSTAGRAM_PASSWORD', null), // used by instagram-user-feed for logging into insta to scrape other insta accounts
    'instagram_url' => 'https://instagram.com/'.env('APP_INSTAGRAM_USERNAME', null),
    'facebook_page_username' => env('APP_FACEBOOK_PAGE_USERNAME', null),
    'facebook_page_url' => 'https://fb.me/'.env('APP_FACEBOOK_PAGE_USERNAME', null),
    'messenger_url' => 'https://m.me/'.env('APP_FACEBOOK_PAGE_USERNAME', null),
    'fb_app_id' => env('FB_APP_ID', null),

    //A role that can not be deleted and always has all rights
    'super_admin_id' => env('APP_SUPER_ADMIN_ID', 1),

    //Country for Terms and Coonditions
    'country_name' => env('APP_COUNTRY_NAME', 'France'),

    'e164' => env('COMPANY_E164', null),
    'address' => env('COMPANY_ADDRESS', null),
    'city' => env('COMPANY_CITY', null),
    'postal_code' => env('COMPANY_POSTAL_CODE', null),
    'country_iso' => env('COMPANY_COUNTRY_ISO', null),

    //Remote IT settings
    'remoteit' => [
        'username' => env('REMOTEIT_EMAIL', null),
        'password' => env('REMOTEIT_PASSWORD', null),
        'developerkey' => env('REMOTEIT_KEY', null),
    ],

    //Buffer settings
    'buffer' => [
        'access_token' => env('BUFFER_ACCESS_TOKEN', null),
    ],
];
