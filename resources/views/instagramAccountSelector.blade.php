@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Log in to ".config('app.name'))
@section('meta_description', "Log in to comment, post articles, and interact with the community at ".config('app.name')."!")

@section('above_container')
<div style="padding-top:15rem;">
    <div class="action-section container mt-5">
        <div>{{ __('Instagram account debugger') }}</div>

        <div class="mt-5">
            <form method="GET" action="/instagram-account-debugger" onsubmit="location.href='{{config('app.url')}}/instagram-account-debugger/' + document.getElementById('username').value; return false;">
                @csrf

                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">Instagram {{ __('username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control" name="username" required autofocus>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="button button-primary">
                            {{ __('Debug') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
