@extends('layouts.clean')

@section('above_container')
    <div class="header-section background-filter u-bg-primary" style="background:url({{$email->url}}), #246EBA;background-position: center;background-repeat: no-repeat;background-size: cover;">
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
