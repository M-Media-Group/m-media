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

Based in the South of France and founded in 2018 by alumni of the International University of Monaco; we design websites, social media posts, and business profile pages on sites like Facebook and Instagram based on what your customers want to see. Some social media managers will tell you need to post wacky posts to stand out, while SEO “experts” will tell you that you have to include popular keywords that you want to target, and then milk them to infinity. We don’t believe in any of that.

Our philosophy stems from the idea that if the customer is happy, they will organically grow your business with you. They’ll share their experiences on a range of rating platforms, and they’ll rave about your company on social media accounts. Our job is to make your customers have an effortless, pleasant, and unobtrusive experience with your brand on the French Riviera.



We're a data driven web development and marketing company. We won’t make your text in Comic Sans because ‘design’. We’ll make it a font that the data shows us converts your potential customers into paying ones.

We measure this by setting up advanced web analytics systems and continuously A/B testing your website and Instagram profiles to see what elements speak best to your target market. Speaking of, in our years of experience, Comic Sans fonts have never proven successful - so stay clear of those when you’re designing some marketing pieces!



Forget chasing clients for payments, sending invoices, manually ordering stock and shipping out orders, emails, and interacting with your followers on Instagram. With us, that's all handled by robots. For you, that means that you get an extra employee that works 365 days a year, 24 hours a day, doing all the things you hate. It doesn't make mistakes, and it doesn't get sick. Thanks to the advanced analytics interconnected with all our services, your automations get better by the day.

<hr class="bg-dark"/>
<small class="text-muted">Page loaded in {{round((microtime(true) - LARAVEL_START), 3). " seconds"}}</small>
@endsection
