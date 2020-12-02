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

	<div class="m-0 pt-5 pb-5 ">
		<h2 class="mt-5 mb-0">Personal details</h2>
		@if(Auth::user()->can('edit user name'))
		  <div class="form-group">
			<label for="exampleFormControlInput2">Name</label>
			<input type="text" class="form-control" id="exampleFormControlInput2" name="name" placeholder="Username" value="{{$user->name}}" required>
		  </div>
		  <div class="form-group">
			<label for="exampleFormControlInput3">Surname</label>
			<input type="text" class="form-control" id="exampleFormControlInput3" name="surname" placeholder="Username" value="{{$user->surname}}" required>
		  </div>
		@endif

		<div class="form-group">
			<label for="exampleFormControlInput4">Email <span class="small">({{ $user->email_verified_at ? 'Your email was verified on '. $user->email_verified_at->toFormattedDateString() : 'Your email has not been verified' }})</span></label>
			<input type="text" class="form-control custom-warning" id="exampleFormControlInput4" name="email" placeholder="Username" value="{{$user->email}}" required>
			<span></span>
		</div>
	@if(Auth::user()->can('manage user roles') && count($roles) > 0)

		<div class="row m-0 pt-5 pb-5 " data-aos="fade">
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
		</div>

	@endif
	<button type="submit" class="button button-primary">Save</button>
	</div>
	</form>

<div class="row m-0 pt-5 pb-5">
    <h2 class="mt-5 mb-0" id="help">From our Help Center</h2>
	<block-post-component category="35"></block-post-component>
</div>
@endsection
