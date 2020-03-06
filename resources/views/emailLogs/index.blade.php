@extends('layouts.clean')

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>Email logs</h1>
		<p>{{config('app.name')}} Emails</p>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{!! $email_logs->total() !!} emails</h2>
<form class="form-group" role="search">
	<label for="site-search">Search</label>
	<input type="search" id="site-search" name="q" aria-label="Search through site content" placeholder="Search" value="{{$_GET['q'] ?? ""}}">
</form>
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
			@foreach ($email_logs as $log)
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
		{!! $email_logs->appends(request()->except('page'))->links('vendor.pagination.default') !!}
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no phone numbers associated with your account. When you asscociate a phone number with your {{config('app.name')}} account, you access more and better services via phone, and ensure more security over your account.
		</div>
	@endif
</div>
@endsection
