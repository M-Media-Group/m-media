@extends('layouts.clean')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>Notifications</h1>
        <h2>{{Auth::user()->name}} {{Auth::user()->surname}}</h2>
    </div>
@endsection

@section('content')
<h2 class="mt-5 mb-0">All notifications</h2>
@if(count(Auth::user()->notifications) > 0)
	<div class="list-group">
		@foreach(Auth::user()->notifications as $notification)
			<a href="{{$notification->action}}" class="list-group-item list-group-item-action action-section round-all-round mt-5 mb-5">
			    <div class="d-flex w-100 justify-content-between">
			      <h5 class="mb-1">{{$notification->title}}</h5>
			      <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
			    </div>
			    <p class="mb-1">{{$notification->message}}</p>
			    <small class="text-muted">{{$notification->type}}</small>
			 </a>
			{{$notification->markAsRead()}}
		@endforeach
	</div>
@else
	<div class="alert text-muted">
		 There's currently no notifications to show. When we send you a notification, it will show up here.
	</div>
@endif
@endsection
