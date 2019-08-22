@extends('layouts.app')
@section('title', "About M Media")

@section('content')

<img src="/images/logo.svg"  style="max-height:200px;" class="mb-5">
<h1>{{ config('app.name') }}</h1>

<p>{{ config('app.name') }} was founded by an Alumni student of the International University of Monaco, Michał Wargan, and works in the South of France; we design websites, social media posts, and business profile pages on sites like Facebook and Instagram based on what your customers want to see.</p>
<p>M Media creates automations and lead channels for boring, repetitive, and unnecessarily expensive marketing objectives and business administration tasks!</p>
<hr class="bg-dark"/>
<p>More info coming soon.</p>

@markdown

@endmarkdown

@endsection
