<?php

use Illuminate\Http\Request;

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

Route::get('/instagram', function () {
    return view('instagram');
});

// Route::get('/mail', function () {
//     return new App\Mail\BotOffline();
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

#Route::get('/web-development', 'ProductController@webdev');

#Route::resource('/phone', 'PhoneLogController');

Route::get('/instagram-engagement', 'ProductController@engagement');

Route::get('/instagram-content-management', 'ProductController@contentCreation');

#Route::get('/product-packaging', 'ProductController@packaging');

Route::get('/automation-bot', 'ProductController@bot');

Route::get('/privacy-policy', function () {
    return view('privacy');
});

Route::get('/terms-and-conditions', function () {
    return view('toc');
});

// Route::get('/apply', function () {
//     return view('write');
// })->middleware('auth');

Route::get('/about', function () {
    return view('about');
});

Route::get('/notifications', function () {
    return view('notifications');
})->middleware('auth');

Route::post(
    'stripe/webhook',
    '\App\Http\Controllers\StripeWebhookController@handleWebhook'
);

Auth::routes(['register' => false, 'verify' => true]);

Route::get('user/invoice/{invoice}', function (Request $request, $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor' => 'M Media',
        'product' => 'M Media Goods and Services',
    ]);
})->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/tools/instagram-account-debugger', function () {
    return view('instagramAccountSelector');
});
Route::get('/tools/instagram-account-debugger/{username}', 'InstagramScrapeController@index')->middleware('throttle:10,1');

Route::get('/tools/website-debugger/{username}', 'WebsiteScrapeController@index')->middleware('throttle:10,1');

//Route::resource('posts', 'PostController');

#Route::resource('categories', 'CategoryController');

Route::resource('users', 'UserController')->middleware('auth');

Route::resource('custom-notifications', 'CutomNotificationController')->middleware('auth');

Route::resource('instagram-accounts', 'InstagramAccountController')->middleware('auth');

Route::get('my-bots', 'UserController@myBots')->middleware('auth');

Route::get('users/{id}/invoices', 'UserController@invoices')->middleware('auth');

#Route::post('me/apply/reporter', 'UserController@applyForReporter');

Route::resource('roles', 'RoleController')->middleware('auth');
Route::resource('bots', 'BotController')->middleware('auth');
Route::get('bots/{id}/connect', 'BotController@connect')->middleware('auth');
Route::get('bots/{id}/contact-user', 'BotController@contactUser')->middleware('auth');

#Route::resource('incidents', 'IncidentController');

Route::get('{slug?}', function () {
    // //http://feeds.bbci.co.uk/news/world/rss.xml
    // $feed = Feeds::make(array(
    //     'https://www.reddit.com/r/breakingnews/.rss', 'https://www.reddit.com/r/news/.rss', 'http://feeds.bbci.co.uk/news/world/rss.xml', 'https://news.google.com/rss/topics/CAAqJggKIiBDQkFTRWdvSUwyMHZNRGx1YlY4U0FtVnVHZ0pWVXlnQVAB?hl=en-US&gl=US&ceid=US:en',
    // ));
    // $data = array(
    //     'title' => $feed->get_title(),
    //     'permalink' => $feed->get_permalink(),
    //     'items' => $feed->get_items(),
    // );

    return View::make('welcome');
});
