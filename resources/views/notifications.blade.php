@extends('layouts.clean')

@section('above_container')
    <div class="header-section u-bg-primary">
        <h1>Notifications</h1>
        <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
    </div>
@endsection

@section('content')
<h2 class="mt-5 mb-0">{{count(Auth::user()->notifications)}} {{str_plural("notifications", count(Auth::user()->notifications))}}</h2>
@if(count(Auth::user()->notifications) > 0)
	<div class="list-group">
		@foreach(Auth::user()->notifications as $notification)
			<article onclick="location.href='{{isset($notification->data['action']) ? $notification->data['action'] : "#" }}';" class="list-group-item list-group-item-action action-section round-all-round mt-5" style="cursor: pointer;">
			    <div class="d-flex w-100 justify-content-between">
			      <h5 class="mb-1">{{$notification->data['title']}}</h5>
			    </div>
			    @markdown($notification->data['message'])
				<small class="mt-1 text-{{$notification->unread() ? 'primary' : 'muted'}}">{{$notification->created_at->diffForHumans()}}</small>
{{-- 			    <small class="text-muted">{{$notification->type}}</small>
 --}}			 </article>
			{{$notification->markAsRead()}}
		@endforeach
	</div>
@else
	<div class="alert text-muted">
		 There's currently no notifications to show. When we send you a notification, it will show up here.
	</div>
@endif
<div class="mt-5"></div>
@endsection
