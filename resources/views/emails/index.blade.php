@extends('layouts.clean')

@section('above_container')
	<div class="header-section" style="background:#246EBA;">
		<h1>Emails</h1>
		<h2>{{config('app.name')}} Emails</h2>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{{count($emails)}} emails</h2>
	@if($emails && count($emails) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Name</th>
				   <th>Can receive email</th>
				   <th>Public</th>
				   <th>Primary User</th>
				   <th>User</th>
				   <th>Messages sent</th>
				   <th>Messages received</th>
				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($emails->sortByDesc('logs_count') as $email)
				<tr>
					<td><a href="/emails/{{ $email->id }}">{{ $email->id }}</a></td>
					<td>{{ $email->email }}</td>
					<td class="text-{{ $email->can_receive_mail  ? 'muted' : 'primary' }}">{{ $email->can_receive_mail  ? 'Yes' : 'No' }} </td>
					<td class="text-{{ $email->is_public  ? 'primary' : 'muted' }}">{{ $email->is_public  ? 'Yes' : 'No' }} </td>
					<td class="text-{{ !$email->defaultForUser  ? 'primary' : null }}">{!! $email->defaultForUser ? '<a href="/users/'.$email->defaultForUser->id.'">'.$email->defaultForUser->name."</a>" : 'No owner' !!}</td>
					<td class="text-{{ !$email->user  ? 'primary' : null }}">{!! $email->user ? '<a href="/users/'.$email->user->id.'">'.$email->user->name."</a>" : 'No owner' !!}</td>
					<td>{{ $email->logs_count }}</td>
					<td>{{ $email->received_logs_count }}</td>
					<td class="text-{{ now()->diffInDays( $email->created_at ) > 6  ? 'primary' : 'muted'}}">{{ $email->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no phone numbers associated with your account. When you asscociate a phone number with your {{config('app.name')}} account, you access more and better services via phone, and ensure more security over your account.
		</div>
	@endif
</div>
@endsection
