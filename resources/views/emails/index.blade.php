@extends('layouts.clean')

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>Emails</h1>
		<p>{{config('app.name')}} Emails</p>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{{count($emails)}} emails</h2>
	@if($emails && count($emails) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>Name</th>
				   @can('update email addresses')
				   <th>Can receive email</th>
				   <th>Public</th>
				   @endcan
				   <th>Primary User</th>
				   	@can('update email addresses')
				   <th>User</th>
				   @endcan
				   <th>Emails sent</th>
				   <th>Emails received</th>
				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($emails->sortByDesc('logs_count') as $email)
				<tr>
					<td><a href="/emails/{{ $email->id }}">{{ $email->email }}</a></td>
					@can('update email addresses')
					<td class="text-{{ $email->can_receive_mail  ? 'muted' : 'primary' }}">
						<checkbox-toggle-component checked="{{$email->can_receive_mail ? true : false}}" title="Can receive email" url="/emails/{{$email->id}}" column_title="can_receive_mail"></checkbox-toggle-component>
					</td>
					<td class="text-{{ $email->is_public  ? 'primary' : 'muted' }}">
						<checkbox-toggle-component checked="{{$email->is_public ? true : false}}" title="Is public" url="/emails/{{$email->id}}" column_title="is_public"></checkbox-toggle-component>
					</td>
					@endcan
					<td class="text-{{ !$email->defaultForUser  ? 'primary' : null }}">{!! $email->defaultForUser ? '<a href="/users/'.$email->defaultForUser->id.'">'.$email->defaultForUser->name."</a>" : 'No owner' !!}</td>
									   @can('update email addresses')

					<td class="text-{{ !$email->user  ? 'primary' : null }}">
						<select-component :options="{{$users}}" title="Is serviceable" url="/emails/{{$email->id}}" column_title="user_id" current_value="{{$email->user_id}}"></select-component>
					</td>
					@endcan
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
