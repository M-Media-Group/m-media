@extends('layouts.clean')

@section('above_container')
    <div class="header-section u-bg-primary">
        <h1>{{$adAccount->name}}</h1>
        <h2>{{config('app.name')}} Ad account</h2>
    </div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
<h2 class="mt-5 mb-0">Ad account data</h2>
<div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>Platform</th>
                    <td>{{$adAccount->platform->name}}</td>
                </tr>
                <tr>
                    <th>Managed by M Media</th>
                    <td class="text-{{ $adAccount->is_managed  ? 'muted' : 'primary' }}">{{ $adAccount->is_managed  ? 'Yes' : 'No' }} </td>
                </tr>

                <tr>
                    <th>Owned by</th>
                    <td class="text-{{ !$adAccount->user  ? 'primary' : null }}">{!! $adAccount->user ? '<a href="/users/'.$adAccount->user->id.'">'.$adAccount->user->name."</a>" : 'No owner' !!}</td>
                </tr>
                <tr>
                    <th>Created</th>
                    <td class="text-muted">{{ $adAccount->created_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th>External ID</th>
                    <td class="text-muted">{{ $adAccount->external_account_id }}</td>
                </tr>
                <tr>
                    <th>ID</th>
                    <td class="text-muted">{{ $adAccount->id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="mb-5"></p>
        @if (Auth::user()->can('update', $adAccount))
            @if($adAccount->is_managed)
                <a class="button button-primary" href="/contact">
                    {{ __('Comission an ad') }}
                </a>
            @else
            <a class="button button-primary" href="/contact">
                {{ __('Request M Media to manage the account') }}
            </a>
            @endif
        @else
            <a class="button button-primary" href="/contact">
                {{ __('Get help') }}
            </a>
        @endif

         <h2 class="mt-5 mb-0" id="adAccounts">{{ $ads->count() }} ads</h2>
	    @if($ads->count() > 0)
	     <div class="table-responsive table-hover">
	        <table class="table mb-0 table-sm">
	            <thead>
	                <tr>
                       <th>Delivering</th>
                       <th>Name</th>
{{--                        <th>Impressions</th>
                       <th>Clicks</th> --}}
	                   <th>Click through rate</th>
                       <th>Cost per click</th>
	                   <th>Cost</th>
	                </tr>
	            </thead>
	            <tbody>
	    @foreach($ads->sortByDesc('is_active') as $ad)
	            <tr>
                    <td class="text-{{ $ad->is_active  ? 'primary' : 'muted' }}">{{ $ad->is_active  ? 'Yes' : 'No' }} </td>
                    <td>{{$ad->name}} <span class="text-muted">{{$ad->id}}</span></td>
{{--                     <td>{{ number_format($ad->impressions) }}</td>
                    <td>{{ number_format($ad->clicks) }}</td> --}}
                    @if($ad->clicks > 10)
	                <td>{{ number_format( $ad->clicks / $ad->impressions * 100, 2 ) }}%</td>
                    <td>{{ \Laravel\Cashier\Cashier::formatAmount( (int) (( $ad->cost * 100 )  / ($ad->clicks * 100)  * 100), $ad->currency ) }}</td>
                    @else
                    <td class="text-muted">N/A</td>
                    <td class="text-muted">N/A</td>
                    @endif

                    <td>{{ \Laravel\Cashier\Cashier::formatAmount((int) ($ad->cost * 100), $ad->currency) }}</td>
	            </tr>
	    @endforeach

	         </tbody>
             <tfoot>
                <tr>
                    <td>Averages, Total</td>
                    <td></td>
{{--                     <td>{{ number_format( $ads->sum('impressions') ) }}</td>
                    <td>{{ number_format( $ads->sum('clicks') ) }}</td> --}}
                    @if($ads->sum('impressions') > 100)
                    <td>{{ number_format( $ads->sum('clicks') / $ads->sum('impressions') * 100, 2) }}%</td>
                    @else
                    <td>-</td>
                    @endif
                    @if($ads->sum('clicks') > 10)
                    <td>{{ \Laravel\Cashier\Cashier::formatAmount( (int) (( $ads->sum('cost') * 100 )  / ($ads->sum('clicks') * 100)  * 100), $ad->currency ) }}</td>
                    @else
                    <td>-</td>
                    @endif
                    <td>{{ \Laravel\Cashier\Cashier::formatAmount((int) ($ads->sum('cost') * 100), $ads->first()->currency) }}</td>
                </tr>
            </tfoot>
	        </table>
	    </div>
        <p class="mb-5 text-muted">The costs indicate what you paid to {{ $adAccount->platform->name }}, not us.</p>
	    @else
	        <div class="alert text-muted">
	             There's no ads to show right now.
	        </div>
	    @endif
	    <a href="#app">Jump to top</a>


@endsection
