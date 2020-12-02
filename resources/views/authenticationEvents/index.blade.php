@extends('layouts.clean')

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>Authentication event logs</h1>
		<p>{{config('app.name')}} Authentication events</p>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{{count($authentication_events)}} authentication events</h2>
	@if($authentication_events && count($authentication_events) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Platform</th>
				   <th>Device</th>
				   <th>Browser</th>
				   <th>User</th>
				   <th>IP</th>
				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($authentication_events->sortByDesc('created_at') as $log)
				<tr>
					<td><a href="/authentication-events/{{ $log->id }}">{{ $log->id }}</a></td>
					<td>{{ $log->platform }}</td>
					<td>{{ $log->device }}</td>
					<td>{{ $log->browser }}</td>
					<td>{{ optional($log->user)->name }} {{ optional($log->user)->surname }}</td>
					<td>{{ $log->ip }}</td>
					<td>{{ $log->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no authentication event numbers associated with your account. When you asscociate a authentication event number with your {{config('app.name')}} account, you access more and better services via authentication event, and ensure more security over your account.
		</div>
	@endif
</div>
@endsection
