@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Instagram data analyzer")
@section('meta_description', "This M Media tool will scan and quickly analyze your Instagram profile to provide you with suggestions on improving your Instagram strategy." )

@section('above_container')
<div style="padding-top:15rem;">
    <div class="action-section container mt-5">
        <div>{{ __('Instagram account analyzer') }}</div>

        <div class="mt-5">
            <form method="GET" action="/instagram-account-analyzer" onsubmit="location.href='{{config('app.url')}}/tools/instagram-account-analyzer/' + document.getElementById('username').value; return false;">
                @csrf

                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">Instagram {{ __('username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" autocomplete="off" minlength="1" maxlength="31" placeholder="@username" class="form-control" name="username" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-muted">
                        When you type in a username and press analyze, we will start daily collection of data to build a historical profile of the account. If you do not want us to store historical data, <a href="mailto:contact@mmediagroup.fr">contact us</a>.
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="button button-primary">
                            {{ __('Analyze') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
