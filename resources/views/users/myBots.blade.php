@extends('layouts.clean')

@section('above_container')
    <div class="header-section bg-secondary">
        <h1>Your bots</h1>
        <p>{{$user->name}} {{$user->surname}}</p>
    </div>
@endsection

@section('content')
    <h2 class="mt-5 mb-0">All bots</h2>
	@if(count($user->bots->where('service_title', 'Bulk Service')) > 0)
	    @foreach ($user->bots->where('service_title', 'Bulk Service') as $bot)
			<a class="action-section card mb-5 mt-5 round-all-round action-section-hover" href="/bots/{{$bot->id}}">
			  <div class="row no-gutters">
			    <div class="four columns p-5">
			      <img src="/images/pi-top.png" class="card-img" style="max-height: 200px;object-fit: scale-down;" alt="{{Config('app.name')}} Marketing Bot">
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title">{{str_replace (["_", "-"], " ", $bot->alias)}}</h5>
			        <p class="card-text">This bot has last reported its location in {{ $bot->georegion }}, and is {{ $bot->is_servicable  ? 'serviceable' : 'not serviceable' }} by {{Config('app.name')}}.</p>
			        <p class="card-text"><small class="text-muted"><span class="text-{{ $bot->is_active  ? 'success' : 'primary' }}">{{ $bot->is_active  ? 'Online' : 'Offline' }}</span> · Last contacted {{ $bot->last_contact_at->diffForHumans() }}</small></p>
			      </div>
			    </div>
			  </div>
			</a>
	    @endforeach
	@else
		<div class="alert text-muted">
	         There's currently no bots associated with your account. When you buy an {{Config('app.name')}} Marketing Automation Bot, it will show up here. Please note it may take up to a week for newly purchased bots to show up. Need help? <a href="/contact">Contact us!</a>
	    </div>
	@endif
	<hr>
	<a class="action-section card mb-5 mt-5 round-all-round action-section-hover u-center-text" href="/automation-bot" data-aos="fade">
	      <img src="/images/box.png" class="card-img-top" style="max-height: 200px;object-fit: scale-down;" alt="{{Config('app.name')}} Marketing Bot">

	      <div class="card-body">
	        <h5 class="card-title">Order a new bot!</h5>
	        <p class="card-text">Order a new Marketing Automation Bot from {{Config('app.name')}} loaded with custom-coded automations and scripts to make your business marketing life easier, faster, and cheaper.</p>
	      </div>
	</a>
{{-- 	<p class="mb-5"><a href="/automation-bot">Learn more about the Marketing Automation Bot</a></p>
 --}}@endsection
