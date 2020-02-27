@extends('layouts.clean')
@section('title', __('Sitemap'))
@section('meta_description', "All pages on ".config('app.name')." website. Explore links for web development and digital marketing in the South of France." )

@section('content')
@php
// $routes = Route::getRoutes()->getRoutesByMethod()['GET'];
// return dump($routes);

$routeCollection = Route::getRoutes()->getRoutesByMethod()['GET'];
$middlewareName = "web";
$routeHasFilter = [];

foreach ($routeCollection as $route)
{
    $middleware = $route->middleware();
    if (count($middleware) == 1)
    {
        if (in_array($middlewareName, $middleware))
        {
            $routeHasFilter[] = $route;
        }
    }
}
//return dump($routeHasFilter);
@endphp
<h1>Sitemap</h1>
<p>{{count($routeHasFilter)}} pages</p>
@foreach(collect($routeHasFilter)->sortBy('uri') as $route)
<div>
<a href="/{{ltrim($route->uri, "/")}}">
{{ ucwords(str_replace('-', ' ', str_replace("/", " › ", $route->uri))) }}
</a>
</div>
@endforeach
@endsection
