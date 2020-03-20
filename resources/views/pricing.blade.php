@extends('layouts.clean')
@section('title', "Pricing for ".config('app.name')." Products and Services")
@section('meta_description', "Pay as you go model, fair and transparent pricing for all web development and marketing customers." )

@section('above_container')
    <div class="header-section u-bg-primary" style="background: url('images/backgrounds/1-scaled.svg'), var(--primary);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <h1>Pricing</h1>
        <p>Products and services</p>
    </div>

<div class="row m-0 pt-5 pb-5 " data-aos="fade">

	<div class="col-md-12 u-center" style="max-width: 700px;">
    <div class="alert alert-info text-muted alert-dismissible m-0" role="alert" >
         We are monitoring the situation regarding the global outbreak of Coronavirus. Our pricing terms for businesses have been relaxed; we're here to help your business get through this. <a href="/contact">Contact us</a> to discuss monthly installments and alternate payment options.
         <br/><br/>Our Coronavirus live data tracker is <a href="/covid-19">available here</a>.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 3rem;">&times;</span>
          </button>
    </div>
	<h2 class="mt-5 mb-0">Services</h2>
	@if($plans && count($plans->data) > 0)
	<div class="table-responsive">
		<table class="table">
				<thead>
					<tr>
						<th>Service</th>
					   <th>Price</th>
					   <th>Subscribe</th>
					</tr>
				</thead>
				<tbody>
			@foreach (collect($plans->data)->sortBy('product.name') as $plan)
				@if($plan->product->active)
				<tr>
					<td>{{ $plan->product->name }}<br/><small>{{ $plan->nickname }}</small></td>
					<td>{{ $plan->amount / 100 }} {{ strtoupper($plan->currency) }} / {{ $plan->product->unit_label }}<br/><small>Per {{ $plan->interval }}</small></td>
					<td><a href="/contact">{{ __('Contact us') }}</a></td>
				</tr>
				@endif
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 You have no active subscription to an {{Config('app.name')}} service yet. When you do, it will show up here.
		</div>
	@endif
	<p class="text-muted">Example: A service that costs 12 EUR / hour and is billed once a month, means that if you use 2 hours of the service in the first week of a given month and another 2 hours during the last week of the same month, you'll be billed €12 * 4 hours, or €48, at the end of the month.</p>
	<p class="text-muted">Pricing is based per unit and units cannot be divided. As an example, website maintenance is charged by the hour. Replacing a picture might take 30 minutes, but you'll still be billed the hour. That's why its a good idea to consolidate your requests; if you send us two or three pictures to change, it's the same price as changing one.</p>
	</div>
</div>
<div class="row m-0 pt-5 pb-5 " style="background:var(--white);" data-aos="fade">
	<div class="col-md-12 u-center" style="max-width: 700px;">
	<h2 class="mt-5 mb-0">Products</h2>
	@if($products && count($products->data) > 0)
	<div class="table-responsive">
		<table class="table">
				<thead>
					<tr>
						<th>Service</th>
					   <th>Price</th>
					   <th>Subscribe</th>
					</tr>
				</thead>
				<tbody>
			@foreach (collect($products->data)->sortBy('product.name') as $plan)
				@if($plan->product->active)
				<tr>
					<td>{{ $plan->product->name }}<br/><small>{{ $plan->nickname }}</small></td>
					<td>{{ $plan->price / 100 }} {{ strtoupper($plan->currency) }}<br/><small>Per 1 unit</small></td>
					<td><a href="/contact">{{ __('Contact us') }}</a></td>
				</tr>
				@endif
			@endforeach
				<tr>
					<td>Website Development<br/><small>Informational site</small></td>
					<td>999 EUR / website<br/><small>30% upfront, 70% upon completion</small></td>
					<td><a href="/contact">{{ __('Contact us') }}</a></td>
				</tr>
				<tr>
					<td>Website Development<br/><small>Site with blog</small></td>
					<td>1,599 EUR / website<br/><small>30% upfront, 70% upon completion</small></td>
					<td><a href="/contact">{{ __('Contact us') }}</a></td>
				</tr>
				<tr>
					<td>Website Development<br/><small>Site with e-commerce</small></td>
					<td>1,999 EUR / website<br/><small>30% upfront, 70% upon completion</small></td>
					<td><a href="/contact">{{ __('Contact us') }}</a></td>
				</tr>
				<tr>
					<td>Website Development<br/><small>Custom business logic</small></td>
					<td>From 4,999 EUR / website<br/><small>30% upfront, 70% upon completion</small></td>
					<td><a href="/contact">{{ __('Contact us') }}</a></td>
				</tr>
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 You have no active subscription to an {{Config('app.name')}} service yet. When you do, it will show up here.
		</div>
	@endif
	<p class="text-muted">Example: You pay 30% upfront for a website. During the development process, you close your business and no longer need a website. Development stops and you are not obliged to pay the remaining 70%.</p>
	<p class="text-muted">Other factors may increase overall cost. For example, pricing above assumes support in only one language. Adding additional features is billed according to the Website Maintenance service.</p>

</div>
</div>
<div class="row m-0 pt-5 pb-5 " data-aos="fade">
	<div class="col-md-12 u-center" style="max-width: 700px;">
	<h2 class="mt-5 mb-0">Discounts</h2>
	@if($coupons && count($coupons->data) > 0)
	<div class="table-responsive">
		<table class="table">
				<thead>
					<tr>
					    <th>Eligibility</th>
					    <th>Reduction</th>
					    <th>Subscribe</th>
					</tr>
				</thead>
				<tbody>
			@foreach (collect($coupons->data)->sortBy('product.name') as $plan)
				@if($plan->valid)
				<tr>
					<td>{{ $plan->name }}</td>
					<td>{{ $plan->percent_off ? $plan->percent_off."%" : ($plan->amount_off/100)." EUR" }} off {{ $plan->duration }}</td>
					<td><a href="/contact">{{ __('Contact us') }}</a></td>
				</tr>
				@endif
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There are no coupons to show for {{Config('app.name')}}.
		</div>
	@endif

	<p class="text-muted">Contact us to find out if you are eligible for a discount on our products and services. Discounts only apply to products and services; one time charges, such as late payment collection fees, are not subject to discount.</p>
	<p class="text-muted">Discounts are not cumulative. If you are eligible for multiple discounts, only the discount with the highest reduction applies.</p>
	</div>
</div>
@endsection
