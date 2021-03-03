@extends('layouts.app')
@section('title', $title." - Case Study")
@section('meta_image', $image['url'])
@section('meta_description', strip_tags(Illuminate\Mail\Markdown::parse(str_limit($text, $limit = 150, $end = '...'))) )

@section('sidebar')
	<h2 class="text-muted">Case study</h2>
	@if (isset($subtext))
		<p class="text-muted">{{$subtext}}</p>
	@endif
    <a class="button button-primary" href="/contact">Contact us</a>
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
    "articleBody": "{{ strip_tags(Illuminate\Mail\Markdown::parse($text)) }}"
  }
</script>

<img src="{{$image['url']}}" style="max-height:65vh; min-height: 100px;" alt="{{$title}}" class="mb-5" data-aos="fade">
<h1 data-aos="fade">{{$title}}</h1>

{{Illuminate\Mail\Markdown::parse($text)}}
<hr>
<h2 data-aos="fade">Other case studies</h2>
 <a class="header-section d-block u-center-text bg-secondary card mb-5" href="/case-studies/breathe-as-one-festival" data-aos="fade">
        <img src="/images/case-studies/breathe-as-one/product.jpg" alt="Breathe as One Festival product shirt" class="mb-5 rounded-circle u-center" style="max-height:200px; min-height: 190px;" data-aos="fade">
        <h1 class="u-center" data-aos="fade">Breathe as One Festival</h1>
        <p class="u-center" data-aos="fade">Yearly festival bringing in hundreds of yoga and well-being enthusiasts together</p>
    </a>
    <a class="header-section d-block u-center-text text-dark card mb-5" style="background:initial;" href="/case-studies/justbookr" data-aos="fade">
        <img src="/images/case-studies/justbookr/logo.svg" alt="JustBookr logo" class="mb-5 u-center" style="max-height:200px; min-height: 190px;" data-aos="fade">
        <h1 class="u-center" data-aos="fade">JustBookr</h1>
        <p class="u-center" data-aos="fade">A global startup based in Monaco that lets students trade textbooks between each other on campus</p>
    </a>
    <a class="header-section d-block u-center-text bg-secondary card mb-5" href="/case-studies/nicolas-pisani-real-estate-agents" data-aos="fade">
        <img src="/images/realestate.svg" alt="Nicolas Pisani Real Estate Agents" class="mb-5 u-center" style="max-height:200px; min-height: 190px; max-width: 250px;" data-aos="fade">
        <h1 class="u-center" data-aos="fade">Nicolas Pisani Real Estate Agents</h1>
        <p class="u-center" data-aos="fade">Scheduling posts, writing captions and effective hashtags, and keeping your account active</p>
    </a>
@endsection
