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
    <div class="header-section" style="background:#246EBA;">
        <h1 class="header-section-title">Hi 👋! We're {{config('app.name')}}.</h1>
        <h2>We make websites and handle your marketing.</h2>
        <a class="button button-primary mt-5 mr-3" href="/contact">Contact us</a>
        <a class="button button-secondary text-white d-none" href="/case-studies">See case studies</a>
    </div>
    <div class="action-section container">
        <img src="images/devices2.svg" alt="Multiple devices showing responsive websites" style="max-height:150px;min-height: 80px;" class="mb-5">
        <p>Based in the South of France and founded in 2018 by alumni of the International University of Monaco; we design websites, social media posts, and business profile pages on sites like Facebook and Instagram based on what your customers want to see. Some social media managers will tell you need to post wacky posts to stand out, while SEO “experts” will tell you that you have to include popular keywords that you want to target, and then milk them to infinity. We don’t believe in any of that.</p>
        <p>Our philosophy stems from the idea that if the customer is happy, they will organically grow your business with you. They’ll share their experiences on a range of rating platforms, and they’ll rave about your company on social media accounts. Our job is to make your customers have an effortless, pleasant, and unobtrusive experience with your brand on the French Riviera.</p>
        <div class="flex" style="flex-wrap: wrap;">
            <!-- <a class="button button-secondary">Website development</a>
            <a class="button button-secondary">Social media management</a> -->
            <a class="button button-primary" href="/contact">Contact us</a>
            <a class="button button-secondary" href="/web-development">Web development</a>
            <a class="button button-secondary" href="/instagram">Instagram solutions</a>
        </div>
    </div>
    <div class="header-section">
        <h1 class="header-section-title">We'll connect your profiles to advanced analytics.</h1>
        <h2>You'll see who your customers really are.</h2>
    </div>
    <div class="action-section container">
        <img src="images/data.svg" alt="Data chart from web analytics" style="max-height:150px;min-height: 80px;" class="mb-5">
        <p>We're a data driven web development and marketing company. We won’t make your text in Comic Sans because ‘design’. We’ll make it a font that the data shows us converts your potential customers into paying ones.</p>
        <p>We measure this by setting up advanced web analytics systems and continuously A/B testing your website and Instagram profiles to see what elements speak best to your target market. Speaking of, in our years of experience, Comic Sans fonts have never proven successful - so stay clear of those when you’re designing some marketing pieces!</p>
        <div class="flex">
            <!-- <a class="button button-secondary">Web analytics</a>
            <a class="button button-secondary">Social media analytics</a> -->
            <a class="button button-primary" href="/contact">Contact us</a>
        </div>
    </div>
    <div class="header-section" style="background:#246EBA;">
        <h1 class="header-section-title">We make sure people don't do repetitive BS.</h1>
        <h2>You'll save a lot of time, money, and sweat.</h2>
    </div>
    <div class="action-section container">
        <div class="dynamic-images">
            <img src="images/pi.png" alt="The top of a Raspberry Pi" style="max-height:150px;display: block;margin: 0 auto;left: 0;right: 0;">
            <img src="images/pi-top.png" alt="The insides of a Raspberry Pi" style="max-height:150px;display: block;margin: 0 auto;left:30%;">
        </div>
        <p class="mt-5">Forget chasing clients for payments, sending invoices, manually ordering stock and shipping out orders, emails, and interacting with your followers on Instagram. With us, that's all handled by robots. For you, that means that you get an extra employee that works 365 days a year, 24 hours a day, doing all the things you hate. It doesn't make mistakes, and it doesn't get sick. Thanks to the advanced analytics interconnected with all our services, your automations get better by the day.</p>
        <div class="flex">
            <!-- <a class="button button-secondary">Social media automation</a>
            <a class="button button-secondary">Website automation</a> -->
            <a class="button button-primary" href="/automation-bot">Learn more</a>
        </div>
    </div>
    <div class="header-section">
        <h1 class="header-section-title">Let's build.</h1>
        <h2>Market your brand to the world!</h2>
        <a class="button button-primary mt-5" href="/contact" style="background-color: #246EBA;">Contact us</a>
    </div>
    <div class="header-section" style="background:#246EBA;background-image: url('images/background.jpg')">
        @if( config('blog.facebook_page_username'))
            <p>Facebook: <a target="_BLANK" rel="noopener noreferrer" href="{{config('blog.facebook_page_url')}}">{{config('blog.facebook_page_username')}}</a></p>
        @endif
        @if( config('blog.instagram_username'))
            <p>Instagram: <a target="_BLANK" rel="noopener noreferrer" href="{{config('blog.instagram_url')}}">{{config('blog.instagram_username')}}</a></p>
        @endif
        <p name="siren" content="telephone=no">Siren: 848 356 804</p>
    </div>

@endsection
