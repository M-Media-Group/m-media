<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('components.head')
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('blog.google_tag_id') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v4.0'
      });
    };

    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
        attribution=setup_tool
        page_id="1640199049612220"
  theme_color="#eb4647">
    </div>
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
                    <p>Already a client? <a href="/login">Log in</a>.</p>
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
                <a href="/about" class="text-white" title="About {{config('app.name')}}">About</a>
                <a href="/privacy-policy" class="text-white" title="Privacy policy">Privacy policy</a>
                <a href="/terms-and-conditions" class="text-white" title="Terms and conditions">Terms and conditions</a>
            </small>
        </div>
    </div>
    @include('components.footer')
