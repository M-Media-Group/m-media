@extends('layouts.clean')

@section('title', "Coronavirus COVID-19 tracking")
@section('meta_description', "Hourly updates on the global Coronavirus COVID-19 epidemic." )

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

@php
$datasets = [];

$array_one = array();
$base_array_one = array();

foreach ($history['Global']['All']['dates'] as $key => $value) {
    $base_array_one[$key] = $value;
}
foreach ($base_array_one as $key => $val) {
    array_push($array_one, ["y" => $val, "x" => $key]);
}
$data = [
'pointHitRadius' => 20,
'label' => 'Confirmed cases (logarithmic)',
'fill' => false,
'data' => $array_one,
'yAxisID' => 'A',
 'borderColor' => ['#246eb9'],
    'borderWidth' => 2
];
array_push($datasets, $data);

$array_two = array();
$base_array_two = array();

foreach ($deaths['Global']['All']['dates'] as $key => $value) {
    $base_array_two[$key] = $value;
}
foreach ($base_array_two as $key => $val) {
    array_push($array_two, ["y" => $val, "x" => $key]);
}
$data = [
'pointHitRadius' => 20,
'label' => 'Deaths (logarithmic)',
'fill' => false,
'data' => $array_two,
'yAxisID' => 'B',
 'borderColor' => ['#eb4647'],
    'borderWidth' => 2
];
array_push($datasets, $data);

@endphp

        <div class="header-section" >
            <h1 class="header-section-title">There's <span class="text-danger">{{number_format($cases['Global']['All']['confirmed'])}}</span> confirmed cases of Coronavirus around the world today.</h1>
            <iframe id="svgMapPopulationFrame" src="https://mmedia-storage-bucket.s3.eu-west-3.amazonaws.com/public_shared_assets/covid-map/index.html" width="100%" frameborder="0" scrolling="no" style="border:none;"></iframe>
            <p data-aos="fade" data-aos-delay="300">Since last week, that's an increase of {{ number_format(
                $cases['Global']['All']['confirmed'] -
                ($history['Global']['All']['dates'][Carbon\Carbon::now()->subWeeks(1)->toDateString()]))
            }} cases, or {{ number_format(
                ($cases['Global']['All']['confirmed'] -
                $history['Global']['All']['dates'][Carbon\Carbon::now()->subWeeks(1)->toDateString()]) /
                $cases['Global']['All']['confirmed'] * 100
            ) }}%.</p>
            <p class="mb-0" data-aos="fade" data-aos-delay="300">Only cases tested in a laboratory are counted; with news of sketchy reporting and others staying at home, there's more cases out there.</p>
{{--             <a class="button button-secondary mt-3 mb-5" href="/contact" data-aos="fade" data-aos-delay="500">Talk to an expert now</a>
            <a class="button button-secondary text-white d-none" href="/case-studies">See case studies</a> --}}
        </div>
    <div class="header-section row m-0" style="background: var(--light);">
        <chart-line-component :data="{{json_encode($datasets)}}" :height="225" style="width: 100%;" class="mt-5 mb-5" scale="logarithmic"></chart-line-component>
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
            <h3 class="mt-0" data-aos="fade">As of today, <span class="text-danger">{{number_format(($cases['Global']['All']['deaths'] / $cases['Global']['All']['confirmed']) * ($cases['Global']['All']['confirmed'] - $cases['Global']['All']['deaths'] - $cases['Global']['All']['recovered']))}}</span> more people are expected to die.</h3>
            <p data-aos="fade">Using the mortality rate, this many people are expected to die from Coronavirus in the coming weeks.</p>
            <p data-aos="fade">Some cases of Coronavirus are not reported, which means the actual mortality rate may be lower.</p>
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
             <p data-aos="fade"></p>
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
            <p data-aos="fade">{{number_format(($cases['France']['All']['confirmed']) / $cases['France']['All']['population'] *100, 2)}}% of the population have or have had the Coronavirus, up from last week by {{ number_format(
                ($cases['France']['All']['confirmed'] -
                $history['France']['All']['dates'][Carbon\Carbon::now()->subWeeks(1)->toDateString()]) /
                $history['France']['All']['dates'][Carbon\Carbon::now()->subWeeks(1)->toDateString()] * 100
            ) }}%. More unreported people are likely to be sick at home.</p>
{{--             <p>The mainland accounts for {{number_format(($cases['France']['France']['confirmed']) / $cases['France']['All']['confirmed'] *100, 2)}}% of all confirmed cases in France.</p>
 --}}        </div>
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

            <p data-aos="fade">According to the OECD, Italy has an estimated {{number_format(192548)}} hospital beds that are usually 78.9% occupied. That leaves just {{number_format(($cases['Italy']['All']['population']/1000*3.18) - ($cases['Italy']['All']['population']/1000*3.18 * 0.78))}} hospital beds to deal with the Coronavirus, which means the hospitals are an estimated {{number_format(($cases['Italy']['All']['confirmed'] - $cases['Italy']['All']['deaths'] - $cases['Italy']['All']['recovered']) / (($cases['Italy']['All']['population']/1000*3.18) - ($cases['Italy']['All']['population']/1000*3.18 * 0.78)) * 100)}}% full.</p>

            <p>Since last week, there's been a {{ number_format(
                ($cases['Italy']['All']['confirmed'] -
                $history['Italy']['All']['dates'][Carbon\Carbon::now()->subWeeks(1)->toDateString()]) /
                $history['Italy']['All']['dates'][Carbon\Carbon::now()->subWeeks(1)->toDateString()] * 100
            ) }}% increase in reported cases.</p>
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
            <p data-aos="fade">To date, China has had {{number_format($cases['China']['All']['confirmed'])}} confirmed cases of the Coronavirus, accounting for {{number_format($cases['China']['All']['confirmed'] / ($cases['Global']['All']['confirmed']) * 100)}}% of the global cases.</p>
            <p>Some sources report that data from China may not be 100% accurate and estimate the actual figures to be higher.</p>
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
            <p>In the past week, Spain has seen a {{ number_format(
                ($cases['Spain']['All']['confirmed'] -
                $history['Spain']['All']['dates'][Carbon\Carbon::now()->subWeeks(1)->toDateString()]) /
                $history['Spain']['All']['dates'][Carbon\Carbon::now()->subWeeks(1)->toDateString()] * 100
            ) }}% increase in reported cases.</p>
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
            <p data-aos="fade">Wash your hands with soap regularly to prevent the spread of the disease.</p>
            <a class="button button-primary u-center" href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019/advice-for-public" rel="noopener" data-aos="fade">Read the WHO recommendations</a>
        </div>
    </div>

    <div class="header-section u-bg-primary row m-0">
        <div class="col-md-12 text-center">
            <div class="flex" style="flex-wrap: wrap; flex-direction: column;">
                <h3 class="mt-0" data-aos="fade">This live data was pulled from our public COVID-19 API</h3>
                <p data-aos="fade" data-aos-delay="300">Using information from Johns Hopkins University</p>
                <p data-aos="fade" data-aos-delay="400" class="small">Data updated every hour</p>
                <a class="button button-secondary" href="https://blog.mmediagroup.fr/post/m-media-launches-covid-19-api/" rel="noopener" data-aos="fade">Read about the API</a>
            </div>
        </div>
    </div>

@endsection
