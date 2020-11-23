<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//Route::get('/', 'PostController@index');

// Route::get('/print-media', function () {
//     return view('print');
// });

Route::get('/web-development/entrepreneurs', 'HomeController@entrepreneur');
// Route::get('/web-development/restaurateurs', function () {
//     return view('restaurateur');
// });

Route::get('/instagram', 'HomeController@instagram');

Route::get('/sitemap', 'HomeController@sitemap');

Route::get('/frequently-asked-questions', 'HomeController@faq');

Route::get('/pricing', 'HomeController@pricing');

Route::get('/case-studies', 'HomeController@caseStudies');

// Route::get('/mail', function () {
//     return new App\Mail\BotOffline();
// });

Route::get('/contact', 'HomeController@contact');

Route::get('/web-development', 'ProductController@webdev');

Route::get('/digital-ads', 'ProductController@digitalads');

Route::get('/instagram-engagement', 'ProductController@engagement');

Route::get('/instagram-content-management', 'ProductController@contentCreation');

Route::get('/instagram-account-analyzer', 'ProductController@instagramAnalysis');

//Route::get('/product-packaging', 'ProductController@packaging');

Route::get('/automation-bot', 'ProductController@bot');

Route::get('/case-studies/justbookr', 'CaseStudyController@justbookr');

Route::get('/case-studies/breathe-as-one-festival', 'CaseStudyController@breatheAsOne');

Route::get('/case-studies/nicolas-pisani-real-estate-agents', 'CaseStudyController@nicolasPisani');

Route::get('/privacy-policy', 'HomeController@privacy');

Route::get('/terms-and-conditions', 'HomeController@toc');

Route::get('/about', 'HomeController@about');

Route::post(
    'stripe/webhook',
    '\App\Http\Controllers\StripeWebhookController@handleWebhook'
);

Auth::routes(['register' => false, 'verify' => true]);

Route::get('/tools/instagram-account-analyzer', 'InstagramScrapeController@showSelector');

Route::get('/tools/instagram-account-analyzer/{username}', 'InstagramScrapeController@index')->middleware('throttle:10,1');

Route::get('/tools/website-debugger/{url}', 'WebsiteScrapeController@index')->middleware('throttle:10,1');

Route::get('/tools/phone-debugger/{number}', 'PhoneLogController@index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/notifications', 'CustomNotificationController@index');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('users', 'UserController');
});

Route::group(['middleware' => ['verified']], function () {
    Route::get('my-bots', 'UserController@myBots');
    Route::get('users/{id}/billing', 'UserController@invoices');
    // Route::get('users/{user}/payment-methods/sepas/create', function (App\User $user) {
    //     $intent = $user->createSetupIntent([
    //         'payment_method_types' => ['sepa_debit'],
    //     ]);
    //     return view('createIban', compact('user', 'intent'));
    // });

    Route::get('/my-account/billing', 'HomeController@billing');

    Route::get('/domains/check-availability', 'HomeController@domainAvailability');

    Route::get('invoices/{id}/pdf', 'InvoiceController@redirectToStripeInvoice');
    Route::get('bots/{id}/connect', 'BotController@connect');
    Route::get('bots/{id}/contact-user', 'BotController@contactUser');
    Route::post('/instagram-accounts/{instagramAccount}/instagram-posts', 'InstagramAccountController@storePost');
    Route::resource('custom-notifications', 'CustomNotificationController');
    Route::resource('ad-accounts', 'AdAccountController');
    Route::resource('roles', 'RoleController');
    Route::resource('bots', 'BotController');
    Route::resource('files', 'FileController');
    Route::resource('emails', 'EmailController');
    Route::resource('phones', 'PhoneController');
    Route::resource('email-logs', 'EmailLogController');
    Route::resource('phone-logs', 'PhoneLogController');
    Route::resource('instagram-accounts', 'InstagramAccountController');
    Route::post('/ad-platforms/facebook/ads/{id}/update-tags', 'AdAccountController@updateFacebookAdTags');
});

Route::get('/', 'HomeController@welcome');

// Route::get('/components', 'HomeController@components');

Route::get('/covid-19', 'HomeController@covid');
