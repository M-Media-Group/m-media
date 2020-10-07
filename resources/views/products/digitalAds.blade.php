@extends('layouts.clean')
@section('title', $title)
@section('meta_image', $image['url'])
@section('meta_description', strip_tags(Illuminate\Mail\Markdown::parse(str_limit($text, $limit = 150, $end = '...'))) )

@section('above_container')

<script type="application/ld+json">
    {
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{$title}}",
  "image": [
    "{{$image['url']}}"
   ],
  "description": "{{ strip_tags(Illuminate\Mail\Markdown::parse(str_limit($text, $limit = 150, $end = '...'))) }}",
  "brand": {
    "@type": "Thing",
    "name": "{{config('app.name')}}"
  },
  "review": [
    {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5"
      },
      "author": {
        "@type": "Person",
        "name": "Katarzyna Gardapkhadze"
      },
      "reviewBody": "M Media is our partner of choice for developing website and branding for our new consultancy business. Excellent sense of customer needs and high-quality, data-driven solutions is what distinguishes M Media from other companies in the field."
    },
    {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5"
      },
      "author": {
        "@type": "Person",
        "name": "Benjamin Kalies"
      },
      "reviewBody": "Very serious company and very professionnel. M Media is exactly what I was looking for for my company, and they know how to make custom my strategy for my restaurant. Congtatulation !!!"
    },
    {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5"
      },
      "author": {
        "@type": "Person",
        "name": "Anthony Alessandra"
      },
      "reviewBody": "Thanks to M Media for your bespoke service! I have no doubts today, the results are there!"
    }
  ],
  "aggregateRating": {
    "@type": "AggregateRating",
    "bestRating": "5",
    "ratingValue": "5",
    "reviewCount": "3"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{url()->full()}}",
    "priceCurrency": "{{$price[0]['currency']['ISO']}}",
    "price": "{{$price[0]['value']}}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "https://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "{{config('app.name')}}"
    }
  }
}
</script>
    <div class="header-section u-bg-primary with-bg-dec" style="background:url('images/heartweb.svg'), url('images/backgrounds/1-scaled2x.svg'), var(--primary);background-position: 67vw, bottom;background-repeat: no-repeat;background-size: contain, cover;">
        <h1 class="header-section-title mb-0">Digital Advertising</h1>
        <p class="mb-0" data-aos="fade">Reach people with Google and Facebook ads.</p>
        <a class="button button-secondary mt-3 mb-5" href="/contact" data-aos="fade" data-aos-delay="300">Contact us</a>
        <a class="button white border-white text-white" href="https://blog.mmediagroup.fr/category/partnerships/" data-aos="fade" data-aos-delay="300">See case studies</a>
    </div>
    <div class="header-section row m-0" style="background: var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-12">
            <div class="u-limit-max-width u-center">
              <img src="/images/logos.png" alt="Multiple devices showing responsive websites" class="u-limit-max-width mb-5" style="width: 100%;max-height:70px;object-fit:cover;">
              <h3 class="mt-0 tect-center">Our customers trust us with over 15k EUR in ad budgets.</h3>
           </div>
            <p class="u-center">To date, we've been entrusted with over 15,000 EUR of customers hard earned money to spend on advertising their business.</p>
            <p class="u-center">On average, our customers make their advertising investments back 4 times over.</p>
        </div>
    </div>
    <div class="header-section row m-0" style="background: var(--white);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6 order-md-12 mb-5 flex" data-aos="fade-left">
            <img src="/images/devices2.svg" alt="Multiple devices showing responsive websites" class="u-full-width mb-0">
        </div>
        <div class="col-md-6 order-md-6" data-aos="fade-right">
            <h3 class="mt-0">Advertise, smart.</h3>
            <p>Facebook, Google, and Reddit ads are powerful marketing platforms that require precise application.</p>
            <p>The myriad of optimization and targeting options need to be well planned and executed.</p>
            <p>It's best to let a professional handle that.</p>
        </div>
    </div>

    <div class="header-section row m-0" style="background: var(--light);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-12">
            <div class="u-limit-max-width u-center d-none" data-aos="fade">
                <img src="/images/seo.svg" alt="Multiple devices showing responsive websites" class="u-limit-max-width mb-5">
           </div>
            <h3 class="mt-0 u-center" data-aos="fade-up">See what works.</h3>
            <p class="u-center" data-aos="fade-up">By advertising with us, you'll be able to attribute your sales to the ads that inspired them. You'll be able to tell whether your ads are working or not, in simple business terms.</p>
        </div>
    </div>

    <div class="header-section row m-0" style="background: var(--white);background-position: bottom;background-repeat: no-repeat;background-size: cover;">
        <div class="col-md-6 order-md-6 mb-5 flex" data-aos="fade-right">
            <img src="/images/webspeed.svg" alt="Multiple devices showing responsive websites" class="u-full-width mb-0">
        </div>
        <div class="col-md-6 order-md-12" data-aos="fade-left">
            <h3 class="mt-0">Optimise for ad-driven profit, not just revenue.</h3>
            <p>Our service optimises audience targeting options and makes ad-creatives suggestions as new data flows in. From day 1, your ads only get better and better by the week.</p>
        </div>
    </div>

 <div class="header-section u-bg-primary row m-0">
        <div class="col-md-12 text-center">
            <div class="flex" style="flex-wrap: wrap; flex-direction: column;">
                <h3 class="mt-0 u-center" data-aos="fade-up">Our campaigns have been seen over 10 million times.</h3>
            <p class="u-center" data-aos="fade-up">Reaching highly specific audiences that drive engagement, our ads are attributed to some of the most consistent sales records for our customers.</p>
                <a class="button button-secondary" href="/contact">Advertise with us</a>
            </div>
        </div>
    </div>

@endsection
