@extends('layouts.clean')

@section('above_container')
	<div class="header-section bg-secondary">
		<h1>Instagram Accounts</h1>
		<p>{{config('app.name')}} Instagram Accounts</p>
	</div>
<div class="container">
<h2 class="mt-5 mb-0">History</h2>

@php
$datasets = [];
foreach($accounts->where('is_scrapeable', true)->where('user_id') as $account)
{
	$array = [];foreach ($account->scrapes as $scrape) {array_push($array, ["y" => $scrape->followers_count, "x" => $scrape->created_at->toDateString()]);}
	$color = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
	$data = [
    'pointHitRadius' => 20,
    'label' => $account->username.' followers',
    'fill' => false,
    'data' => $array,
	'yAxisID' => 'A',
	 'borderColor' => [ $color],
	    'borderWidth' => 2
	];
array_push($datasets, $data);
}
@endphp

<chart-line-component :data="{{json_encode($datasets)}}" scale="logarithmic" :height="100"></chart-line-component>

<h2 class="mt-5 mb-0">{{count($accounts)}} accounts</h2>
	@if($accounts && count($accounts) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Username</th>
				   <th>Buffer ID</th>
				   <th>Is scrapeable</th>
				   <th>User</th>
				   <th>Followers</th>
				   <th>Following</th>
				   <th>Engagement health</th>
				   <th>Last scraped</th>

{{-- 				   <th>Active</th>
				   <th>Serviceable</th>
				   <th>User</th>
				   <th>Last contact</th>
				   <th>Edit</th> --}}
				</tr>
			</thead>
			<tbody>
			@foreach ($accounts->sortByDesc('created_at') as $account)
				<tr>

					<td><a href="/instagram-accounts/{{ $account->id }}">{{ $account->id }}</a></td>
					<td>{{ $account->username }}</td>
					<td><a href="https://publish.buffer.com/profile/{{ $account->buffer_id }}" target="_BLANK" rel="noopener noreferrer">{{ $account->buffer_id }}</a></td>
					<td class="text-{{ $account->is_scrapeable  ? 'muted' : 'secondary' }}">
						<checkbox-toggle-component checked="{{$account->is_scrapeable ? true : false}}" title="Is scrapeable" url="/instagram-accounts/{{$account->id}}" column_title="is_scrapeable"></checkbox-toggle-component>
					</td>
	                    <td>
	                    	<select-component :options="{{$users}}" title="Is serviceable" url="/instagram-accounts/{{$account->id}}" column_title="user_id" current_value="{{$account->user_id}}"></select-component>
						</td>
					@if ($account->latestScrape)
						<td>{{ number_format($account->latestScrape->followers_count) }}</td>
						<td>{{ number_format($account->latestScrape->following_count) }}</td>
						@if(!$account->latestScrape->is_private)
	                        <td class="text-{{ ($account->latestScrape->avg_likes_count/$account->latestScrape->followers_count)*100 > 5  ? 'muted' : 'secondary' }}">{{ ($account->latestScrape->avg_likes_count/$account->latestScrape->followers_count)*100 > 5 ? 'Healthy' : 'Degraded' }} ({{round(($account->latestScrape->avg_likes_count/$account->latestScrape->followers_count)*100, 1)}}%)</td>
	                    @else
	                        <td class="text-muted">Unknown, private account</td>
	                    @endif
	                    <td>{{ $account->latestScrape->created_at->diffForHumans() }}</td>
                    @endif

			{{-- 		<td class="text-{{ $account->is_active  ? 'success' : 'secondary' }}">{{ $account->is_active  ? null : 'Offline' }}</td>
					<td class="text-{{ $account->is_servicable  ? 'success' : 'secondary' }}">{{ $account->is_servicable  ? null : 'Do not service' }} </td>
					<td class="text-{{ !$account->user  ? 'secondary' : null }}">{!! $account->user ? '<a href="/users/'.$account->user->id.'">'.$account->user->name."</a>" : 'No owner' !!}</td>
					<td class="text-{{ now()->diffInDays( $account->last_contact_at ) > 6  ? 'secondary' : 'muted'}}">{{ $account->last_contact_at->diffForHumans() }}</td>
					<td><a href="/Accounts/{{ $account->id }}">View</a></td> --}}
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
