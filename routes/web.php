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

Route::get('/web-development/entrepreneurs', function () {
    return view('entrepreneur');
});
// Route::get('/web-development/restaurateurs', function () {
//     return view('restaurateur');
// });

Route::get('/instagram', function () {
    return view('instagram');
});

Route::get('/sitemap', function () {
    return view('sitemap');
});

Route::get('/frequently-asked-questions', function () {
    return view('faq');
});

Route::get('/pricing', function () {
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    $plans = \Stripe\Plan::all(['expand' => ['data.product']]);
    $products = \Stripe\Sku::all(['expand' => ['data.product']]);
    $coupons = \Stripe\Coupon::all();
    //return $coupons;
    return view('pricing', compact('plans', 'products', 'coupons'));
});

Route::get('/case-studies', function () {
    return view('caseStudies');
});

// Route::get('/mail', function () {
//     return new App\Mail\BotOffline();
// });

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/web-development', 'ProductController@webdev');

Route::get('/instagram-engagement', 'ProductController@engagement');

Route::get('/instagram-content-management', 'ProductController@contentCreation');

Route::get('/instagram-account-analyzer', 'ProductController@instagramAnalysis');

//Route::get('/product-packaging', 'ProductController@packaging');

Route::get('/automation-bot', 'ProductController@bot');

Route::get('/case-studies/justbookr', 'CaseStudyController@justbookr');

Route::get('/case-studies/breathe-as-one-festival', 'CaseStudyController@breatheAsOne');

Route::get('/case-studies/nicolas-pisani-real-estate-agents', 'CaseStudyController@nicolasPisani');

Route::get('/privacy-policy', function () {
    return view('privacy');
});

Route::get('/terms-and-conditions', function () {
    return view('toc');
});

Route::get('/about', function () {
    return view('about');
});

Route::post(
    'stripe/webhook',
    '\App\Http\Controllers\StripeWebhookController@handleWebhook'
);

Auth::routes(['register' => false, 'verify' => true]);

Route::get('/tools/instagram-account-analyzer', function () {
    return view('instagramAccountSelector');
});
Route::get('/tools/instagram-account-analyzer/{username}', 'InstagramScrapeController@index')->middleware('throttle:10,1');

Route::get('/tools/website-debugger/{url}', 'WebsiteScrapeController@index')->middleware('throttle:10,1');

Route::get('/tools/phone-debugger/{number}', 'PhoneLogController@index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/notifications', function () {
        return view('notifications');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('users', 'UserController');
});

Route::group(['middleware' => ['verified']], function () {
    Route::get('my-bots', 'UserController@myBots');
    Route::get('users/{id}/billing', 'UserController@invoices');
    Route::get('users/{user}/payment-methods/sepas/create', function (App\User $user) {
        //$user = $request->user();
        $intent = $user->createSetupIntent([
            'payment_method_types' => ['sepa_debit'],
        ]);

        return view('createIban', compact('user', 'intent'));
    });

    Route::get('/my-account/billing', function () {
        return Redirect::to('/users/' . Auth::id() . '/billing', 301);
    });

    Route::get('/domains/check-availability', function () {
        return view('domains.checkAvailability');
    });

    Route::get('invoices/{id}/pdf', 'InvoiceController@redirectToStripeInvoice');
    Route::get('bots/{id}/connect', 'BotController@connect');
    Route::get('bots/{id}/contact-user', 'BotController@contactUser');
    Route::post('/instagram-accounts/{instagramAccount}/instagram-posts', 'InstagramAccountController@storePost');
    Route::resource('custom-notifications', 'CustomNotificationController');
    Route::resource('roles', 'RoleController');
    Route::resource('bots', 'BotController');
    Route::resource('files', 'FileController');
    Route::resource('emails', 'EmailController');
    Route::resource('phones', 'PhoneController');
    Route::resource('email-logs', 'EmailLogController');
    Route::resource('phone-logs', 'PhoneLogController');
    Route::resource('instagram-accounts', 'InstagramAccountController');
});

Route::get('/', function () {
    return View::make('welcome');
});

Route::get('/covid-19', function () {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://covid-api.mmediagroup.fr/dev/cases');
    $response = json_decode($request->getBody(), true);
    $request = $client->get('https://covid-api.mmediagroup.fr/v1/history?status=Confirmed');
    $response_2 = json_decode($request->getBody(), true);
    //return $response;
    return View::make('covid', ['cases' => $response, 'history' => $response_2]);
});
