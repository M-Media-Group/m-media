@extends('layouts.clean')

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>AdAccounts</h1>
		<p>{{config('app.name')}} AdAccounts</p>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{{count($AdAccounts)}} AdAccounts</h2>
	@if($AdAccounts && count($AdAccounts) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>Name</th>
				   <th>Type</th>
				   <th>Primary user</th>
				   	@can('update AdAccount addresses')
				   <th>User</th>
				   @endcan
				   <th>Calls & messages</th>
				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($AdAccounts->sortByDesc('logs_count') as $AdAccount)
				<tr style="vertical-align: middle;cursor: pointer;" onclick="window.location='/AdAccounts/{{ $AdAccount->id }}';">
					<td>{{ $AdAccount->e164 }}</td>
					<td>{{ $AdAccount->number_type }}</td>
					<td class="text-{{ !$AdAccount->defaultForUser  ? 'primary' : null }}">{!! $AdAccount->defaultForUser ? '<a href="/users/'.$AdAccount->defaultForUser->id.'">'.$AdAccount->defaultForUser->name."</a>" : 'No owner' !!}</td>
									   @can('update AdAccount addresses')

					<td class="text-{{ !$AdAccount->user  ? 'primary' : null }}">
						<select-component :options="{{$users}}" title="Is serviceable" url="/AdAccounts/{{$AdAccount->id}}" column_title="user_id" current_value="{{$AdAccount->user_id}}" onclick="event.stopPropagation();"></select-component>
					</td>
					@endcan
					<td>{{ $AdAccount->logs_count }}</td>
					<td class="text-{{ now()->diffInDays( $AdAccount->created_at ) > 6  ? 'primary' : 'muted'}}">{{ $AdAccount->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no AdAccount numbers associated with your account. When you asscociate a AdAccount number with your {{config('app.name')}} account, you access more and better services via AdAccount, and ensure more security over your account.
		</div>
	@endif
</div>
@endsection
