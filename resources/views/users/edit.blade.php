@extends('layouts.clean')

@section('title', 'Edit a user')

@section('content')
	<h1>{{$user->name}} {{$user->surname}}</h1>
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
   	<button type="submit" class="button button-primary">Save</button>
	</form>
	@if(count($invoices) > 0)
    <h2>Invoices</h2>
    <table style="width:100%;">
	    @foreach ($invoices as $invoice)
	        <tr>
	            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
	            <td>{{ $invoice->total() }}</td>
	            <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
	        </tr>
	    @endforeach
	</table>
	@endif
	@if($user->primaryPhone && count($user->primaryPhone['logs']) > 0)
    <h2>Call logs to {{$user->primaryPhone->number}}</h2>
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
	@endif

@endsection
