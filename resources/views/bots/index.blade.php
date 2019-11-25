@extends('layouts.clean')

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>Bots</h1>
		<p>{{config('app.name')}} bots</p>
	</div>
	@php
// $routes = Route::getRoutes()->getRoutesByMethod()['GET'];
// return dump($routes);

$users = App\User::all();
$routeHasFilter = collect();

foreach ($users as $user)
{
	$data = [
		'full_name' => $user->full_name,
		'id' => $user->id
	];
    $routeHasFilter->push($data);
}
//return dump($routeHasFilter);
@endphp
<div class="m-3">
<h2 class="mt-5 mb-0">{{count($bots)}} devices</h2>
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
				</tr>
			</thead>
			<tbody>
			@foreach ($bots->where('service_title', 'Bulk Service')->sortByDesc('last_contact_at') as $bot)
				<tr>

					<td><a href="/bots/{{ $bot->id }}">{{ $bot->id }}</a></td>
					<td>{{ $bot->alias }}</td>
					<td>{{ $bot->address }}</td>
					<td>{{ $bot->last_ip }}</td>
					<td>{{ $bot->last_internal_ip }}</td>

					<td class="text-{{ $bot->is_active  ? 'success' : 'primary' }}">{{ $bot->is_active  ? null : 'Offline' }}</td>
					<td class="text-{{ $bot->is_servicable  ? 'success' : 'primary' }}">
						<checkbox-toggle-component checked="{{$bot->is_servicable ? true : false}}" title="Is serviceable" url="/bots/{{$bot->id}}" column_title="is_servicable"></checkbox-toggle-component>
					</td>
					<td class="text-{{ !$bot->user  ? 'primary' : null }}">
					<select-component :options="{{$routeHasFilter}}" title="Is serviceable" url="/bots/{{$bot->id}}" column_title="user_id" current_value="{{$bot->user_id}}"></select-component>
					</td>
					<td class="text-{{ now()->diffInDays( $bot->last_contact_at ) > 6  ? 'primary' : 'muted'}}">{{ $bot->last_contact_at->diffForHumans() }}</td>
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
