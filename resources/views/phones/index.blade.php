@extends('layouts.clean')

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>phones</h1>
		<p>{{config('app.name')}} phones</p>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{{count($phones)}} phones</h2>
	@if($phones && count($phones) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>Name</th>
				   <th>Type</th>
				   <th>Primary user</th>
				   	@can('update phone addresses')
				   <th>User</th>
				   @endcan
				   <th>Calls & messages</th>
				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($phones->sortByDesc('logs_count') as $phone)
				<tr style="vertical-align: middle;cursor: pointer;" onclick="window.location='/phones/{{ $phone->id }}';">
					<td>{{ $phone->e164 }}</td>
					<td>{{ $phone->number_type }}</td>
					<td class="text-{{ !$phone->defaultForUser  ? 'primary' : null }}">{!! $phone->defaultForUser ? '<a href="/users/'.$phone->defaultForUser->id.'">'.$phone->defaultForUser->name."</a>" : 'No owner' !!}</td>
									   @can('update phone addresses')

					<td class="text-{{ !$phone->user  ? 'primary' : null }}">
						<select-component :options="{{$users}}" title="Is serviceable" url="/phones/{{$phone->id}}" column_title="user_id" current_value="{{$phone->user_id}}" onclick="event.stopPropagation();"></select-component>
					</td>
					@endcan
					<td>{{ $phone->logs_count }}</td>
					<td class="text-{{ now()->diffInDays( $phone->created_at ) > 6  ? 'primary' : 'muted'}}">{{ $phone->created_at->diffForHumans() }}</td>
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
