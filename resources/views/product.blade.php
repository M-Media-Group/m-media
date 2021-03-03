@extends('layouts.app')
@section('title', $title)
@section('meta_image', $image['url'])
@section('meta_description', strip_tags(Illuminate\Mail\Markdown::parse(str_limit($text, $limit = 150, $end = '...'))) )

@section('sidebar')
	<h2 class="text-muted">{{$price[0]['text']}}</h2>
	@if (isset($subtext))
		<p class="text-muted">{{$subtext}}</p>
	@endif
    <a class="button button-primary" href="/contact">Contact us</a>
    @if (isset($actions))
    @foreach($actions as $action)
        <a class="button button" target="_BLANK" rel="noopener noreferrer" href="{{$action['url']}}">{{$action['text']}}</a>
    @endforeach
    @endif
@endsection

@section('content')

<script type="application/ld+json">
	{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{$title}}",
  "image": [
    "{{$image['url']}}"
   ],
  "description": "{{ strip_tags(Illuminate\Mail\Markdown::parse(str_limit($text, $limit = 150, $end = '...'))) }}",
  "brand": {
    "@type": "Thing",
    "name": "{{config('app.name')}}"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "bestRating": "5",
    "ratingValue": "5",
    "reviewCount": "1"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{url()->full()}}",
    "priceCurrency": "{{$price[0]['currency']['ISO']}}",
    "price": "{{$price[0]['value']}}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "https://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "{{config('app.name')}}"
    }
  }
}
</script>
<img src="{{$image['url']}}" style="max-height:65vh; min-height: 100px;" alt="{{$title}}" class="mb-5" data-aos="fade">
<h1 data-aos="fade">{{$title}}</h1>

{{Illuminate\Mail\Markdown::parse($text)}}

{{-- <div class="card-deck mb-3 u-center-text">
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
