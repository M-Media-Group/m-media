@extends('layouts.clean')

@section('title', 'Users')

@section('above_container')
	<div class="header-section" style="background:#246EBA;">
		<h1>Users</h1>
		<h2>M Media customers</h2>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">All users</h2>
	@if($users && count($users) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Name</th>
				   <th>Surname</th>
				   <th>Email</th>
				   <th>Phone</th>
				   <th>Stripe ID</th>
				   <th>Devices</th>
				   <th>Seen</th>
				   <th>View</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->surname }}</td>
					<td><a class="{{ $user->email_verified_at  ? null : 'text-primary' }}" href="mailto:{{$user->email}}">{{$user->email}}{{ $user->email_verified_at  ? null : ' (Unverified)' }}</a></td>
					<td class="{{ $user->primaryPhone ? null : 'text-primary' }}"><a {!! $user->primaryPhone ? 'href="tel:'.$user->primaryPhone->e164.'"' : null !!}>{{ $user->primaryPhone ? $user->primaryPhone->e164 : 'No primary number' }}</a></td>
					<td class="{{ $user->stripe_id ? null : 'text-primary' }}"><a target="_BLANK" {!! $user->stripe_id ? 'href="https://dashboard.stripe.com/customers/'.$user->stripe_id.'"' : null !!}>{{ $user->stripe_id  ? $user->stripe_id : 'No Stripe ID' }}</a></td>
					<td>{{ $user->bots_count }}</td>
					<td class="text-{{ now()->diffInDays( $user->seen_at ) > 30  ? 'primary' : 'muted'}}">{{ $user->seen_at->diffForHumans() }}</td>
					<td><a href="/users/{{ $user->id }}">View</a></td>
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
</div>
@endsection
