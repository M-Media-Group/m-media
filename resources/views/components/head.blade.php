<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover">

<title>@yield('title', 'Marketing and Web Development for Entrepreneurs, Artists, and Small Businesses') | {{ config('app.name') }}</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="keywords" content="{{ config('app.name') }},{{ config('blog.country_name') }},{{ config('blog.area_name') }},@yield('meta_keywords')">
<meta name="description" property="og:description" content="@yield('meta_description', 'Hi! We\'re '.config('app.name') .'. We make websites and handle marketing for artists, entrepreneurs, and small businesses. SEO friendly, responsive, and tailored websites built for you in Monaco, the French Riviera, or anywhere.')">
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
<meta property="og:image" content="@yield('meta_image', config('app.url').config('blog.logo_url'))">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="{{ app()->getLocale() }}">
<meta property="article:author" content="@yield('meta_author', config('app.name'))">
<meta property='article:publisher' content='{{ config('app.url') }}' />

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@MMediaFr">
{{-- <meta name="twitter:creator" content="@individual_account">
 --}}{{-- <meta name="twitter:url" content="https://example.com/page.html"> --}}
<meta name="twitter:title" content="@yield('title', config('app.name'))">
<meta name="twitter:description" content="@yield('meta_description', 'Hi! We\'re '.config('app.name') .'.We make websites and handle marketing for artists, entrepreneurs, and small businesses. SEO friendly, responsive, and tailored websites built for you in Monaco, the French Riviera, or anywhere.')">
<meta name="twitter:image" content="@yield('meta_image', config('blog.logo_url'))">

<meta name="theme-color" content="#eb4647">

<meta name="geo.region" content="FR">
<meta name="geo.placename" content="French Riviera">

{{-- <meta http-equiv="Content-Security-Policy" content="default-src 'none'; font-src 'https://fonts.googleapis.com';
			 img-src 'self' https://i.imgur.com; object-src 'none'; script-src 'self'; style-src 'self'"> --}}

<link rel="icon" href="{{ config('blog.favicon_url') }}">
<link rel="apple-touch-icon" href="{{ config('blog.logo_url') }}"/>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ config('blog.google_tag_id') }}');</script>
<!-- End Google Tag Manager -->

<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">

<!-- Styles -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<link href="{{ mix('css/all.css') }}" rel="stylesheet">

<link rel="manifest" id="manifest">
{{-- Check for support of WebP images and add class if supported. BTW - https://squoosh.app is an awesome tool for this --}}
<script>/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-setclasses !*/
/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-webp-setclasses !*/
!function(e,n,A){function o(e,n){return typeof e===n}function t(){var e,n,A,t,a,i,l;for(var f in r)if(r.hasOwnProperty(f)){if(e=[],n=r[f],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(A=0;A<n.options.aliases.length;A++)e.push(n.options.aliases[A].toLowerCase());for(t=o(n.fn,"function")?n.fn():n.fn,a=0;a<e.length;a++)i=e[a],l=i.split("."),1===l.length?Modernizr[l[0]]=t:(!Modernizr[l[0]]||Modernizr[l[0]]instanceof Boolean||(Modernizr[l[0]]=new Boolean(Modernizr[l[0]])),Modernizr[l[0]][l[1]]=t),s.push((t?"":"no-")+l.join("-"))}}function a(e){var n=u.className,A=Modernizr._config.classPrefix||"";if(c&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+A+"no-js(\\s|$)");n=n.replace(o,"$1"+A+"js$2")}Modernizr._config.enableClasses&&(n+=" "+A+e.join(" "+A),c?u.className.baseVal=n:u.className=n)}function i(e,n){if("object"==typeof e)for(var A in e)f(e,A)&&i(A,e[A]);else{e=e.toLowerCase();var o=e.split("."),t=Modernizr[o[0]];if(2==o.length&&(t=t[o[1]]),"undefined"!=typeof t)return Modernizr;n="function"==typeof n?n():n,1==o.length?Modernizr[o[0]]=n:(!Modernizr[o[0]]||Modernizr[o[0]]instanceof Boolean||(Modernizr[o[0]]=new Boolean(Modernizr[o[0]])),Modernizr[o[0]][o[1]]=n),a([(n&&0!=n?"":"no-")+o.join("-")]),Modernizr._trigger(e,n)}return Modernizr}var s=[],r=[],l={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var A=this;setTimeout(function(){n(A[e])},0)},addTest:function(e,n,A){r.push({name:e,fn:n,options:A})},addAsyncTest:function(e){r.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=l,Modernizr=new Modernizr;var f,u=n.documentElement,c="svg"===u.nodeName.toLowerCase();!function(){var e={}.hasOwnProperty;f=o(e,"undefined")||o(e.call,"undefined")?function(e,n){return n in e&&o(e.constructor.prototype[n],"undefined")}:function(n,A){return e.call(n,A)}}(),l._l={},l.on=function(e,n){this._l[e]||(this._l[e]=[]),this._l[e].push(n),Modernizr.hasOwnProperty(e)&&setTimeout(function(){Modernizr._trigger(e,Modernizr[e])},0)},l._trigger=function(e,n){if(this._l[e]){var A=this._l[e];setTimeout(function(){var e,o;for(e=0;e<A.length;e++)(o=A[e])(n)},0),delete this._l[e]}},Modernizr._q.push(function(){l.addTest=i}),Modernizr.addAsyncTest(function(){function e(e,n,A){function o(n){var o=n&&"load"===n.type?1==t.width:!1,a="webp"===e;i(e,a&&o?new Boolean(o):o),A&&A(n)}var t=new Image;t.onerror=o,t.onload=o,t.src=n}var n=[{uri:"data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=",name:"webp"},{uri:"data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA==",name:"webp.alpha"},{uri:"data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA",name:"webp.animation"},{uri:"data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=",name:"webp.lossless"}],A=n.shift();e(A.name,A.uri,function(A){if(A&&"load"===A.type)for(var o=0;o<n.length;o++)e(n[o].name,n[o].uri)})}),t(),a(s),delete l.addTest,delete l.addAsyncTest;for(var p=0;p<Modernizr._q.length;p++)Modernizr._q[p]();e.Modernizr=Modernizr}(window,document);
</script>

@yield('header_scripts')
