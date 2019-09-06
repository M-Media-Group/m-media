@extends('layouts.clean')

@section('title', 'Edit a user')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>My bots</h1>
        <h2>{{$user->name}} {{$user->surname}}</h2>
    </div>
@endsection

@section('content')
    <h2 class="mt-5 mb-0">All bots</h2>
	@if(count($user->bots->where('service_title', 'Bulk Service')) > 0)
	    @foreach ($user->bots->where('service_title', 'Bulk Service') as $bot)
			<a class="action-section card mb-5 mt-5 round-all-round action-section-hover" href="#">
			  <div class="row no-gutters">
			    <div class="col-md-4 p-5">
			      <img src="/images/pi-top.png" class="card-img" alt="M Media Marketing Bot">
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title">{{str_replace ("_", " ", $bot->alias)}}</h5>
			        <p class="card-text">This bot has last reported its location in {{ $bot->georegion }}, and is {{ $bot->is_servicable  ? 'serviceable' : 'not serviceable' }} by M Media.</p>
			        <p class="card-text"><small class="text-muted"><span class="text-{{ $bot->is_active  ? 'success' : 'primary' }}">{{ $bot->is_active  ? 'Online' : 'Offline' }}</span> · Last contacted {{ $bot->last_contact_at->diffForHumans() }}</small></p>
			      </div>
			    </div>
			  </div>
			</a>
	    @endforeach
	@else
		<div class="alert text-muted">
	         There's currently no bots associated with your account. When you buy an M Media Marketing Automation Bot, it will show up here. Something wrong? <a href="mailto:m@mmediagroup.fr">Contact us!</a>
	    </div>
	@endif
	<p class="mb-5"><a href="/automation-bot">Learn more about the Marketing Automation Bot</a></p>
@endsection
