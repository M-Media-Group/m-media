<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    $routeCollection = Route::getRoutes();
    $middlewareName = 'api';
    $routeHasFilter = collect();

    foreach ($routeCollection as $route) {
        $middleware = $route->middleware();
        if (count($middleware) > 0) {
            if (in_array($middlewareName, $middleware)) {
                $routeHasFilter->push($route);
            }
        }
    }

    return $routeHasFilter;

    $result = $routeHasFilter->map(function ($route) {
        return $route->only(['uri', 'methods']);
    });

    return $result;
});

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|max:55',
        'surname' => 'required|max:55',
        'email' => 'required|email',
        'phone' => 'nullable|min:5|max:31',
        'message' => 'required',
    ]);
    $user = \App\User::where('id', config('blog.super_admin_id'))->firstOrFail();
    App\Jobs\SaveEmail::dispatch(['email' => $request->input('email')], true);
    $phone = null;
    if ($request->input('phone')) {
        $input['phonenumber'] = $request->input('phone');
        $phone = App\Jobs\SavePhone::dispatchNow($input);
        if (! isset($phone->e164)) {
            abort(422, 'The phone number is invalid');
        }
        $phone = $phone->e164;
    }

    Notification::route('mail', $request->input('email'))->notify(new App\Notifications\CustomNotification(
        [
            'send_email' => 1,
            'title' => 'Hi '.$request->input('name').'!',
            'message' => "Thanks for messaging us! We've received your message and we'll be getting back to you as soon as possible on this email address.",
        ]
    ));

    return $user->notify(new App\Notifications\CustomNotification(
        [
            'send_email' => 1,
            'send_database' => 1,
            'title' => 'New contact request from '.$request->input('name').' '.$request->input('surname'),
            'message' => 'Email: '.$request->input('email')."\n\n Phone: ".$phone."\n\n Message: ".$request->input('message'),
        ]
    ));
});
//Route::get('categories', 'CategoryController@index');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
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

    Route::get('/domains/{domain}/availability', function ($domain) {
        $sms = AWS::createClient('Route53Domains', ['region' => 'us-east-1']);

        return response()->json(['availability' => $sms->checkDomainAvailability(['DomainName' => $domain])->get('Availability')]);
    });

    Route::get('/domains/{domain}/suggestions', function ($domain) {
        $sms = AWS::createClient('Route53Domains', ['region' => 'us-east-1']);
        $list = $sms->GetDomainSuggestions(['DomainName' => $domain, 'OnlyAvailable' => true, 'SuggestionCount' => 50])->get('SuggestionsList');
        $new_list = [];
        foreach ($list as $item) {
            //$new_list[strstr($item['DomainName'], '.')][]['domain'] = $item['DomainName'];
            $new_list[] = ['domain' => $item['DomainName'], 'tld' => strstr($item['DomainName'], '.')];
        }

        return response()->json(['suggestions' => $new_list]);
    });
    Route::post('/phones/{phone}/call', function (App\Phone $phone, Request $request) {
        if (Gate::denies('call', $phone)) {
            abort(403, 'Unauthorized action.');
        }
        $client = AWS::createClient('Connect', ['region' => 'eu-central-1']);

        return response()->json([
            'availability' => $client->startOutboundVoiceContact([
                'Attributes' => [
                    'name' => $phone->primaryUser ? $phone->primaryUser->name : $phone->user->name,
                    'message' => '<speak>'.$request->input('message', '').'</speak>',
                    'transfer' => $request->input('transfer', 'false'),
                ],
                //'ClientToken' => '<string>',
                'ContactFlowId' => config('aws.connect.ContactFlowId'), // REQUIRED
                'DestinationPhoneNumber' => $phone->e164, // REQUIRED
                'InstanceId' => config('aws.connect.InstanceId'), // REQUIRED
                'QueueId' => config('aws.connect.QueueId'),
                //'SourcePhoneNumber' => '<string>',
            ]),
        ]);
    });

    Route::get('users/{id}/notifications', function (Request $request, $id) {
        $user = App\User::findOrFail($id);

        if ($request->user()->cant('show', $user)) {
            abort(403, 'Unauthorized action.');
        }

        $notifications = $user->notifications;
        //$user->unreadNotifications->markAsRead();

        return $notifications;
    });
});

Route::group(['middleware' => ['client']], function () {
    Route::apiResource('phone-logs', 'PhoneLogController');

    Route::apiResource('email-logs', 'EmailLogController');

    Route::post('files/upload-from-email', 'FileController@storeFromEmail');

    Route::get('/domains', function ($domain) {
        $sms = AWS::createClient('Route53Domains', ['region' => 'us-east-1']);

        return $sms->listDomains()->get('Domains');
    });
});
