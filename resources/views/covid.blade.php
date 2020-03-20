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

        <div class="header-section" >
            <h1 class="header-section-title">There's <span class="text-danger">{{number_format($cases['Global']['All']['confirmed'])}}</span> confirmed cases of Coronavirus around the world today.</h1>
            <p class="mb-0" data-aos="fade" data-aos-delay="300">That's just the cases of Coronavirus that have been confirmed in a laboratory. With news of sketchy reporting and others staying at home, there's more cases out there.</p>
{{--             <a class="button button-secondary mt-3 mb-5" href="/contact" data-aos="fade" data-aos-delay="500">Talk to an expert now</a>
            <a class="button button-secondary text-white d-none" href="/case-studies">See case studies</a> --}}
        </div>
    <div class="header-section row m-0" style="background: var(--light);">
        <div class="col-md-6">
            <h3 class="mt-0" data-aos="fade" data-aos-offset="0"><span class="text-danger">{{number_format($cases['Global']['All']['deaths'])}}</span> people have died.</h3>
            <p style="max-width: 550px;" data-aos="fade">That's a {{number_format($cases['Global']['All']['deaths'] / $cases['Global']['All']['confirmed'] * 100)}}% mortality rate. In comparison, the death rate from seasonal flu is typically around 0.1% in the U.S., according to The New York Times. </p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
{{--                 <a class="button button-secondary u-center" href="/web-development" data-aos="fade">See our website creation offer</a>
 --}}            </div>
        </div>
    </div>

    <div class="header-section row m-0">
        <div class="col-md-6">
            <h3 class="mt-0" data-aos="fade"><span class="text-primary">{{number_format($cases['Global']['All']['recovered'] / $cases['Global']['All']['confirmed'] * 100)}}%</span> people have recovered.</h3>
            <p data-aos="fade">Discharged from hospital and at home, {{number_format($cases['Global']['All']['recovered'])}} people no longer have the Coronavirus.</p>
            <p data-aos="fade">Some sources speculate that a risk of re-infection exists. Research is still being conducted.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
{{--                 <a class="button button-secondary u-center" href="/instagram" data-aos="fade">Explore our Instagram solutions</a>
 --}}            </div>
        </div>
    </div>


 <div class="header-section row m-0" style="background: var(--light);">
        <div class="col-md-6">
            <h3 class="mt-0" data-aos="fade"><span class="text-danger">{{number_format($cases['Global']['All']['confirmed'] - $cases['Global']['All']['deaths'] - $cases['Global']['All']['recovered'])}}</span> are still being treated.</h3>
            <p data-aos="fade">That's {{number_format(($cases['Global']['All']['confirmed'] - $cases['Global']['All']['deaths'] - $cases['Global']['All']['recovered']) / $cases['Global']['All']['confirmed'] * 100)}}% of all cases that are still in hospital right now.</p>
             <p data-aos="fade">As of today, {{number_format(($cases['Global']['All']['deaths'] / $cases['Global']['All']['confirmed']) * ($cases['Global']['All']['confirmed'] - $cases['Global']['All']['deaths'] - $cases['Global']['All']['recovered']))}} more people are expected to die.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
{{--                 <a class="button button-secondary u-center" href="/contact" data-aos="fade">Talk to us</a>
 --}}            </div>
        </div>
    </div>

     <div class="header-section row m-0 u-bg-secondary">
        <div class="col-md-12">
            <h3 class="mt-0" data-aos="fade">Stay at home.</h3>
            <p data-aos="fade">The best way to prevent the spread of the disease is to stay at home.</p>
            <a class="button button-primary u-center" href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019/advice-for-public" rel="noopener" data-aos="fade">Read the WHO recommendations</a>
        </div>
    </div>

    <div class="header-section row m-0" style="background: var(--white);">
        <div class="col-md-6" data-aos="fade">
            <h3 class="mt-0" data-aos="fade">France is dealing with <span class="text-danger">{{number_format($cases['France']['All']['confirmed'] - $cases['France']['All']['deaths'] - $cases['France']['All']['recovered'])}}</span> active cases.</h3>
            <p data-aos="fade">{{number_format(($cases['France']['All']['confirmed']) / $cases['France']['All']['population'] *100, 2)}}% of the population have or have had the Coronavirus. More unreported people are likely to be sick at home.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
{{--                 <a class="button button-secondary u-center" href="/contact" data-aos="fade">Send us a message</a>
 --}}            </div>
        </div>
    </div>

    <div class="header-section row m-0" style="background: var(--light);">
        <div class="col-md-6">
            <h3 class="mt-0" data-aos="fade">Italy is at <span class="text-danger">{{number_format($cases['Italy']['All']['confirmed'] - $cases['Italy']['All']['deaths'] - $cases['Italy']['All']['recovered'])}}</span> cases.</h3>

            <p data-aos="fade">That's {{number_format(($cases['Italy']['All']['confirmed'] - $cases['Italy']['All']['deaths'] - $cases['Italy']['All']['recovered']) / $cases['Italy']['All']['population'] *100, 2)}}% of the population in hospital right now because of the Coronavirus. More unreported people are likely to be sick at home.</p>

            <p data-aos="fade">Italy has an estimated {{number_format($cases['Italy']['All']['population']/1000*3.18)}} hospital beds that are usually 78.9% occupied. That leaves just {{number_format(($cases['Italy']['All']['population']/1000*3.18) - ($cases['Italy']['All']['population']/1000*3.18 * 0.78))}} hospital beds to deal with the Coronavirus, of which an estimated {{number_format(($cases['Italy']['All']['confirmed'] - $cases['Italy']['All']['deaths'] - $cases['Italy']['All']['recovered']) / (($cases['Italy']['All']['population']/1000*3.18) - ($cases['Italy']['All']['population']/1000*3.18 * 0.78)) * 100)}}% are already in use for this exact purpose.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
{{--                 <a class="button button-secondary u-center" href="/contact" data-aos="fade">Talk to us</a>
 --}}            </div>
        </div>
    </div>

    <div class="header-section row m-0" style="background:var(--white);">
        <div class="col-md-6" data-aos="fade">
            <h3 class="mt-0" data-aos="fade">China, where the outbreak is thought to have started, now has <span class="text-danger">{{number_format($cases['China']['All']['confirmed'] - $cases['China']['All']['deaths'] - $cases['China']['All']['recovered'])}}</span> active cases.</h3>
            <p data-aos="fade">To date, China has had {{number_format($cases['China']['All']['confirmed'])}} confirmed cases of the Coronavirus.</p>
            <p>Some sources report that data from China may not be 100% accurate and estimate the actual figure to be higher.</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
{{--                 <a class="button button-secondary u-center" href="/contact" data-aos="fade">Send us a message</a>
 --}}            </div>
        </div>
    </div>

    <div class="header-section row m-0" style="background: var(--light);background-position: bottom;">
        <div class="col-md-6" data-aos="fade">
            <h3 class="mt-0" data-aos="fade">Spain has <span class="text-danger">{{number_format($cases['Spain']['All']['confirmed'])}}</span> confirmed cases.</h3>
            <p style="max-width: 550px;" data-aos="fade">{{number_format($cases['Spain']['All']['recovered'])}} have recovered while {{number_format($cases['Spain']['All']['deaths'])}} have died. Spain now accounts for {{number_format($cases['Spain']['All']['confirmed'] / ($cases['Global']['All']['confirmed'] - $cases['China']['All']['confirmed']) * 100)}}% of the global cases (excluding China).</p>
        </div>
        <div class="col-md-6 mb-5 flex">
            <div class="flex" style="flex-wrap: wrap;">
{{--                 <a class="button button-secondary u-center" href="https://blog.mmediagroup.fr" target="_BLANK" rel="noopener" data-aos="fade">Explore our blog</a>
 --}}            </div>
        </div>
    </div>

    <div class="header-section row m-0 u-bg-secondary">
        <div class="col-md-12">
            <h3 class="mt-0" data-aos="fade">Wash your hands.</h3>
            <p data-aos="fade">Wash your hands regularly to prevent the spread of the disease.</p>
            <a class="button button-primary u-center" href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019/advice-for-public" rel="noopener" data-aos="fade">Read the WHO recommendations</a>
        </div>
    </div>

    <div class="header-section u-bg-primary row m-0">
        <div class="col-md-12 text-center">
            <div class="flex" style="flex-wrap: wrap; flex-direction: column;">
                <h3 class="mt-0" data-aos="fade">This live data was pulled from our COVID-19 API</h3>
                <p data-aos="fade" data-aos-delay="300">Using information from Johns Hopkins University</p>
                <p data-aos="fade" data-aos-delay="400" class="small">Data updated every hour</p>
                <a class="button button-secondary" href="https://blog.mmediagroup.fr/post/m-media-launches-covid-19-api/" rel="noopener" data-aos="fade">Read about the API</a>
            </div>
        </div>
    </div>

@endsection
