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

Route::post('/contact', 'HomeController@sendContactRequest');

//Route::get('categories', 'CategoryController@index');

Route::get('/domains/{domain}/transferability', 'DomainController@checkTransferability');

Route::get('/domains/{domain}/availability', 'DomainController@checkAvailability');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', 'UserController@showSelf');

    Route::apiResource('files', 'FileController');

    Route::apiResource('bots', 'BotController');

    Route::apiResource('users', 'UserController');

    Route::apiResource('invoices', 'InvoiceController');

    Route::apiResource('countries', 'CountryController');

    Route::apiResource('addresses', 'AddressController');

    Route::get('invoices/{id}/pdf', 'InvoiceController@redirectToStripeInvoice');
    Route::get('users/{id}/future-invoice', 'InvoiceController@showFuture');

    Route::apiResource('subscriptions', 'SubscriptionController');

    Route::post('/users/{user}/update-card', 'UserController@updateCard');

    Route::get('/domains/{domain}/suggestions', 'DomainController@suggest');

    Route::post('/domains/{domain}/transfer', 'DomainController@transfer');

    Route::post('/phones/{phone}/call', 'PhoneController@call');

    Route::post('users/{id}/notifications', 'UserController@notifications');

});

Route::group(['middleware' => ['client']], function () {
    Route::apiResource('phone-logs', 'PhoneLogController');

    Route::apiResource('email-logs', 'EmailLogController');

    Route::post('files/upload-from-email', 'FileController@storeFromEmail');

    Route::get('/domains', 'DomainController@index');
});
