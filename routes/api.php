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

//Route::get('categories', 'CategoryController@index');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('files', 'FileController');

    Route::apiResource('bots', 'BotController');

    Route::apiResource('users', 'UserController');

    Route::apiResource('invoices', 'InvoiceController');
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
                    'name'     => $phone->primaryUser ? $phone->primaryUser->name : $phone->user->name,
                    'message'  => '<speak>'.$request->input('message', '').'</speak>',
                    'transfer' => $request->input('transfer', 'false'),
                ],
                //'ClientToken' => '<string>',
                'ContactFlowId'          => config('aws.connect.ContactFlowId'), // REQUIRED
                'DestinationPhoneNumber' => $phone->e164, // REQUIRED
                'InstanceId'             => config('aws.connect.InstanceId'), // REQUIRED
                'QueueId'                => config('aws.connect.QueueId'),
                //'SourcePhoneNumber' => '<string>',
            ]),
        ]);
    });
});

Route::group(['middleware' => ['client']], function () {
    Route::apiResource('phone-logs', 'PhoneLogController');

    Route::apiResource('email-logs', 'EmailLogController');

    Route::get('/domains', function ($domain) {
        $sms = AWS::createClient('Route53Domains', ['region' => 'us-east-1']);

        return $sms->listDomains()->get('Domains');
    });
});
