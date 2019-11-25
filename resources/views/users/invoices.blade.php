@extends('layouts.clean')

@section('title', 'Edit a user')

@section('above_container')
    <div class="header-section u-bg-primary">
        <h1>Billing</h1>
        <p>{{$user->name}} {{$user->surname}}</p>
    </div>
@endsection

@section('content')
<h2 class="mt-5 mb-0">Subscriptions</h2>
	@if(isset($subscriptions->data) && count($subscriptions->data) > 0)
	<div class="table-responsive">
		<table class="table mb-0">
				<thead>
					<tr>
						<th>Status</th>
					   <th>ID</th>
					   <th>Plan</th>
					</tr>
				</thead>
				<tbody>
			@foreach ($subscriptions->data as $subscription)
				<tr>
					<td class="text-{{ $subscription->status == 'active'  ? 'success' : 'primary' }}">{{ ucfirst($subscription->status) }}</td>
					<td>{{ $subscription->id }}</td>
					@if(isset($subscription->plan))
						<td>{{ $subscription->plan->amount/100 }} EUR / {{ $subscription->plan->interval }}</td>
					@else
					<td>
						@foreach ($subscription->items->data as $item)
							{{ $item->plan->amount/100 }} EUR / {{ $item->plan->interval }}
							@if(!$loop->last)
						    	+
						    @endif
						@endforeach
					</td>
					@endif

				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	<div class="text-muted">
         To cancel or pause subscriptions, <a href="/contact">contact us</a>.
    </div>
	@else
		<div class="alert text-muted">
			 You have no active subscription to an {{Config('app.name')}} service yet. When you do, it will show up here.
		</div>
	@endif

	<h2 class="mt-5 mb-0">Payment methods</h2>
	@if($user->stripe_id)
	<div class="table-responsive">
		<table class="table mb-0">
				<thead>
					<tr>
					   <th>Brand</th>
					   <th>Last four</th>
					   <th>Expires</th>
					   <th>Notes</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($pmethod as $method)
				<tr>
					<td>{{ ucfirst($method->card->brand) }} {{ $method->card->funding }} card</td>
					<td class="text-muted">**** {{ $method->card->last4 }}</td>
					<td>{{ $method->card->exp_month }}/{{ $method->card->exp_year }}</td>
					<td>{{$user->card_last_four == $method->card->last4 ? 'Primary payment method' : null}}</td>
				</tr>
				@endforeach
				</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 You haven't set up a payment method yet. When you subscribe to an {{Config('app.name')}} service, you'll receive an invoice where you will be able to add a payment method.
		</div>
	@endif
{{-- 	<card-payment-component></card-payment-component>
 --}}

    <h2 class="mt-5 mb-0">All invoices</h2>
	@if(count($invoices) > 0)
    <div class="table-responsive">
		<table class="table mb-0">
				<thead>
			     <tr>
				   <th>Date</th>
				   <th>Description</th>
				   <th>Download</th>
				 </tr>
				</thead>
				<tbody>
			    @foreach ($invoices as $invoice)

			        <tr>
			            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
			            <td>
			            	@foreach ($invoice->subscriptions() as $subscription)
			            		{{$subscription->description}}
			            		@if(!$loop->last)
						    		+
						    	@endif
			            	@endforeach
			            </td>
			            <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
			        </tr>
			    @endforeach
			</tbody>
			</table>
		</div>
	@else
		<div class="alert text-muted">
	         There's no invoices to show. When you make a payment to {{config('app.name')}}, it will show here.
	    </div>
	@endif

    <h2 class="mt-5 mb-0">Discounts</h2>
	@if(count($discounts) > 0)
    <div class="table-responsive">
		<table class="table mb-0">
				<thead>
			     <tr>
				   <th>Name</th>
				   <th>Discount</th>
				 </tr>
				</thead>
				<tbody>
			        <tr>
			            <td>{{ $discounts->coupon->name }}</td>
			            <td>{{ $discounts->coupon->amount_off ? $discounts->coupon->amount_off : $discounts->coupon->percent_off."% off" }} {{ $discounts->coupon->duration }}</td>
			        </tr>
			</tbody>
			</table>
		</div>
	@else
		<div class="alert text-muted">
	         There's no discounts applied to your account.
	    </div>
	@endif

@endsection
