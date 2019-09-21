@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

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

@endsection
