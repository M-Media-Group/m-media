@extends('layouts.clean')

@section('title', 'Users')

@section('above_container')
	<div class="header-section bg-secondary">
		<h1>Users</h1>
		<p>{{config('app.name')}} customers</p>
	</div>
<div class="container">
<h2 class="mt-5 mb-0">{{count($users)}} users</h2>
	@if($users && count($users) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Online</th>
				   <th>Name</th>
				   <th>Surname</th>
				   <th>Email</th>
				   <th>Phone</th>
				   <th>Stripe ID</th>
				   <th>Seen</th>
				   <th>Last time we contacted the customer</th>
				   <th>Last time the customer contacted us</th>
				</tr>
			</thead>
			<tbody>

			@foreach ($users->sortByDesc('seen_at') as $user)
				<tr>
					<td><a href="/users/{{ $user->id }}">{{ $user->id }}</a></td>
					<td v-if="online_users" v-bind:class="{'text-secondary': !online_users.some(item => item.id === {{$user->id}})}" v-html="online_users.some(item => item.id === {{$user->id}})"></td>
					<td v-else>N/A</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->surname }}</td>
					<td><a class="{{ $user->email_verified_at  ? null : 'text-secondary' }}" href="mailto:{{$user->email}}">{{$user->email}}{{ $user->email_verified_at  ? null : ' (Unverified)' }}</a></td>
					<td class="{{ $user->primaryPhone ? null : 'text-secondary' }}"><a {!! $user->primaryPhone ? 'href="tel:'.$user->primaryPhone->e164.'"' : null !!}>{{ $user->primaryPhone ? $user->primaryPhone->e164 : 'No primary number' }}</a></td>
					<td class="{{ $user->stripe_id ? null : 'text-secondary' }}"><a target="_BLANK" rel="noopener noreferrer" {!! $user->stripe_id ? 'href="https://dashboard.stripe.com/customers/'.$user->stripe_id.'"' : null !!}>{{ $user->stripe_id  ? $user->stripe_id : 'No Stripe ID' }}</a></td>
					<td class="text-{{ now()->diffInDays( $user->seen_at ) > 30  ? 'secondary' : 'muted'}}">{{ $user->seen_at->diffForHumans() }}</td>
					@if($user->last_outbound_contact_at)
						<td class="text-{{ now()->diffInDays( $user->last_outbound_contact_at ) > 150  ? 'secondary' : 'muted'}}">{{ $user->last_outbound_contact_at->diffForHumans() }}</td>
					@else
						<td>No record</td>
					@endif
					@if($user->last_inbound_contact_at)
						<td class="text-{{ now()->diffInDays( $user->last_inbound_contact_at ) > 150  ? 'secondary' : 'muted'}}">{{ $user->last_inbound_contact_at->diffForHumans() }}</td>
					@else
						<td>No record</td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no users to display.
		</div>
	@endif
</div>
@endsection
