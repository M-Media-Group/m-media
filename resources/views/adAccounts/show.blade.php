@extends('layouts.clean')

@section('above_container')
    <div class="header-section bg-secondary">
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
                    <th>Managed by {{ config('app.name') }}</th>
                    <td class="text-{{ $adAccount->is_managed  ? 'muted' : 'secondary' }}">{{ $adAccount->is_managed  ? 'Yes' : 'No' }} </td>
                </tr>

                <tr>
                    <th>Owned by</th>
                    <td class="text-{{ !$adAccount->user  ? 'secondary' : null }}">{!! $adAccount->user ? '<a href="/users/'.$adAccount->user->id.'">'.$adAccount->user->name."</a>" : 'No owner' !!}</td>
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
                       <th>Name</th>
{{--                        <th>Impressions</th>
                       <th>Clicks</th> --}}
	                   <th>Click through rate</th>
                       <th>Cost per click</th>
	                   <th>Cost</th>
                       <th>Is M Media ad</th>
                       <th>Created at</th>
	                </tr>
	            </thead>
	            <tbody>
	    @foreach($ads->sortByDesc('created_at') as $ad)
	            <tr>
                    <td>
                        @if($ad->is_active)
                            <div class="text-primary" style="background: var(--primary);border-radius: 50%;display: inline-block;height:1rem;margin-right: 5px;width: 1rem;"></div>
                        @endif
                        {{$ad->name}} <span class="text-muted">{{$ad->id}}</span></td>
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
                    @if($ad->is_managed_by_mmedia)
                        <td class="text-secondary">Yes</td>
                    @elseif($adAccount->platform->name == "Facebook Ads")
                        @can('update ad', $ad)
                        <td>
                            <form action="/ad-platforms/facebook/ads/{{$ad->id}}/update-tags" method="post">
                                @csrf
                                <button type="submit" class="button button-primary">Mark as M Media ad</button>
                            </form>
                        </td>
                        @else
                            <td class="text-muted">No</td>
                        @endcan
                    @else
                        <td class="text-muted">No</td>
                    @endif
                    <td class="text-muted">{{ optional($ad->created_at)->diffForHumans() }}</td>
	            </tr>
	    @endforeach

	         </tbody>
             <tfoot>
                <tr>
                    <td>Averages, Total</td>
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
                    <td> </td>
                    <td> </td>
                </tr>
            </tfoot>
	        </table>
	    </div>
        <p class="text-muted mb-0">* The costs indicate what you paid to {{ $adAccount->platform->name }}, not us.</p>
        <p class="mb-5 text-muted">* Ads with a <span class="text-primary" style="background: var(--primary);border-radius: 50%;display: inline-block;height:1rem;width: 1rem;"></span> symbol are currently delivering.</p>

	    @else
	        <div class="alert text-muted">
	             There's no ads to show right now.
	        </div>
	    @endif
	    <a href="#app">Jump to top</a>

<div class="row m-0 pt-5 pb-5">
    <h2 class="mt-5 mb-0" id="help">From our Help Center</h2>
    @if($adAccount->platform->name == "Facebook Ads")
        <block-post-component category="53"></block-post-component>
    @elseif($adAccount->platform->name == "Google Ads")
        <block-post-component category="286"></block-post-component>
    @else
        <block-post-component category="53"></block-post-component>
        <block-post-component category="286"></block-post-component>
    @endif
</div>
@endsection
