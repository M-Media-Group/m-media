@extends('layouts.clean')

@section('above_container')
    <div class="header-section bg-secondary">
        <h1>Notifications</h1>
        <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
    </div>
@endsection

@section('content')
{{-- <h2 class="mt-5 mb-0">{{count(Auth::user()->notifications)}} {{str_plural("notifications", count(Auth::user()->notifications))}}</h2> --}}
<notifications-component style="margin-top:-10rem;" userid="{{Auth::id()}}"></notifications-component>

@endsection

@php
	Auth::user()->unreadNotifications->markAsRead();
@endphp
