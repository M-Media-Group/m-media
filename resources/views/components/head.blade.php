<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<title>@yield('title', 'Marketing and Web Development on the French Riviera') | {{ config('app.name') }}</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="keywords" content="{{ config('app.name') }},@yield('meta_keywords')">
<meta name="description" content="@yield('meta_description', 'Hi! We\'re '.config('app.name') .'.We make websites and handle your marketing on the French Riviera.')">
<meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">

<meta name="author" content="@yield('meta_author', config('app.name'))">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">

<meta property="fb:app_id" content="{{ config('blog.fb_app_id') }}">
<meta property="og:url" content="{{url()->full()}}">
<meta property="og:type" content="@yield('meta_fb_type', 'website')">
<meta property="og:title" content="@yield('title', config('app.name'))">
<meta property="og:image" content="@yield('meta_image', config('blog.logo_url'))">
<meta property="og:description" content="@yield('meta_description', 'Hi! We\'re '.config('app.name') .'.We make websites and handle your marketing on the French Riviera.')">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="{{ app()->getLocale() }}">
<meta property="article:author" content="@yield('meta_author')">
<meta property='article:publisher' content='{{ config('app.url') }}' />

<meta name="twitter:card" content="summary">
{{--     <meta name="twitter:site" content="@site_account">
<meta name="twitter:creator" content="@individual_account">
<meta name="twitter:url" content="https://example.com/page.html"> --}}
<meta name="twitter:title" content="@yield('title', config('app.name'))">
<meta name="twitter:description" content="@yield('meta_description', 'Hi! We\'re '.config('app.name') .'.We make websites and handle your marketing on the French Riviera.')">
<meta name="twitter:image" content="@yield('meta_image', config('blog.logo_url'))">

<link rel="icon" href="{{ config('blog.favicon_url') }}">

<!-- STAY - Scripts -->
<script src="{{ asset('js/manifest.js') }}" defer></script>

<script src="{{ asset('js/vendor.js') }}" defer></script>

<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,500i,700,900&display=swap" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/all.css') }}" rel="stylesheet">

@yield('header_scripts')

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ config('blog.google_tag_id') }}');</script>
<!-- End Google Tag Manager -->
