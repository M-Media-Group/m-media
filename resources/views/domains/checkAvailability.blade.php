@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Check domain availability")
@section('meta_description', "This ".config('app.name')." tool lets you check domain names for availability." )

@section('above_container')
    <div class="header-section u-bg-primary">
        <h1>Check domain availability</h1>
    </div>
    <div class="action-section container" data-aos="fade">
      <domain-check-component class="mt-5"></domain-check-component>
    </div>
    <div class="header-section u-bg-primary">
	    <h2 class="mt-5 mb-0">From our Help Center</h2>
	    <block-post-component category="44"></block-post-component>
	</div>
@endsection

@section('content')


{{--    <p class="mb-5"><a href="/automation-bot">Learn more about the Marketing Automation Bot</a></p>
 --}}@endsection
