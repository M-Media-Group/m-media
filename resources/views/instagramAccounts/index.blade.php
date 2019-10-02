@extends('layouts.clean')

@section('above_container')
	<div class="header-section" style="background:#246EBA;">
		<h1>Instagram Accounts</h1>
		<h2>{{config('app.name')}} Instagram Accounts</h2>
	</div>
	    <h2 class="mt-5 mb-0">History</h2>
        <canvas id="myChart" height="100"></canvas>
<div class="m-3">
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
			 There's currently no phone numbers associated with your account. When you asscociate a phone number with your {{config('app.name')}} account, you access more and better services via phone, and ensure more security over your account.
		</div>
	@endif
</div>
@endsection

@section('footer_scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
<script>

var timeFormat = 'YYYY-MM-DD';
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {

        datasets: [
        @foreach($accounts->where('is_scrapeable', true)->where('user_id') as $account)
        {
            pointHitRadius: 20,
            label: '{{$account->username}} followers',
            fill: false,
            data: <?php $array = [];foreach ($account->scrapes as $scrape) {array_push($array, ["y" => $scrape->followers_count, "x" => $scrape->created_at->toDateString()]);}
echo (json_encode($array));?>,
        yAxisID: 'A',
         borderColor: ['<?php printf("#%06X", mt_rand(0, 0xFFFFFF));?>'],
            borderWidth: 2
        },
        @endforeach
       ]
    },
    options: {
        tooltips: {
            //backgroundColor: '#246EBA'
        },
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    unit: 'day',
                    parser: timeFormat,
                    round: 'day',
                    tooltipFormat: 'll'
                },
                display: true
            }],
            yAxes: [{
                id: 'A',
                ticks: {
                  //fontColor: "#246EBA",
                  precision:0
                },
                type: 'linear',
                position: 'left',
              }]
        }
    }
});
</script>
@endsection