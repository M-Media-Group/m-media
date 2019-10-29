@extends('layouts.clean')
@section('title', "Web Development for Startups and Entrepreneurs")
{{-- @section('meta_image', $image['url'])
 --}}
 @section('meta_description', 'Web development services tailored to your business needs without costing an 💪 and a 🦵.')

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
    <div class="header-section bg-primary">
        <img src="/images/laptop-and-person.svg" alt="Multiple devices showing responsive websites" style="max-height:250px;min-height: 80px;max-width: 250px;" class="mb-0">
        <h1>Websites that don't cost an 💪 and a 🦵.</h1>
        <h2>Web services for entrepreneurs.</h2>
        <a class="button button-primary mt-5 mr-3" href="/contact">Contact us</a>
        <a class="button button-secondary text-white" href="/case-studies">See case studies</a>
    </div>

    <div class="header-section text-dark row m-0" style="background:initial;">
        <div class="col-md-6 order-md-6 flex mb-5">
            <img src="/images/lightbulb.svg" alt="Multiple devices showing responsive websites" style="max-height:100%;min-height: 80px; margin: 0 auto;">
        </div>
        <div class="col-md-6 order-md-12">
{{--             <h3>Got a great business idea that could really work?</h3>
 --}}            <h3>You've got a great business idea that could really work.</h3>
            <p style="max-width: 550px;">You're here to find out how to get a minimum viable product online and in front of your target market. You need a low-cost, quick, and custom coded website.</p>
            <p>We're here to help.</p>
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-primary" href="/web-development">See our website creation offer</a>
            </div>
        </div>
    </div>

    <div class="header-section bg-light text-dark row m-0">
        <div class="col-md-6 order-md-12 flex mb-5">
            <img src="/images/tabletshop.svg" alt="Multiple devices showing responsive websites" style="max-height:100%;min-height: 80px; margin: 0 auto;">
        </div>
        <div class="col-md-6 order-md-6">
            <h3>You need to get your idea online quickly so that people can start using, testing, and buying it.</h3>
            <p style="max-width: 550px;">You'd like to test your product market fit with your target audience. For that, you need an online sales channel. Quickly.</p>
            <p>That's what we do.</p>
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-primary" href="/web-development">Websites in ≈ a month</a>
            </div>
        </div>
    </div>


 <div class="header-section text-dark row m-0" style="background:initial;">
        <div class="col-md-6 order-md-6 flex mb-5">
            <img src="/images/hearts.svg" alt="Multiple devices showing responsive websites" style="max-height:100%;min-height: 80px; margin: 0 auto;">
        </div>
        <div class="col-md-6 order-md-12">
            <h3>You're looking for someone as passionate as you.</h3>
            <p style="max-width: 550px;">You've thought long and hard over your idea. You're open to suggestions but ultimately you need things done efficiently once you take a decision.</p>
            <p>That's us.</p>
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-primary" href="/case-studies">Read about our previous work</a>
            </div>
        </div>
    </div>

    <div class="header-section bg-light text-dark row m-0">
        <div class="col-md-6 order-md-12 flex mb-5">
            <img src="/images/people.svg" alt="Multiple devices showing responsive websites" style="max-height:300px;min-height: 80px; margin: 0 auto;" class="shadow-filter">
        </div>
        <div class="col-md-6 order-md-6">
            <h3>You call for a skilled, responsive, and dynamic team.</h3>
            <p style="max-width: 550px;">Ideas evolve as you get more real-world market feedback. You need your website handled by a team that can respond and adapt to those changes, quickly.</p>
            <p>Respond and adapt. Got it.</p>
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-primary" href="/case-studies">Read our case studies</a>
            </div>
        </div>
    </div>

    <div class="header-section text-dark row m-0" style="background:initial;">
        <div class="col-md-6 order-md-6 flex mb-5">
            <img src="/images/fireworks.svg" alt="Multiple devices showing responsive websites" style="max-height:350px;min-height: 80px; margin: 0 auto;">
        </div>
        <div class="col-md-6 order-md-12">
            <h3>You want to keep it budget-friendly.</h3>
            <p style="max-width: 550px;">While you believe in your product and you know marketing takes a big chunk of capital, you still need money to invest in product development and research.</p>
            <p>We understand. Oh, look:</p>
            <div class="flex" style="flex-wrap: wrap;">
                <a class="button button-primary" href="/case-studies">Websites for half the market price</a>
            </div>
        </div>
    </div>

     <div class="header-section bg-primary row m-0">
        <div class="col-md-12 text-center">
            <img src="/images/heart.svg" alt="Multiple devices showing responsive websites" style="max-height:150px;min-height: 80px;" class="mb-5 shadow-filter">
            <h3>It's a match!</h3>
            <p style="max-width: 550px; margin: 0 auto; margin-bottom: 2.5rem;"></p>
            <div class="flex" style="flex-wrap: wrap; flex-direction: column;">
                <a class="button button-primary" href="/contact">Say hi :)</a>
                <a class="button button-secondary text-white d-none" href="/case-studies/justbookr">Read a start-up case study</a>
            </div>
        </div>
    </div>

@endsection
