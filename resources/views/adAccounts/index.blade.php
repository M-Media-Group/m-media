@extends('layouts.clean')

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>Ad accounts</h1>
		<p>{{config('app.name')}} ad accounts</p>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{{count($accounts)}} accounts</h2>
	@if($accounts && count($accounts) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>Type</th>
				   	@can('update account addresses')
				   <th>User</th>
				   @endcan

				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($accounts->sortByDesc('logs_count') as $account)
				<tr style="vertical-align: middle;cursor: pointer;" onclick="window.location='/ad-accounts/{{ $account->id }}';">
					<td>{{ $account->platform->name }}</td>
					@can('update account addresses')

					<td class="text-{{ !$account->user  ? 'primary' : null }}">
						<select-component :options="{{$users}}" title="Is serviceable" url="/accounts/{{$account->id}}" column_title="user_id" current_value="{{$account->user_id}}" onclick="event.stopPropagation();"></select-component>
					</td>
					@endcan

					<td class="text-{{ now()->diffInDays( $account->created_at ) > 6  ? 'primary' : 'muted'}}">{{ $account->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no ad accounts associated with your account. When you asscociate an ad account with your {{config('app.name')}} account, you access more and better services, as well as track progress easily.
		</div>
	@endif
</div>
@endsection
