@extends('layouts.clean')

@section('title', 'Users')

@section('content')
<h1 class="mt-5 mb-0">Users</h1>
	@if($users && count($users) > 0)
	<div class="table-responsive">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Name</th>
				   <th>Surname</th>
				   <th>Email</th>
				   <th>Edit</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->surname }}</td>
					<td>{{ $user->email }}</td>
					<td><a href="/users/{{ $user->id }}">Edit</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no phone numbers associated with your account. When you asscociate a phone number with your M Media account, you access more and better services via phone, and ensure more security over your account.
		</div>
	@endif
@endsection
