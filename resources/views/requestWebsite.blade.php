@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Create notification")
@section('meta_description', "This ".config('app.name')." tool will let admins notify ".config('app.name')." users." )

@section('above_container')
<div class="header-section u-bg-primary">
    <h1>{{ __("Let's make a webiste") }}</h1>
    <p>Tell us a little about your needs.</p>
</div>
<div>
    <div class="action-section container">
        <div class="mt-5">
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
