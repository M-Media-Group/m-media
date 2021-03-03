@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Register new domains")
@section('meta_description', "This ".config('app.name')." tool lets you check domain names for availability." )

@section('above_container')
    <div class="header-section bg-secondary">
        <h1>Register new domains</h1>
    </div>
    <div class="action-section card">
      <domain-check-component class="mt-5"></domain-check-component>
    </div>
    <div class="header-section bg-secondary">

    <h2 class="mt-5 mb-0">From our Help Center</h2>
    <block-post-component></block-post-component>
</div>
@endsection

@section('content')


{{--    <p class="mb-5"><a href="/automation-bot">Learn more about the Marketing Automation Bot</a></p>
 --}}@endsection
