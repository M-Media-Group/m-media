@extends('layouts.clean')

@section('above_container')
	<div class="header-section" style="background:#246EBA;">
		<h1>Bots</h1>
		<h2>M Media bots</h2>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">All devices</h2>
	@if($bots && count($bots) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Alias</th>
				   <th>Address</th>
				   <th>last_ip</th>
				   <th>last_internal_ip</th>

				   <th>Active</th>
				   <th>Serviceable</th>
				   <th>User</th>
				   <th>Last contact</th>
				   <th>Edit</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($bots->where('service_title', 'Bulk Service')->sortByDesc('last_contact_at') as $bot)
				<tr>

					<td>{{ $bot->id }}</td>
					<td>{{ $bot->alias }}</td>
					<td>{{ $bot->address }}</td>
					<td>{{ $bot->last_ip }}</td>
					<td>{{ $bot->last_internal_ip }}</td>

					<td class="text-{{ $bot->is_active  ? 'success' : 'primary' }}">{{ $bot->is_active  ? null : 'Offline' }}</td>
					<td class="text-{{ $bot->is_servicable  ? 'success' : 'primary' }}">{{ $bot->is_servicable  ? null : 'Do not service' }} </td>
					<td class="text-{{ !$bot->user  ? 'primary' : null }}">{!! $bot->user ? '<a href="/users/'.$bot->user->id.'">'.$bot->user->name."</a>" : 'No owner' !!}</td>
					<td class="text-{{ now()->diffInDays( $bot->last_contact_at ) > 6  ? 'primary' : 'muted'}}">{{ $bot->last_contact_at->diffForHumans() }}</td>
					<td><a href="/bots/{{ $bot->id }}">View</a></td>
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
