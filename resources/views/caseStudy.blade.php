@extends('layouts.app')
@section('title', $title." - Case Study")
@section('meta_image', $image['url'])
@section('meta_description', strip_tags(GrahamCampbell\Markdown\Facades\Markdown::convertToHtml(str_limit($text, $limit = 150, $end = '...'))) )

@section('sidebar')
	<h2 class="text-muted">{{$price[0]['text']}}</h2>
	@if (isset($subtext))
		<p class="text-muted">{{$subtext}}</p>
	@endif
    <a class="button button-primary" href="/contact">Contact us</a>
    @if (isset($actions))
    @foreach($actions as $action)
        <a class="button button-secondary" target="_BLANK" rel="noopener noreferrer" href="{{$action['url']}}">{{$action['text']}}</a>
    @endforeach
    @endif
@endsection

@section('content')

<script type="application/ld+json">
  {
    "@context":"http://schema.org",
    "@type": "BlogPosting",
    "image": "{{$image['url']}}",
    "url": "{{url()->full()}}",
    "headline": "{{$title}} - Case Study",
    {{-- "alternativeHeadline": "An indepth article on why I love cats", --}}
{{--     "dateCreated": "2019-02-11T11:11:11",
 --}}    "datePublished": "2019-02-11T11:11:11",
{{--     "dateModified": "2019-02-11T11:11:11",
 --}}    "inLanguage": "{{ app()->getLocale() }}",
    "isFamilyFriendly": "true",
    "copyrightYear": "2019",
    "copyrightHolder": "{{config('app.name')}}",
    "contentLocation": {
      "@type": "Place",
      "name": "{{ config('blog.country_name') }}"
    },
    {{-- "accountablePerson": {
      "@type": "Person",
      "name": "Patrick Coombe",
      "url": "https://patrickcoombe.com"
    }, --}}
    "author": {
      "@type": "Organization",
      "name": "{{config('app.name')}}",
      "url": "{{config('app.url')}}"
    },
    "creator": {
      "@type": "Organization",
      "name": "{{config('app.name')}}",
      "url": "{{config('app.url')}}"
    },
    "publisher": {
      "@type": "Organization",
      "name": "{{config('app.name')}}",
      "url": "{{config('app.url')}}",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ config('app.url').config('blog.logo_url') }}",
        "width":"55",
        "height":"55"
      }
    },
    "mainEntityOfPage": "True",
    "keywords": [
      "Case Study",
      "{{config('app.name')}}",
      "Projects",
      "Clients",
      "Customers"
    ],
    "genre":["CASE-STUDIES"],
    "articleSection": "Case Studies",
    "articleBody": "{{ strip_tags(GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($text)) }}"
  }
</script>

<img src="{{$image['url']}}" style="max-height:65vh; min-height: 100px;" alt="{{$title}}" class="mb-5">
<h1>{{$title}}</h1>

@markdown($text)

{{-- <div class="card-deck mb-3 text-center">
	@foreach($price as $price)
	<div class="card mb-4 box-shadow">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">{{$price['plan']}}</h4>
		</div>
		<div class="card-body">
			<h1 class="card-title pricing-card-title">€{{$price['value']}} <small class="text-muted">/ mo</small></h1>
			@markdown
Comes with the following automations:
- Liking
- Commenting
- Following
- Unfollowing (with active followers 'don't unfollow' protection)
- Interactions based on the number of followers and/or following a user has
- Interactions based on the number of posts a user has
- Skipping private accounts, accounts with no profile picture, and/or business accounts
- Liking based on the number of existing likes a post has
- Commenting based on the number of existing comments a post has
- Commenting based on mandatory words in the description or first comment
- Comment by Locations
- Like by Locations
- Like by Tags
- Mandatory Words
- Restricting Likes
- Ignoring Users
- Ignoring Restrictions
- Excluding friends
- Smart Hashtags
- Quota Supervision
- Generate a list of a given users (e.g. your competition) Followers
- Generate a list of accounts that a given user is Following
			@endmarkdown
			<a class="button button-primary" href="/contact">Contact us</a>
		</div>
	</div>
	@endforeach
</div> --}}
@endsection
