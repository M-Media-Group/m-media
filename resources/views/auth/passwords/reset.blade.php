@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('above_container')
<div class="header-section bg-secondary">
    <h1>{{ __('Reset Password') }}</h1>
</div>
<div>
    <div class="action-section card">
        <div class="mt-5">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                    <label for="email" class="four columns col-form-label u-right-text-on-desktop">{{ __('E-Mail Address') }}</label>

                    <div class="six columns">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
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

                <div class="form-group row">
                    <label for="password-confirm" class="four columns col-form-label u-right-text-on-desktop">{{ __('Confirm Password') }}</label>

                    <div class="six columns">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="six columns offset-by-four">
                        <button type="submit" class="button button-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
