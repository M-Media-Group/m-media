@extends('layouts.clean')

@section('above_container')
    <div class="header-section background-filter" style="background:url({{$phone->url}}), #246EBA;background-position: center;background-repeat: no-repeat;background-size: cover;">
        <h1>{{$phone->phone}}</h1>
        <h2>{{config('app.name')}} phone</h2>
    </div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
<h2 class="mt-5 mb-0">Phone data</h2>
<div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>Address</th>
                    <td><a target="_BLANK" rel="noopener noreferrer" href="{{ $phone->phone }}">{{$phone->phone}}</a></td>
                </tr>
                <tr>
                    <th>Is public</th>
                    <td class="text-{{ $phone->is_public  ? 'primary' : 'muted' }}">{{ $phone->is_public  ? 'Yes' : 'No' }} </td>
                </tr>

                <tr>
                    <th>Owned by</th>
                    <td class="text-{{ !$phone->user  ? 'primary' : null }}">{!! $phone->user ? '<a href="/users/'.$phone->user->id.'">'.$phone->user->name."</a>" : 'No owner' !!}</td>
                </tr>
                <tr>
                    <th>Created</th>
                    <td class="text-muted">{{ $phone->created_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th>ID</th>
                    <td class="text-muted">{{ $phone->id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="mb-5"><a href="/contact">Contact us if you need to change info about this phone.</a></p>
        @if (Auth::user()->can('update', $phone))
            @if($phone->is_public)
                <a class="button button-primary" href="/contact">
                    {{ __('Make private') }}
                </a>
            @else
            <a class="button button-primary" href="/contact">
                {{ __('Make public') }}
            </a>
            @endif
        @else
            <a class="button button-primary" href="/contact">
                {{ __('Get help') }}
            </a>
        @endif
        @can('delete', $phone)
            <form class="d-inline" method="POST" action="/phones/{{$phone->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="button button-secondary" onclick="return confirm('Please confirm you want to delete this phone forever.');">
                    {{ __('Delete phone') }}
                </button>
            </form>
        @endif
         <h2 class="mt-5 mb-0" id="phones">Phones sent</h2>
	    @if($phone->logs->count() > 0)
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
	    @foreach($phone->logs as $log)
	            <tr>
	                <td>{{ $log['status']}}</td>
	                <td>{{$log['subject']}}</td>
	                <td>{{$log->to_phone->phone}}</td>
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

	    <h2 class="mt-5 mb-0" id="phones">Phones received</h2>
	    @if($phone->received_logs->count() > 0)
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
	    @foreach($phone->received_logs as $log)
	            <tr>
	                <td>{{ $log['status']}}</td>
	                <td>{{$log['subject']}}</td>
	                <td>{{$log->phone->phone}}</td>
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

@endsection
