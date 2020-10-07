@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "VueJS Components")
@section('meta_description', "This ".config('app.name')." tool will let admins notify ".config('app.name')." users." )

@section('above_container')
<div class="header-section u-bg-primary">
    <h1>{{ __("VueJS Components") }}</h1>
    <p>Demo</p>
</div>
<div>
    <div class="action-section container">
        <div class="mt-5">
            <h2>Ad account notifications website</h2>
            {{-- <ads-component adaccountid="1"></ads-component> --}}
        </div>
        <div class="mt-5">
            <h2>Request website</h2>
            <map-component></map-component>
        </div>
        <div class="mt-5">
            <h2>Request website</h2>
            <request-website-component></request-website-component>
        </div>
    </div>
    <div class="header-section u-bg-primary">
        <p class="u-max-full-width" data-aos="fade" data-aos-duration="1000" data-aos-offset="0">Let us know what you need.</p><p class="u-max-full-width" data-aos="fade" data-aos-duration="1000">
    {{--         Made by 🇵🇱 Poles.<br/><br/>
     --}}    We'll reach out to discuss what we can do for your business.</p>
    </div>
</div>

@endsection
