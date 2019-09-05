@extends('layouts.clean')

@section('title', 'Edit a user')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>Invoices</h1>
        <h2>{{$user->name}} {{$user->surname}}</h2>
    </div>
@endsection

@section('content')
	@if(count($invoices) > 0)
    <table style="width:100%;">
	    @foreach ($invoices as $invoice)
	        <tr>
	            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
	            <td>{{ $invoice->total() }}</td>
	            <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
	        </tr>
	    @endforeach
	</table>
	@endif

@endsection
