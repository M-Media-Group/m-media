@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Log in to ".config('app.name'))
@section('meta_description', "Log in to comment, post articles, and interact with the community at ".config('app.name')."!")

@section('above_container')
<div class="header-section bg-secondary">
    <h1>{{ __('Login') }}</h1>
</div>
<div class="action-section card" data-aos="fade">
    <div class="mt-5">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="four columns col-form-label u-right-text-on-desktop">{{ __('E-Mail Address') }}</label>

                <div class="six columns">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                            <a href="{{ route('password.request') }}" style="font-weight: 700;">
                                {{ __('Forgot your password?') }}
                            </a>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="four columns col-form-label u-right-text-on-desktop">{{ __('Password') }}</label>

                <div class="six columns">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

           {{--  <div class="form-group row">
                <div class="six columns offset-by-four">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div> --}}

            <div class="form-group row mb-0">
                <div class="eight columns offset-by-four">
                    <button type="submit" class="button button-primary">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="card-footer text-muted u-center-text">
        <a href="/register">Don't have an account? Sign up!</a>
    </div> --}}
</div>
<div class="header-section bg-secondary">
    <p>Don't have an account? <a href="/contact">Contact us</a>!</p>
</div>
@endsection
