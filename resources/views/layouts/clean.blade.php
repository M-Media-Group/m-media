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
            <div class="container p-0">
                <div class="row m-0 p-0 mt-5">

                    <div class="col-md-12" style="max-width: 700px;">
                        @yield('content')
                    </div>

                </div>
            </div>
        @endif
        <div class="footer d-flex justify-content-around">
            <small>
                <a href="/about" class="text-white">About</a>
                <a href="/privacy-policy" class="text-white">Privacy policy</a>
                <a href="/terms-and-conditions" class="text-white">Terms and conditions</a>
            </small>
        </div>
    </div>
@include('components.footer')
