@extends('layouts.clean')

@section('above_container')
	<div class="header-section" style="background:#246EBA;">
		<h1>Email logs</h1>
		<h2>{{config('app.name')}} Emails</h2>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{{count($email_logs)}} emails</h2>
	@if($email_logs && count($email_logs) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Subject</th>
				   <th>From</th>
				   <th>To</th>
				   <th>Status</th>
				   <th>Type</th>
				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($email_logs->sortByDesc('created_at') as $log)
				<tr>
					<td><a href="/email-logs/{{ $log->id }}">{{ $log->id }}</a></td>
					<td>{{ $log->subject }}</td>
					<td><a href="/emails/{{ $log->email_id }}">{{ $log->email->email }}</a></td>
					<td><a href="/emails/{{ $log->to_email_id }}">{{ $log->to_email->email }}</a></td>
					<td>{{ $log->status }}</td>
					<td>{{ $log->type }}</td>
					<td>{{ $log->created_at->diffForHumans() }}</td>
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
