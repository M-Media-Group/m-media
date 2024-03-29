@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img height="100" style="height:100px; max-height: 100px;" src="{{asset('images/logo.png')}}" alt="{{config('app.name')}}">
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.') @lang('Email us: ') <a href="{{config('mail.reply_to.address')}}">{{config('mail.reply_to.address')}}</a>
        @endcomponent
    @endslot
@endcomponent
