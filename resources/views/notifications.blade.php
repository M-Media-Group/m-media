@extends('layouts.clean')

@section('above_container')
    <div class="header-section u-bg-primary">
        <h1>Notifications</h1>
        <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
    </div>
@endsection

@section('content')
{{-- <h2 class="mt-5 mb-0">{{count(Auth::user()->notifications)}} {{str_plural("notifications", count(Auth::user()->notifications))}}</h2> --}}
<h2 class="mt-5 mb-0">All notifications</h2>
<notifications-component userid="{{Auth::id()}}"></notifications-component>

@if(count(Auth::user()->notifications) > 0)

@else
	<div class="alert text-muted">
		 There's currently no notifications to show. When we send you a notification, it will show up here.
	</div>
@endif
<div class="mt-5"></div>
@endsection
