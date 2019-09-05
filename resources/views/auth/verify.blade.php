@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('above_container')
    <div style="padding-top:15rem;">
        <div class="action-section container mt-5">
            <div>{{ __('Verify Your Email Address') }}</div>

            <div class="mt-5">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
            </div>
        </div>
    </div>
@endsection
