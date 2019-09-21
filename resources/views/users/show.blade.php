@extends('layouts.clean')

@section('title', $user->name )

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>{{ $user->name }} {{ $user->surname }}</h1>
        <h2>{{config('app.name')}} Customer</h2>
    </div>
@endsection

@section('content')

    @if(!$user->email_verified_at)
	    <div class="alert alert-danger text-muted">
	         Please verify your email address for full access to your account.
	         @if(Auth::user()->id == $user->id)
	         	If you did not receive the email, <a href="/email/resend">click here to request another</a>.
	         @endif
	    </div>
    @endif

    @if(!$user->primaryPhone)
	    <div class="alert alert-danger text-muted">
	         Please <a href="/contact">contact us</a> to add your phone number and get full access to your M Media services.
	    </div>
    @endif

	<h2 class="mt-5 mb-0">Customer data</h2>

	<div class="table-responsive table-hover">
	    <table class="table mb-0">
	        <tbody>
	            <tr>
	                <th>ID</th>
	                <td>{{ $user->id }}</td>
	            </tr>
	            <tr>
	                <th>Name</th>
	                <td>{{ $user->name }}</td>
	            </tr>
	            <tr>
	                <th>Surname</th>
	                <td>{{ $user->surname }}</td>
	            </tr>
	            <tr>
	                <th>Email</th>
	                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
	            </tr>
	            <tr>
	                <th>Email verified</th>
	                <td>{{ $user->email_verified_at ? $user->email_verified_at->diffForHumans() : "Email not verified" }}</td>
	            </tr>
	            @if($user->primaryPhone)
		            <tr>
		                <th>Phone</th>
		                <td><a href="tel:{{ $user->primaryPhone->e164 }}">{{ $user->primaryPhone->number }}</a></td>
		            </tr>
	            @endif
	            <tr>
	                <th>Last seen</th>
	                <td>{{ $user->seen_at->diffForHumans() }}</td>
	            </tr>
	            <tr>
	                <th>Stripe ID</th>
	                <td>{{ $user->stripe_id }}</td>
	            </tr>

	        </tbody>
	    </table>
	</div>
	<p class="mb-5"><a href="/contact">Incorrect data? Contact us!</a></p>
    @can('update', $user)
        <a class="button button-primary" href="/users/{{$user->id}}/edit">
            {{ __('Edit') }}
        </a>
    @endcan
@endsection
