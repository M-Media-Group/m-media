@extends('layouts.clean')

@section('above_container')
	<div class="header-section" style="background:#246EBA;">
		<h1>Instagram Accounts</h1>
		<h2>M Media Instagram Accounts</h2>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">All accounts</h2>
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
					<td class="text-{{ $account->is_scrapeable  ? 'muted' : 'primary' }}">{{ $account->is_scrapeable  ? 'Yes' : 'No' }}</td>

						@if($account->user)
	                        <td class="text-muted"><a href="/users/{{$account->user->id}}">{{$account->user->name}}</a></td>
	                    @else
	                        <td class="text-primary">No owner</td>
	                    @endif
					@if ($account->latestScrape)
						<td>{{ number_format($account->latestScrape->followers_count) }}</td>
						<td>{{ number_format($account->latestScrape->following_count) }}</td>
						@if(!$account->latestScrape->is_private)
	                        <td class="text-{{ ($account->latestScrape->avg_likes_count/$account->latestScrape->followers_count)*100 > 5  ? 'muted' : 'primary' }}">{{ ($account->latestScrape->avg_likes_count/$account->latestScrape->followers_count)*100 > 5 ? 'Healthy' : 'Degraded' }} ({{round(($account->latestScrape->avg_likes_count/$account->latestScrape->followers_count)*100, 1)}}%)</td>
	                    @else
	                        <td class="text-muted">Unknown, private account</td>
	                    @endif
	                    <td>{{ $account->latestScrape->created_at->diffForHumans() }}</td>
                    @endif

			{{-- 		<td class="text-{{ $account->is_active  ? 'success' : 'primary' }}">{{ $account->is_active  ? null : 'Offline' }}</td>
					<td class="text-{{ $account->is_servicable  ? 'success' : 'primary' }}">{{ $account->is_servicable  ? null : 'Do not service' }} </td>
					<td class="text-{{ !$account->user  ? 'primary' : null }}">{!! $account->user ? '<a href="/users/'.$account->user->id.'">'.$account->user->name."</a>" : 'No owner' !!}</td>
					<td class="text-{{ now()->diffInDays( $account->last_contact_at ) > 6  ? 'primary' : 'muted'}}">{{ $account->last_contact_at->diffForHumans() }}</td>
					<td><a href="/Accounts/{{ $account->id }}">View</a></td> --}}
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no phone numbers associated with your account. When you asscociate a phone number with your M Media account, you access more and better services via phone, and ensure more security over your account.
		</div>
	@endif
</div>
@endsection
