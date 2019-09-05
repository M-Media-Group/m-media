@extends('layouts.clean')

@section('title', 'Edit a user')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>Account settings</h1>
        <h2>{{$user->name}} {{$user->surname}}</h2>
    </div>
@endsection

@section('content')
		<div class="alert alert-info text-muted">
	         Some settings, like your name, can not be modified by you. Something wrong? <a href="mailto:m@mmediagroup.fr">Contact us!</a>
	    </div>
	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<form action="/users/{{$user->id}}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
	  @csrf
	  @method('PATCH')
	@if(Auth::user()->can('edit user name'))
		<h2>Personal details</h2>
	  <div class="form-group">
		<label for="exampleFormControlInput2">Name</label>
		<input type="text" class="form-control" id="exampleFormControlInput2" name="name" placeholder="Username" value="{{$user->name}}" required>
	  </div>
	  <div class="form-group mb-5">
		<label for="exampleFormControlInput3">Surname</label>
		<input type="text" class="form-control" id="exampleFormControlInput3" name="surname" placeholder="Username" value="{{$user->surname}}" required>
	  </div>
	@endif
		<h2>Email address</h2>
	  <div class="form-group">
		<label for="exampleFormControlInput4">Email <span class="small">({{ $user->email_verified_at ? 'Your email was verified on '. $user->email_verified_at->toFormattedDateString() : 'Your email has not been verified' }})</span></label>
		<input type="text" class="form-control" id="exampleFormControlInput4" name="email" placeholder="Username" value="{{$user->email}}" required>
	  </div>

    @if(Auth::user()->can('manage user roles') && count($roles) > 0)
    <h2>User roles</h2>
	<div class='form-group'>
        @foreach ($roles as $role)
            <div class="form-check">
			  <input class="form-check-input" type="checkbox" value="{{$role->id}}" @if (in_array($role->name, $user->getRoleNames()->toArray())) checked="checked" @endif id="defaultCheck1{{$role->name}}" name="roles[]">
			  <label class="form-check-label" for="defaultCheck1{{$role->name}}">
			    {{$role->name}}<small><ul>
			    	@foreach ($role->permissions as $permission)
			    	<li>{{$permission->name}}</li>
			    	@endforeach
			    </ul></small>
			  </label>
			</div>
        @endforeach
    </div>
    @endif
   	<button type="submit" class="button button-primary" style="position: fixed;bottom: 3rem;right: 5rem;z-index: 999;">Save</button>
	</form>

	<h2>Payment methods</h2>
	@if($user->stripe_id)
    <table style="width:100%;margin-bottom: 0;">
    	    @foreach ($pmethod as $method)
	        <tr>
	            <td>{{ ucfirst($method->card->brand) }} {{ $method->card->funding }} card</td>
	            <td class="text-muted">**** {{ $method->card->last4 }}</td>
	            <td>{{ $method->card->exp_month }}/{{ $method->card->exp_year }}</td>
	        </tr>
	        @endforeach
	</table>
	<p class="mb-5"><a href="/users/{{$user->id}}/invoices">View your invoices</a></p>
	@else
		<div class="alert text-muted">
	         You haven't set up a payment method yet. When you subscribe to an M Media service, you'll receive an invoice where you will be able to add a payment method.
	    </div>
	@endif

    <h2>Phone numbers</h2>
	@if($user->phones && count($user->phones) > 0)
    <table style="width:100%;">
	    @foreach ($user->phones as $phone)
	        <tr>
	            <td>{{ $phone->number }}</td>
	            @if($user->primaryPhone->id == $phone->id)
	            <td>Primary phone number</td>
	            @endif
	        </tr>
	    @endforeach
	</table>
	@else
		<div class="alert text-muted">
	         There's currently no phone numbers associated with your account. When you asscociate a phone number with your M Media account, you access more and better services via phone, and ensure more security over your account.
	    </div>
	@endif

    <h2>Calls to M Media</h2>
	@if($user->primaryPhone && count($user->primaryPhone['logs']) > 0)
    <table style="width:100%;">
	    @foreach ($user->primaryPhone['logs']->reverse() as $call)
	        <tr>
	            <td>{{ $call->created_at->diffForHumans() }}</td>
	            <td>{{ $call->type == 'INBOUND' ? 'You called us' : 'We called you' }}</td>
	            <td class="text-muted">{{ $call->notes ? $call->notes : 'No notes were taken for this call.' }}</td>
	       		@if(Auth::user()->can('edit phone logs'))
	            	<td><a href="/user/phone-log/{{ $call->id }}">Edit notes</a></td>
	       		@endif
	        </tr>
	    @endforeach
	</table>
	@else
		<div class="alert text-muted">
	         There's currently no call history to show. When you make a phone call to M Media (+33 4 86 06 08 59), it will show up here.
	    </div>
	@endif

@endsection
