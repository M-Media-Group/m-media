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
    $middlewareName = "api";
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

//Route::resource('users', 'UserController');

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('files', 'FileController');

    Route::apiResource('bots', 'BotController');
});

Route::group(['middleware' => ['client']], function () {

    Route::apiResource('phone-logs', 'PhoneLogController');

    Route::apiResource('email-logs', 'EmailLogController');

});
