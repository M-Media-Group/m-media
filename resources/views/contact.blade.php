@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('opening_body')
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
	  theme_color="#eb4647"
	  greeting_dialog_display="show"
	  logged_out_greeting="Chat with us using Facebook Messenger!"
	  logged_in_greeting="Hey there! How can we help?">
    </div>
@endsection

@section('above_container')
<div class="header-section" style="background:#246EBA;">
    <h1>{{ __('Contact us') }}</h1>
    <h2>We make websites and handle your marketing.</h2>
</div>
<div class="action-section container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-5">
        <div class="form-group row mb-0">
            <div class="col-md-12">
                <div class="flex" style="flex-wrap: wrap;">
		            <a class="button button-primary" href="mailto:contact@mmediagroup.fr">Email</a>
		            <a class="button button-secondary" rel="noopener noreferrer" href="{{config('blog.messenger_url')}}">Message on Facebook</a>
		            <a class="button button-secondary" href="tel:+33486060859">Call</a>
		        </div>
            </div>
        </div>
    </div>
    {{-- <div class="card-footer text-muted text-center">
        <a href="/register">Don't have an account? Sign up!</a>
    </div> --}}
</div>
<div class="header-section" style="background:#2565aa;">
    <h2>Based in {{config('blog.area_name')}}, {{config('blog.country_name')}}.</h2>
</div>
@endsection
