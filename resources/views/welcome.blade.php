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
    <div class="header-section u-bg-primary with-bg-dec" style="background:url('images/bdevices.svg'), url('images/backgrounds/1.svg'), var(--primary);background-position: left, bottom;background-repeat: no-repeat;background-size: cover;">
        <h1 class="header-section-title mb-0">Hi 👋! We're {{config('app.name')}}.</h1>
        <p class="mb-0">We make websites and handle your marketing.</p>
        <a class="button button-secondary mt-3 mb-5" href="/contact">Contact us</a>
        <a class="button button-secondary text-white d-none" href="/case-studies">See case studies</a>
    </div>
    <div class="header-section row m-0" style="background: url('images/backgrounds/1-white.svg'), var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">

        <div class="col-md-6">
            <h3 class="mt-0">You want to get your business online.</h3>
            <p style="max-width: 550px;">You're here to find out how to get a business website online and in front of your target market. You need a low-cost, quick, and custom coded solution.</p>
            <p>We're here to help.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/web-development">See our website creation offer</a>
            </div>
        </div>
    </div>

    <div class="header-section row m-0 with-bg-dec" style="background: url('images/backgrounds/1.svg'), var(--white);">
        <div class="col-md-6">
            <h3 class="mt-0">You're looking to reach people on Instagram.</h3>
            <p>You'd like to test your product market fit with your target audience. For that, you need an online sales channel. Quickly.</p>
            <p>That's what we do.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/web-development">Explore our Instagram solutions</a>
            </div>
        </div>
    </div>


 <div class="header-section row m-0" style="background: url('images/backgrounds/1-white.svg'), var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6">
            <h3 class="mt-0">You'd like to be visible on Facebook.</h3>
            <p>You've thought long and hard over your idea. You're open to suggestions but ultimately you need things done efficiently once you take a decision.</p>
            <p>That's us.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/case-studies">Talk to us</a>
            </div>
        </div>
    </div>

    <div class="header-section row m-0" style="background: url('images/backgrounds/1.svg'), var(--white);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6">
            <h3 class="mt-0">You need business cards, flyers, and posters.</h3>
            <p>Ideas evolve as you get more real-world market feedback. You need your website handled by a team that can respond and adapt to those changes, quickly.</p>
            <p>Respond and adapt. Got it.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/case-studies">Send us a message</a>
            </div>
        </div>
    </div>

    <div class="header-section row m-0" style="background: url('images/backgrounds/1-blue.svg'), var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6">
            <h3 class="mt-0">You'd like to know more about who we are.</h3>
            <p style="max-width: 550px;">While you believe in your product and you know marketing takes a big chunk of capital, you still need money to invest in product development and research.</p>
            <p>We understand. Oh, look:</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-secondary u-center" href="/case-studies">Read about us</a>
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
