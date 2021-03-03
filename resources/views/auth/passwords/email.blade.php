@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('above_container')
<div class="header-section bg-secondary">
    <h1>{{ __('Reset Password') }}</h1>
</div>
<div >
    <div class="action-section card">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-5">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="four columns col-form-label u-right-text-on-desktop">{{ __('E-Mail Address') }}</label>

                    <div class="six columns">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="six columns offset-by-four">
                        <button type="submit" class="button button-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        {{-- <div class="card-footer text-muted u-center-text">
            <a href="/register">Don't have an account? Sign up!</a>
        </div> --}}
    </div>
</div>
<div class="header-section bg-secondary">
    <p>Having trouble logging in? <a href="/contact">Contact us</a>!</p>
</div>
@endsection
