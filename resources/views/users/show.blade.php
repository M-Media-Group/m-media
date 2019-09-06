@extends('layouts.clean')

@section('title', $user->name )

@section('content')
	<div class="mt-3">
	    <img src="{{$user->avatar}}" class="rounded img-thumbnail float-left mr-3 w-25" >
	    <h1>{{ $user->name }} {{ $user->surname }}</h1>
	    <span>Member</span>
	    @can('update', $user)
	        <a href="/users/{{$user->id}}/edit">
	            {{ __('Edit') }}
	        </a>
	    @endcan
	</div>
@endsection
