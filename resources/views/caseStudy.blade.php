@extends('layouts.app')
@section('title', $title." - Case Study")
@section('meta_image', $image['url'])
@section('meta_description', strip_tags(GrahamCampbell\Markdown\Facades\Markdown::convertToHtml(str_limit($text, $limit = 150, $end = '...'))) )

@section('sidebar')
	<h2 class="text-muted">Case study</h2>
	@if (isset($subtext))
		<p class="text-muted">{{$subtext}}</p>
	@endif
    <a class="button button-secondary" href="/contact">Contact us</a>
    <a class="button button" href="/case-studies">See all case studies</a>
    @if (isset($actions))
    @foreach($actions as $action)
        <a class="button button" target="_BLANK" rel="noopener noreferrer" href="{{$action['url']}}">{{$action['text']}}</a>
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
    "copyrightYear": "{{ now()->year }}",
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
        "url": "{{ config('app.url').config('blog.logo_png_url') }}",
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

@endsection