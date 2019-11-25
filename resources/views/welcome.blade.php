@extends('layouts.clean')

@section('above_container')
    <script type="application/ld+json">
    {
      "@context" : "http://schema.org",
      "@type" : "Organization",
      "name" : "{{config('app.name')}}",
     "url" : "{{config('app.url')}}",
     "sameAs" : [
       "https://www.facebook.com/{{config('blog.facebook_page_username')}}",
       "{{config('blog.instagram_url')}}",
       "https://github.com/M-Media-Group",
       "https://twitter.com/MMediaFr",
       "https://opencollective.com/m-media",
       "https://www.linkedin.com/company/m-media-group",
       "https://www.youtube.com/channel/UCXvMLmK312CfJOg8PrIhFvA"
       ]
    }
    </script>
    <transition name="fade">
        <div class="header-section u-bg-primary with-bg-dec" style="background:url('images/bdevices.svg'), url('images/backgrounds/1.svg'), var(--primary);background-position: left, bottom;background-repeat: no-repeat;background-size: cover;">
            <h1 class="header-section-title mb-0">Hi 👋! We're {{config('app.name')}}.</h1>
            <p class="mb-0">We make websites and handle your marketing.</p>
            <a class="button button-secondary mt-3 mb-5" href="/contact">Talk to an expert now</a>
            <a class="button button-secondary text-white d-none" href="/case-studies">See case studies</a>
        </div>
    </transition>
    <div class="header-section row m-0" style="background: url('images/backgrounds/1-white.svg'), var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6">
            <h3 class="mt-0">You want to get your business online.</h3>
            <p style="max-width: 550px;">You're here to find out how to get a business website online and in front of your customers. You need a low-cost, quick, and tailored solution.</p>
            <p>We're here to help.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/web-development">See our website creation offer</a>
            </div>
        </div>
    </div>

    <div class="header-section row m-0 with-bg-dec" style="background: url('images/backgrounds/1.svg'), var(--white);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6" data-aos="fade">
            <h3 class="mt-0">You're looking to reach people on Instagram.</h3>
            <p>You'd like to run ads and engage with your target audience on Instagram. You need someone to post regularly and write captions with hashtags.</p>
            <p>That's what we do.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/instagram">Explore our Instagram solutions</a>
            </div>
        </div>
    </div>


 <div class="header-section row m-0" style="background: url('images/backgrounds/1-white.svg'), var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6" data-aos="fade">
            <h3 class="mt-0">You'd like to be visible on Facebook.</h3>
            <p>You've discovered that your clients are Facebook users, and you'd like someone to keep them engaged with a Facebook page and some Facebook ads.</p>
            <p>That's us.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/contact">Talk to us</a>
            </div>
        </div>
    </div>

    <div class="header-section row m-0" style="background: url('images/backgrounds/1.svg'), var(--white);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6" data-aos="fade">
            <h3 class="mt-0">You'd like some help on your digital strategy.</h3>
            <p>You're not 100% sure if Instagram or Facebook are the right solutions for you, or you can't decide how much of your business logic should be online.</p>
            <p>We can help.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/contact">Send us a message</a>
            </div>
        </div>
    </div>

    <div class="header-section row m-0" style="background: url('images/backgrounds/1-blue.svg'), var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6" data-aos="fade">
            <h3 class="mt-0">You'd like to know more about who we are.</h3>
            <p style="max-width: 550px;">You're intrigued with our offers but you'd still like to read up about who we are.</p>
            <p>Not a problem.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/about">Read about us</a>
            </div>
        </div>
    </div>

    <div class="header-section u-bg-primary row m-0">
        <div class="col-md-12 text-center">
            <div class="flex" style="flex-wrap: wrap; flex-direction: column;">
                <a class="button button-secondary" href="/contact">Let's talk :)</a>
                <a class="button button-secondary text-white d-none" href="/case-studies/justbookr">Read a start-up case study</a>
            </div>
        </div>
    </div>

@endsection
