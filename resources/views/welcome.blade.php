@extends('layouts.clean')

@section('meta_image', '/images/home_meta_image.jpg')

@section('header_scripts')
<style type="text/css">
    .no-webp .primary-header-background {
        background:url('/images/background_sky.jpg') var(--secondary);
        color: white;
    }

    .webp .primary-header-background {
        background:url('/images/background_sky.webp') var(--secondary);
        color: white;
    }

    .no-webp .looking-up-background {
        background:url('/images/person_looking_up.jpg') white;
        color: #333;
    }

    .webp .looking-up-background {
        background:url('/images/person_looking_up.webp') white;
        color: #333;
    }
</style>
@endsection

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
       "https://www.youtube.com/channel/UCXvMLmK312CfJOg8PrIhFvA",
       "https://profiles.wordpress.org/mmediagroup/",
       "https://themeforest.net/user/m-media-group"
       ]
    }
    </script>
<div class="home">
    <div class="header-section bg-secondary primary-header-background" style="background-position: right, bottom;background-repeat: no-repeat;background-size: cover;min-height:73rem;">
        <h1 class="aos-init aos-animate">Lets tell your story, <br/>together.</h1>
        <p data-aos="fade">Digital marketing can be tricky, so it’s best to leave it to those that know what they are doing. Focus on telling your story, and we'll get the listeners.</p>
        <a class="button button-primary" href="/contact" data-aos="fade" data-aos-delay="200">Talk to an expert now</a>
    </div>

    <div class="header-section row u-center-text" style="background: url('images/backgrounds/paris.svg') var(--white);background-position: center bottom;background-repeat: no-repeat;background-size: cover;min-height:75rem;">
        <div class="twelve columns">
            <span class="u-center" data-aos="fade" data-aos-delay="150" style="max-width:43rem">Honest audience</span>
            <h2 class="aos-init aos-animate u-center" data-aos="fade" >Reach genuine people that care</h2>
            <img src="/images/globe-europe.svg" alt="Multiple devices showing responsive websites" class="u-center" style="max-width: 200px; opacity: 35%;" data-aos="fade" data-aos-delay="300">
            <p class="u-center" data-aos="fade" data-aos-delay="300" style="max-width:43rem">With over 7 billion people, tastes are bound to be different. By looking at your existing fans, together we’ll be able to reach similar people that will respect and amplify your vision.</p>
        </div>
    </div>

    <div class="header-section row invert-columns u-center-text" style="background: var(--white);background-position: left bottom;background-repeat: no-repeat;background-size: contain;padding-bottom:0;">

        <div class="six columns">
            <span class="u-center" data-aos="fade" data-aos-delay="150">Deep feedback</span>
            <h2 class="u-center" data-aos="fade" data-aos-delay="50">Get fans to take meaningful action towards your goals</h2>
            <p data-aos="fade" class="u-center" data-aos="fade" data-aos-delay="300">Enable people to resonate, engage, and trade with your brand online. Guide them towards your project goals by tailoring your digital presence to what your fans need.</p>
        </div>
        <div class="six columns">
            <picture>
                <source type="image/webp" srcset="/images/person_pointing.webp">
                <source type="image/png" srcset="/images/person_pointing.png">
                <img src="/images/person_pointing.png" alt="Multiple devices showing responsive websites" class="" style="max-width: 100%;" data-aos="fade">
            </picture>
        </div>
    </div>
    <div class="header-section row looking-up-background u-center-text" style="background-position: center bottom;background-repeat: no-repeat;background-size: cover;min-height:130rem;">
        <div class="twelve columns">
            <h2 class="u-center" data-aos="fade">Be there when they look for you</h2>
            <p data-aos="fade" class="u-center" data-aos-delay="300">People are looking for something all the time. Ocassionally, they'll even look for something that you're well versed in. Be there when that happens.</p>
        </div>
    </div>
    <div class="header-section row u-center-text" style="background-position: center bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="twelve columns u-center-text">
            <span class="u-center" data-aos="fade" data-aos-delay="150">Lets talk</span>
            <h2 class="u-center" data-aos="fade">If you don't ask, <br/>you won't know</h2>
            <a class="button button-primary" href="/contact" data-aos="fade" data-aos-delay="300">Talk to a marketing pro →</a>
            <p data-aos="fade" class="u-center" data-aos-delay="300">We’re <i>very responsive</i> by email. We’re in Europe, so we’re probably awake when you are. Lets get to know each other.</p>
        </div>
    </div>

<news-slider-component></news-slider-component>
</div>
@endsection
