@extends('layouts.clean')

@section('title', 'Edit a user')

@section('header_scripts')
	<style type="text/css">
		input:focus ~ span::before {
			 content: "Changing your email will require you to verify it once again.";

  font-weight: bold;
		}
	</style>
@endsection

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>Account settings</h1>
		<p>{{$user->name}} {{$user->surname}}</p>
	</div>
@endsection

@section('content')
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
    @if(!$user->email_verified_at)
	    <div class="alert alert-danger text-muted">
	         Please verify your email address for full access to your account.
	         @if(Auth::id() == $user->id)
	         	If you did not receive the email, <a href="/email/resend">click here to request another</a>.
	         @endif
	    </div>
    @endif

    @if(!$user->primaryPhone)
	    <div class="alert alert-danger text-muted">
	         Please <a href="/contact">contact us</a> to add your phone number and get full access to your {{Config('app.name')}} services.
	    </div>
    @endif
		<div class="alert alert-info text-muted">
			 Some settings, like your name, can not be modified by you. Something wrong? <a href="/contact">Contact us</a>!
		</div>
	<form action="/users/{{$user->id}}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
	  @csrf
	  @method('PATCH')
	@if(Auth::user()->can('edit user name'))
		<h2 class="mt-5 mb-0">Personal details</h2>
	  <div class="form-group">
		<label for="exampleFormControlInput2">Name</label>
		<input type="text" class="form-control" id="exampleFormControlInput2" name="name" placeholder="Username" value="{{$user->name}}" required>
	  </div>
	  <div class="form-group mb-5">
		<label for="exampleFormControlInput3">Surname</label>
		<input type="text" class="form-control" id="exampleFormControlInput3" name="surname" placeholder="Username" value="{{$user->surname}}" required>
	  </div>
	@endif
		<h2 class="mt-5 mb-0">Email address</h2>
	  <div class="form-group">
		<label for="exampleFormControlInput4">Email <span class="small">({{ $user->email_verified_at ? 'Your email was verified on '. $user->email_verified_at->toFormattedDateString() : 'Your email has not been verified' }})</span></label>
		<input type="text" class="form-control custom-warning" id="exampleFormControlInput4" name="email" placeholder="Username" value="{{$user->email}}" required>
		<span></span>
	  </div>

	@if(Auth::user()->can('manage user roles') && count($roles) > 0)
	<h2 class="mt-5 mb-0">User roles</h2>
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

	<h2 class="mt-5 mb-0">Phone numbers</h2>
	@if($user->phones && count($user->phones) > 0)
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>Country</th>
				   <th>Number</th>
				   <th>Public</th>
				   <th>Notes</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($user->phones as $phone)
				<tr>
					<td>{{ strtoupper($phone->country->iso) }}</td>
					<td>{{ $phone->number }}</td>
					<td>{!! $phone['is_public'] ? '<b>Number is publicly visible</b>' : 'No' !!}</td>
					<td>{{$user->primaryPhone->id == $phone->id ? 'Primary' : null}} {{ strtolower($phone->number_type) }} number</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no phone numbers associated with your account. When you asscociate a phone number with your {{Config('app.name')}} account, you access more and better services via phone, and ensure more security over your account.
		</div>
	@endif

	<h2 class="mt-5 mb-0">Calls to {{Config('app.name')}}</h2>
	@if($user->primaryPhone && count($user->primaryPhone['logs']) > 0)
	<div class="table-responsive">
		<table class="table mb-0">
				<thead>
					<tr>
					   <th>Call started</th>
					   <th>Direction</th>
					   <th>Notes</th>
					</tr>
				</thead>
				<tbody>
			@foreach ($user->primaryPhone['logs']->reverse() as $call)
				<tr>
					<td>{{ $call->created_at->diffForHumans() }}</td>
					@if($call->type == 'INBOUND')
						<td>You called us</td>
					@elseif($call->type == 'OUTBOUND_AUTO_SMS')
						<td>We sent you an automated SMS</td>
					@else
						<td>We called you</td>
					@endif
					<td class="text-muted">{{ $call->notes ? $call->notes : null }}</td>
					@if(Auth::user()->can('edit phone logs'))
						<td><a href="/user/phone-log/{{ $call->id }}">Edit notes</a></td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no call history to show. When you make a phone call to {{Config('app.name')}} (<a href="tel:+33 4 86 06 08 59">+33 4 86 06 08 59</a>) from your primary phone number, it will show up here.
		</div>
	@endif

@endsection
