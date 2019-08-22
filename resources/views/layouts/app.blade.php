<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('components.head')
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('blog.google_tag_id') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="app">
        @include('components.newnav')
        @yield('above_container')
        <div class="container">
            <div class="row justify-content-center mt-5">
                <main class="col-md-6 order-md-6">
                    @yield('content')
                </main>
                <div class="col-md-3 order-md-12">
                    @section('sidebar')
                    @if( config('blog.instagram_username'))
                    {{ config('app.name') }} on <a href="{{config('blog.instagram_url')}}">Instagram</a>
                    <br>
                    @endif
                    @if( config('blog.facebook_page_username'))
                    {{ config('app.name') }} on <a href="{{config('blog.facebook_page_url')}}">Facebook</a>
                    <br>
                    @endif
                    @if(!Auth::check())
                    <hr>
                    <p>Already a client? <a href="/register">Log in</a>.</p>
                    @endif
                    @show
                </div>
                <div class="col-md-3 order-md-1">
                    @yield('left_sidebar')
                </div>
            </div>
        </div>
        <div class="footer d-flex justify-content-around">
            <small>
                <a href="/about" class="text-white">About</a>
                <a href="/privacy-policy" class="text-white">Privacy policy</a>
                <a href="/terms-and-conditions" class="text-white">Terms and conditions</a>
            </small>
        </div>
    </div>
    @include('components.footer')
