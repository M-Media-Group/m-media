@extends('layouts.clean')

@section('above_container')
    <div class="header-section u-bg-primary">
        <h1>{{$email->email}}</h1>
        <p>{{config('app.name')}} email</p>
    </div>
@endsection

@section('content')
	@if (session('success'))
	    <div class="alert alert-success">
	        {{session('success')}}
	    </div>
	@endif
	<div class="row m-0 pt-5 pb-5 " data-aos="fade">
		<h2 class="mt-5 mb-0">Email data</h2>

		<div class="table-responsive table-hover">
	        <table class="table mb-0">
	            <tbody>
	            	<tr>
	            		@php
$datasets = [];
    $array = array();

    $base_array = array();
    foreach ($email->logs as $scrape) {
	    if(array_key_exists($scrape->created_at->toDateString(),$base_array)) {
	    	$base_array[$scrape->created_at->toDateString()]++;
	    } else {
	    	$base_array[$scrape->created_at->toDateString()] = 1;
	    }
    }
    foreach ($base_array as $key => $val) {
    	array_push($array, ["y" => $val, "x" => $key]);
    }

    $data = [
    'pointHitRadius' => 20,
    'label' => 'Emails sent',
    'fill' => false,
    'data' => $array,
    'yAxisID' => 'A',
     'borderColor' => ['#246EBA'],
        'borderWidth' => 2
    ];
array_push($datasets, $data);

$array_two = array();

    $base_array_two = array();
    foreach ($email->received_logs as $scrape) {
	    if(array_key_exists($scrape->created_at->toDateString(),$base_array_two)) {
	    	$base_array_two[$scrape->created_at->toDateString()]++;
	    } else {
	    	$base_array_two[$scrape->created_at->toDateString()] = 1;
	    }
    }
    foreach ($base_array_two as $key => $val) {
    	array_push($array_two, ["y" => $val, "x" => $key]);
    }
    $data = [
    'pointHitRadius' => 20,
    'label' => 'Emails received',
    'fill' => false,
    'data' => $array_two,
    'yAxisID' => 'A',
     'borderColor' => ['#eb4647'],
        'borderWidth' => 2
    ];
array_push($datasets, $data);
// }
@endphp
        <chart-line-component :data="{{json_encode($datasets)}}" :height="200" style="width: 100%;"></chart-line-component>
	            	</tr>
	                <tr>
	                    <th>Address</th>
	                    <td><a target="_BLANK" rel="noopener noreferrer" href="{{ $email->email }}">{{$email->email}}</a></td>
	                </tr>
	                <tr>
	                    <th>Is public</th>
	                    <td class="text-{{ $email->is_public  ? 'primary' : 'muted' }}">{{ $email->is_public  ? 'Yes' : 'No' }} </td>
	                </tr>

	                <tr>
	                    <th>Owned by</th>
	                    <td class="text-{{ !$email->user  ? 'primary' : null }}">{!! $email->user ? '<a href="/users/'.$email->user->id.'">'.$email->user->name."</a>" : 'No owner' !!}</td>
	                </tr>
	                <tr>
	                    <th>Created</th>
	                    <td class="text-muted">{{ $email->created_at->diffForHumans() }}</td>
	                </tr>
	                <tr>
	                    <th>ID</th>
	                    <td class="text-muted">{{ $email->id }}</td>
	                </tr>
	            </tbody>
	        </table>
    	</div>
    	<p class="mb-5"><a href="/contact">Contact us if you need to change info about this email.</a></p>
    </div>
    <div class="row m-0 pt-5 pb-5 " data-aos="fade">
    	<h2 class="mt-5 mb-0" id="emails">Emails sent</h2>
	    @if($email->logs->count() > 0)
		    <div class="table-responsive table-hover">
		        <table class="table mb-0 table-sm">
		            <thead>
		                <tr>
		                   <th>Status</th>
		                   <th>Subject</th>
		                   <th>Sent to</th>
		                   <th>Sent</th>
		                </tr>
		            </thead>
		            <tbody>
			    		@foreach($email->logs->sortByDesc('created_at') as $log)
				            <tr>
				                <td>{{ $log['status']}}</td>
				                <td>{{$log['subject']}}</td>
				                <td>{{$log->to_email->email}}</td>
				                <td>{{ $log->created_at->diffForHumans() }}</td>
				            </tr>
			    		@endforeach
		         	</tbody>
		        </table>
		    </div>
	    @else
	        <div class="alert text-muted">
	             There's no messages to show.
	        </div>
	    @endif
	    <a href="#app">Jump to top</a>
	</div>
	<div class="row m-0 pt-5 pb-5 " data-aos="fade">
	    <h2 class="mt-5 mb-0" id="emails">Emails received</h2>
	    @if($email->received_logs->count() > 0)
	     <div class="table-responsive table-hover">
	        <table class="table mb-0 table-sm">
	            <thead>
	                <tr>
	                   <th>Status</th>
	                   <th>Subject</th>
	                   <th>Received from</th>
	                   <th>Sent</th>
	                </tr>
	            </thead>
	            <tbody>
		    		@foreach($email->received_logs->sortByDesc('created_at') as $log)
			            <tr>
			                <td>{{ $log['status']}}</td>
			                <td>{{$log['subject']}}</td>
			                <td>{{$log->email->email}}</td>
			                <td>{{ $log->created_at->diffForHumans() }}</td>
			            </tr>
		    		@endforeach
	        	</tbody>
	        </table>
	    </div>
	    @else
	        <div class="alert text-muted">
	             There's no messages to show.
	        </div>
	    @endif
	    <a href="#app">Jump to top</a>
	</div>
@endsection
