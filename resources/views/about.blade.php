@extends('layouts.app')
@section('title', "About ".config('app.name') )

@section('content')

<img src="{{ config('blog.logo_url') }}"  style="max-height:200px;" class="mb-5">
<h1>{{ config('app.name') }}</h1>

<p>{{ config('app.name') }} was founded by an Alumni student of the International University of Monaco, Michał, and works in the South of France (French Riviera); we design and develop websites, social media posts, and business profile pages on sites like Facebook and Instagram based on what your customers want to see.</p>
<p>{{ config('app.name') }} creates automations and lead channels for boring, repetitive, and unnecessarily expensive marketing objectives and business administration tasks!</p>
<hr class="bg-dark"/>

@endsection
