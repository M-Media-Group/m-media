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
       "https://www.youtube.com/channel/UCXvMLmK312CfJOg8PrIhFvA",
       "https://profiles.wordpress.org/mmediagroup/"
       ]
    }
    </script>

    <div class="alert alert-info text-muted alert-dismissible m-0" role="alert" style="position: fixed; bottom: 0;z-index: 99;">
         Looking for our Coronavirus live data tracker? It's <a href="/covid-19">right here</a>.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 3rem;">&times;</span>
          </button>
    </div>
        <div class="header-section u-bg-primary with-bg-dec" style="background:url('images/background_sky.jpg') var(--primary);background-position: right, bottom;background-repeat: no-repeat;background-size: cover;min-height:73rem;">
            <h1 class="header-section-title aos-init aos-animate text-title-heading" style="text-align: left;">Lets tell your story, <br/>together.</h1>
            <p class="mb-3 mt-3 m-text-body" data-aos="fade" data-aos-delay="300" style="text-align: left;">Marketing can be tricky, so it’s best to leave it to those that know what they are doing. That way, you tell your story while we get the listeners.</p>
            <a class="button button-secondary mt-3 mb-5" href="/contact" data-aos="fade" data-aos-delay="500">Talk to an expert now</a>
            <a class="button button-secondary text-white d-none" href="/case-studies">See case studies</a>
        </div>


    <div class="header-section row m-0" style="background: #fff;background-position: bottom;background-repeat: no-repeat;background-size: cover;min-height:68rem;">

        <div class="col-md-12 text-center">
            <p class="mb-0 mt-3 mx-auto  m-text-label" data-aos="fade" data-aos-delay="150" style="max-width:43rem">Honest audience</p>
            <h2 class="header-section-title aos-init aos-animate mx-auto mt-0 mb-5 text-title-heading" data-aos="fade" >Reach genuine people that care</h2>
            <img src="/images/globe-europe.svg" alt="Multiple devices showing responsive websites" class="u-limit-max-width mb-5" style="max-width: 200px; opacity: 50%;" data-aos="fade" data-aos-delay="300">
            <p class="mb-3 mt-3 mx-auto m-text-body" data-aos="fade" data-aos-delay="300" style="max-width:43rem">With over 7 billion people, tastes are bound to be different. By looking at your existing fans, together we’ll be able to reach similar people that will respect and amplify your vision.</p>
        </div>
    </div>

    <div class="header-section row m-0 with-bg-dec pb-0" style="background: var(--white);background-position: left bottom;background-repeat: no-repeat;background-size: contain;">

        <div class="col-md-6 order-md-2">
            <p class="mb-0 mt-3 m-text-label" data-aos="fade" data-aos-delay="150">Deep feedback</p>
            <h3 class="mt-0 text-title-heading" data-aos="fade" data-aos-delay="50">Get fans to take meaningful action towards your goals</h3>
            <p data-aos="fade" class="m-text-body" data-aos="fade" data-aos-delay="300">Enable people to resonate, engage, and trade with your brand online. Guide them towards your project goals by tailoring your digital presence to what your fans need.</p>
        </div>
        <div class="col-md-6 order-md-1">
            <img src="/images/person_pointing.png" alt="Multiple devices showing responsive websites" class="u-limit-max-width " style="max-width: 100%;" data-aos="fade">
        </div>
    </div>


 <div class="header-section row m-0 text-center" style="background: url('images/person_looking_up.jpg'), var(--light);background-position: center bottom;background-repeat: no-repeat;background-size: cover;min-height:108rem;">
    <div class="col-md-12">
        <h3 class="mt-0 mx-auto text-title-heading" data-aos="fade">Be there when they look for you</h3>
        <p data-aos="fade" class="mx-auto m-text-body" data-aos-delay="300">People are looking for something all the time. Ocassionally, they'll even look for something that you're well versed in. Be there when that happens.</p>
    </div>
</div>

 <div class="header-section row m-0 text-center" style="background: #fff;background-position: center bottom;background-repeat: no-repeat;background-size: cover;">
    <div class="col-md-12">
        <p class="mb-0 mt-3 m-text-label mx-auto" data-aos="fade" data-aos-delay="150">Lets talk</p>
        <h3 class="mt-0 mx-auto text-title-heading" data-aos="fade">If you don't ask, <br/>you won't know</h3>
        <a class="button button-secondary mt-3 mb-5" href="/contact" data-aos="fade" data-aos-delay="300">Talk to an expert now</a>
        <p data-aos="fade" class="mx-auto m-text-body" data-aos-delay="300">We’re very responsive by email. We’re in Europe, so we’re probably awake when you are. Lets get to know each other.</p>
    </div>
</div>

@endsection
