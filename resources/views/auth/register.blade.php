@extends('layouts.clean')

@section('title', "Register to ".config('app.name'))
@section('meta_description', "Register to comment, post articles, and interact with the community at ".config('app.name')."!")

@section('above_container')
<div class="header-section" style="background:#2565aa;">
    <h2>Don't have an account? <a href="/contact">Contact us</a>!</h2>
</div>
@endsection

{{-- @section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div>

            <div class="card bg-dark text-white">
                <div class="card-header">{{ __('Sign up') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="four columns col-form-label u-right-text-on-desktop">{{ __('E-Mail Address') }}</label>

                            <div class="six columns">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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

                        <div class="row">
                            <p class="six columns offset-by-four">By registering you understand the <a href="/privacy-policy">privacy policy</a> and agree to the <a href="terms-and-conditions">terms and conditions</a>.</p>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="six columns offset-by-four">
                                <button type="submit" class="button button-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted u-center-text">
                    <a href="/login">Already have an account? Log in!</a>
                </div>
            </div>
</div>

@endsection --}}
