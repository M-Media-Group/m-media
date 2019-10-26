@extends('layouts.app')
@section('title', "About ".config('app.name') )

@section('content')

<img src="{{ config('blog.logo_url') }}"  style="max-height:200px;" class="mb-5">
<h1>{{ config('app.name') }}</h1>

<p>{{ config('app.name') }} was founded by an alumni student of the International University of Monaco, Michał, and works in the South of France (French Riviera); we design and develop websites, social media posts, and business profile pages on sites like Facebook and Instagram based on what your customers want to see.</p>
<p>{{ config('app.name') }} creates automations and lead channels for boring, repetitive, and unnecessarily expensive marketing objectives and business administration tasks!</p>
<p>We're continuous learners. Not only do we learn from the data that is collected on all our marketing projects, but we regularly take exams and earn certifications form big names like Google, HubSpot, and Adobe. Most recently, we've been awarded the Google My Business achievement award for managing businesses on Google.</p>
<p>We're strong believers that there is little room for opinion in marketing. We won't suggest colors or fonts to use based on what we feel a given day; we make decisions based on data. We look at how your customers respond to our media and continuously improve. For your business, that means happier customers as they are engaged with more relevant content, ultimately spending more on your products and services.</p>
<p>We're a highly transparent company. We build and release tools for our customers just so they can see what we do on a daily basis. For example, our customers can see a history log of all the calls they made to us, the calls we made to them, and the important automated SMS'es we might have sent. For our Instagram customers, we've built tools (and included them for free with relevant plans) to track the progress of each account as we organically grow it. All of our customers also have instant and 24/7 access to their billing and invoices so they can at any time check their expenditure against their businesses marketing objectives.</p>
<p>We're fast. Just take a look at the bottom how quickly this very page loaded! Anything we do, we do it as quickly as possible, taking into special consideration just how time-sensitive some marketing can be.</p>
<hr class="bg-dark"/>
<small class="text-muted">Page loaded in {{round((microtime(true) - LARAVEL_START), 3). " seconds"}}</small>
@endsection
