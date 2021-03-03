@extends('layouts.clean')
@section('title', "Instagram Marketing Solutions for Businesses")

@php

$stripe = new \Stripe\StripeClient(
  config('services.stripe.secret')
);
$intent = $stripe->paymentIntents->create([
  'amount' => 2000,
  'currency' => 'eur',
  'payment_method_types' => ['card'],
]);

@endphp

@section('above_container')
            <instagram-monitoring-signup class="bg-secondary container flex" style="min-height:100vh;" stripe_key="{{config('services.stripe.key')}}" stripe_secret="{{ $intent->client_secret }}"></instagram-monitoring-signup>
@endsection
