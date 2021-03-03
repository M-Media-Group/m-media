<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     @include('components.head')
</head>
@if(isset($background_image))
    <body style="background-image: url('{{$background_image}}')">
@else
    <body>
@endif
     <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('blog.google_tag_id') }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @yield('opening_body')
    <div id="app">
        @include('components.newnav')
        @yield('above_container')
        @if(View::hasSection('content'))
            <div class="container u-limit-max-width" style="margin-top:3rem;">
                <div class="row">
                    <transition name="fade">
                    <div class="twelve columns u-center">
                        @yield('content')
                    </div>
                    </transition>
                </div>
            </div>
        @endif
        <div class="footer u-center-text">
            <small>
                <a href="/about" class="text-white">About</a> |
                <a href="/privacy-policy" class="text-white">Privacy policy</a> |
                <a href="/terms-and-conditions" class="text-white">Terms and conditions</a> |
                <a href="/frequently-asked-questions" class="text-white">FAQ</a> |
                <a href="/sitemap" class="text-white">Sitemap</a> |
                <a href="/contact" class="text-white">Contact us</a>
            </small>
        </div>
    </div>
@include('components.footer')
