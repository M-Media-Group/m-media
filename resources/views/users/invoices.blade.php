@extends('layouts.clean')

@section('title', 'Edit a user')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>Invoices</h1>
        <h2>{{$user->name}} {{$user->surname}}</h2>
    </div>
@endsection

@section('content')
    <h2 class="mt-5 mb-0">All invoices</h2>
	@if(count($invoices) > 0)
    <table style="width:100%;margin-bottom: 0;">
	     <tr>
		   <th>Date</th>
		   <th>Description</th>
		   <th>Download</th>
		 </tr>
	    @foreach ($invoices as $invoice)

	        <tr>
	            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
	            <td>
	            	@foreach ($invoice->subscriptions() as $subscription)
	            		{{$subscription->description}}
	            	@endforeach
	            </td>
	            <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
	        </tr>
	    @endforeach
	</table>
	<p class="mb-5"><a href="/users/{{$user->id}}/edit">View your payment methods</a></p>
	@else
		<div class="alert text-muted">
	         There's no invoices to show. When you make a payment to M Media, it will show here.
	    </div>
	@endif

@endsection
