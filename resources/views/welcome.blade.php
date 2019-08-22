@extends('layouts.clean')

@section('above_container')
    <div class="header-section">
        <h1>Hi 👋! We're M Media.</h1>
        <h2>We make websites and handle your marketing.</h2>
    </div>
    <div class="action-section container">
        <img src="images/devices2.svg" style="max-height:150px;" class="mb-5">
        <p>Founded in 2018 by alumni of the International University of Monaco and based in the South of France; we design websites, social media posts, and business profile pages on sites like Facebook and Instagram based on what your customers want to see. Some social media managers will tell you need to post wacky posts to stand out, while SEO “experts” will tell you that you have to include popular keywords that you want to target, and then milk them to death. We don’t believe in any of that.</p>
        <p>Our philosophy stems from the idea that if the customer is happy, they will organically grow your business with you. They’ll share their experiences on a range of rating platforms, and they’ll rave about your company on social media accounts. Our job is to make your customers have an effortless, pleasant, and unobtrusive experience with your brand.</p>
        <div class="flex" style="flex-wrap: wrap;">
            <!-- <a class="button button-secondary">Website development</a>
            <a class="button button-secondary">Social media management</a> -->
            <a class="button button-secondary" href="/automation-bot">Automation bot</a>
            <a class="button button-secondary" href="/instagram">Instagram solutions</a>
            <a class="button button-primary" href="mailto:contact@mmediagroup.fr">Contact us</a>
        </div>
    </div>
    <div class="header-section" style="background:#246EBA;">
        <h1>We'll connect your profiles to advanced analytics.</h1>
        <h2>You'll see who your customers really are.</h2>
    </div>
    <div class="action-section container">
        <img src="images/data.svg" style="max-height:150px;" class="mb-5">
        <p>We're a data driven company. We won’t make your text pink and your titles in Comic Sans because ‘design’. We’ll make it pink and Comic Sans because the data shows us that that's what converts your potential customers into paying ones.</p>
        <p>We measure this by setting up advanced analytics systems and continuously A/B testing your website to see what design elements speak the most to your target market. Speaking of, in our years of experience, pink text and Comic Sans fonts have never proven successful - so stay clear of those when you’re designing some marketing pieces!</p>
        <div class="flex">
            <!-- <a class="button button-secondary">Web analytics</a>
            <a class="button button-secondary">Social media analytics</a> -->
            <a class="button button-primary" href="mailto:contact@mmediagroup.fr">Contact us</a>
        </div>
    </div>
    <div class="header-section">
        <h1>We make sure people don't do repetitive BS.</h1>
        <h2>You'll save a lot of time, money, and sweat.</h2>
    </div>
    <div class="action-section container">
        <div class="dynamic-images">
            <img src="images/pi.png" style="max-height:150px;display: block;margin: 0 auto;left: 0;right: 0;">
            <img src="images/pi-top.png" style="max-height:150px;display: block;margin: 0 auto;left:30%;">
        </div>
        <p class="mt-5">Forget chasing clients for payments, sending invoices, manually ordering stock and shipping out orders, emails, and interacting with your followers on Instagram. With us, that's all handled by robots. For you, that means that you get an extra employee that works 365 days a year, 24 hours a day, doing all the things you hate. It doesn't make mistakes, and it doesn't get sick. Thanks to the advanced analytics interconnected with all our services, your automations get better by the day.</p>
        <div class="flex">
            <!-- <a class="button button-secondary">Social media automation</a>
            <a class="button button-secondary">Website automation</a> -->
            <a class="button button-primary" href="/automation-bot">Learn more</a>
        </div>
    </div>
    <div class="header-section" style="background:#246EBA;background-image: url('images/background.jpg')">
        <h1>Let's build.</h1>
        <h2>Unlock your brand to the world!</h2>
        <a class="button button-primary" href="mailto:contact@mmediagroup.fr">Contact us</a>
    </div>
    <div class="header-section" style="background:#2565aa;">
        @if( config('blog.facebook_page_username'))
            <p>Facebook: <a href="{{config('blog.facebook_page_url')}}">{{config('blog.facebook_page_username')}}</a></p>
        @endif
        @if( config('blog.instagram_username'))
            <p>Instagram: <a href="{{config('blog.instagram_url')}}">{{config('blog.instagram_username')}}</a></p>
        @endif
        <p name="siren" content="telephone=no">Siren: 848 356 804</p>
    </div>

@endsection
