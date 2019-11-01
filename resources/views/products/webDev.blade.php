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
    <div class="header-section u-bg-primary with-bg-dec" style="background:url('images/bdevices.svg'), url('images/backgrounds/404.svg'), var(--primary);background-position: left, bottom;background-repeat: no-repeat;background-size: cover;">
        <h1 class="header-section-title mb-0">Web Development</h1>
        <p class="mb-0">With free website analytics.</p>
        <a class="button button-secondary mt-3 mb-5" href="/contact">Contact us</a>
        <a class="button button-secondary text-white d-none" href="/case-studies">See case studies</a>
    </div>
    <div class="header-section row m-0" style="background: url('images/backgrounds/1-white.svg'), var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6 mb-5 flex">
            <img src="/images/devices2.svg" alt="Multiple devices showing responsive websites" class="u-full-width mb-0">
        </div>
        <div class="col-md-6">
            <h3 class="mt-0">Be relevant</h3>
            <p>You visit hundreds of sites a day. Yet, you remember just a handful of them. You remember them because they are useful, they work, and they are the answer to what you are looking for in a given moment. They are simple in their usage, and complex in their potential. Most importantly, you don't have to think about how to use them or how they work. They just do.</p><p>That's what we make - unobtrusive, elegant, and functional websites that complement your brand and satisfy your customers needs.</p>
        </div>
    </div>
    <div class="header-section row m-0" style="background: url('images/backgrounds/1.svg'), var(--white);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6 order-md-12 mb-5 flex">
            <img src="/images/devices2.svg" alt="Multiple devices showing responsive websites" class="u-full-width mb-0">
        </div>
        <div class="col-md-6 order-md-6">
            <h3 class="mt-0">Responsive design</h3>
            <p>TV's, projectors, tablets, smartphones, laptops, and computers. Whatever device, your website looks great. Heck, you could even browse the site in a Tesla and it'll look great. Just make sure you're parked!</p><p>All our websites are responsive from the get-go, so you don't have to worry about how your site will look on your clients devices. It'll look great. Always.</p>
        </div>
    </div>

    <div class="header-section row m-0" style="background: url('images/backgrounds/1-white.svg'), var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-12">
            <div class="u-limit-max-width u-center">
                <img src="/images/devices2.svg" alt="Multiple devices showing responsive websites" class="u-limit-max-width mb-5">
           </div>
            <h3 class="mt-0 u-center">SEO friendly</h3>
            <p class="u-center">Our websites make friends with search engines. We optimize sites to be clearly understood by major search engines, and we make sure that as they update their code (we're looking at you, Google), your site will be updated as well.</p>
            <p class="u-center">You'll rank well when your customers search for your brand, your products, and your services. We do this not by milking keywords and using shady techniques, but by satisfying your customer. When your customer is satisfied, then Google is satisfied too.</p>
            <p class="u-center">Just think about all the questions you've Googled and how the first couple of links answered your question. That's because Google is very good at understanding what you and your customers are looking for, and where to find it. The trick to ranking well is therefore to satisfy the needs of your customers. We do this by finding and suggesting improvements to your content depth and density.</p>
        </div>
    </div>
    <div class="header-section row m-0" style="background: url('images/backgrounds/1-white.svg'), var(--white);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-12">
            <div class="u-limit-max-width u-center">
                <img src="/images/devices2.svg" alt="Multiple devices showing responsive websites" class="u-limit-max-width mb-5">
           </div>
            <h3 class="mt-0 u-center">Blazingly fast</h3>
            <p class="u-center">Nobody likes a slow website. For every additional second that it takes your website to load, you lose around 7% of your customers (source and more info on page speed importance). Page speed is also crucial to SEO and ranking well on search engines like Google.</p>
            <p class="u-center">Because our sites are built from scratch, we include just the right amount of code that is needed to get a given task done; no more, no less. If you've ever used WordPress before, you've surely experienced situations where plugins do way more than you need, and cause the website to slow down. Or they don't do enough, so you need multiple plugins to achieve whatever you need to do.</p>
            <p class="u-center">We build websites tailored to your business needs using custom code on the Laravel framework. You don't have to know what that means, but it's enough to understand that your website is tailor made to meet your business needs while being blazingly fast.
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
