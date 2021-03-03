@extends('layouts.clean')

@section('title', "Website page analysis for ".$title)

@section('meta_description', "This ".config('app.name')." tool will scan and quickly analyze your website to provide you with suggestions on improving your web strategy." )

@section('above_container')
    <div class="header-section bg-secondary background-filter" style="background:linear-gradient(
      rgba(0, 0, 0, 0.3),
      rgba(0, 0, 0, 0.3)
    ),url({{$image ?? $images[0]['src'] ?? null}}), #246EBA;background-position: center;background-repeat: no-repeat;background-size: cover;">
        <h1>{{$title}}</h1>
        <p>Website page debugger</p>
    </div>
@endsection

@section('content')

    <div class="alert alert-info text-muted">
         This tool is in beta testing and some data may not be accurate.</a>
    </div>

    Jump to:
    <a href="#data">data</a> |
    <a href="#keywords">{{ number_format($detected_keywords->count()) }} keywords</a> |
    <a href="#links">{{ number_format(count($links)) }} links</a> |
    <a href="#phones">{{ number_format(count($phones)) }} phones</a> |
    <a href="#emails">{{ number_format(count($emails)) }} emails</a> |
    <a href="#pictures">{{ number_format(count($images)) }} pictures</a>

    {{-- <h2 class="mt-5 mb-0">Overview</h2>
    <ul class="list-group action-section card mb-0 mt-5 round-all-round p-0">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Website security
        <span class="badge badge-muted badge-pill">Secure</span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        SEO optimization
        <span class="badge badge-muted badge-pill">Optimized</span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-column align-items-start">
        Website coding standards
        <span class="badge badge-primary badge-pill">Needs work</span>
      </li>
    </ul>
    <small class="text-muted">See the 'Website suggestions' below for more info.</small> --}}

    <h2 class="mt-5 mb-0">Website suggestions</h2>
    <p>{{config('app.name')}} suggests the following actions to your site to improve your website performance.</p>
    @if(strlen($title) < 10 || strlen($title) > 55)
        <img src="/images/seo.svg" alt="Instagram Engagement" style="max-height:100px; min-height: 50px;max-width: 150px;" class="mt-3">
        <p class="mb-0 text-muted">To help your website look better on Google:</p>
        <p class="mb-0">- Consider adjusting your page title to be at least 10 characters long but no longer than 55 characters. It is currently {{strlen($title)}} characters</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(strlen($description) < 50 || strlen($description) > 160)
        <img src="/images/loveweb.svg" alt="Instagram Engagement" style="max-height:100px; min-height: 50px;max-width: 150px;" class="mt-3">
        <p class="mb-0 text-muted">To help Google understand your website:</p>
        <p class="mb-0">- Edit your page description to be at least 50 characters long but no longer than 160 characters. It is currently {{strlen($description)}} characters</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(count($images) < 5)
        <img src="/images/heartweb.svg" alt="Instagram Engagement" style="max-height:100px; min-height: 50px;max-width: 150px;" class="mt-3">
        <p class="mb-0 text-muted">To help your website convey a better message:</p>
        <p class="mb-0">- You currently have {{count($images)}} pictures on your website. Consider adding more photos to increase your engagement</p>
        <p class="mb-0">- If you're lazy-loading images, consider having at least 5 that aren't lazy-loaded</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @elseif(count($images) > 50)
        <img src="/images/heartweb.svg" alt="Instagram Engagement" style="max-height:100px; min-height: 50px;max-width: 150px;" class="mt-3">
        <p class="mb-0 text-muted">To help your website load faster:</p>
        <p class="mb-0">- You currently have {{count($images)}} pictures on your website. Consider reducing the amount of photos to less than 50 per page to increase your website speed</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(!$uses_google_analytics && !$uses_google_tag_manager)
        <img src="/images/analytics.svg" alt="Instagram Engagement" style="max-height:100px; min-height: 50px;max-width: 150px;" class="mt-3">
        <p class="mb-0 text-muted">To help you understand who visits your websites:</p>
        <p class="mb-0">- Consider using Google Analytics or Google Tag Manager (with Google Analytics) to track your website visitors</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(count($links) < 10)
        <img src="/images/heartweb.svg" alt="Instagram Engagement" style="max-height:100px; min-height: 50px;max-width: 150px;" class="mt-3">
        <p class="mb-0 text-muted">To help your website convey a better message:</p>
        <p class="mb-0">- You currently have {{count($links)}} links on your website, both internal and external. Consider adding more links to increase your positioning on Google</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif
    <a href="#app">Jump to top</a>

    <h2 class="mt-5 mb-0" id="data">Website data</h2>
    {{-- Google search result --}}
    <div class="mt-5 mb-5 card action-section round-all-round action-section-hover">
        <div class="pt-0">
            <a class=" " target="_BLANK" rel="noopener noreferrer" href="{{ $page->url }}">
                <div class="mb-3 small">
                    {{-- <img aria-hidden="true" class="K7JcSb" height="16" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAALVBMVEXLAAD////KAADXSEjYTEzHAADJAADedXXOExPdcXHbZ2fqpqbfenrPISHYS0tAKQ2QAAAASElEQVQYlWNgwAKY4ADC52BhhgIWDrA8CyMcsIDUMDEjBJiRBLg4uVEFWNk40QXYqSnAAhXggToM4nQgk5cP4nSo58A0Nq8DAPmPAey2ObvQAAAAAElFTkSuQmCC" width="16" alt="Image" data-atf="3"> --}}
                    ↗️
                    <span class=" ">{{str_limit($website->url.($page->path ? str_replace("/", " › ", $page->path) : ""), $limit = 40, $end = ' ...')}}</span></div>
                <div class="h3 text-secondary" aria-level="3" role="heading">{{str_limit($title, $limit = 70, $end = ' ...')}}</div>
            </a>
        </div>
        <div>
            <div class=" ">
                <div class=" "><span class="text-muted d-none">2 Feb 2018 · </span>{{str_limit($description, $limit = 170, $end = ' ...')}}</div>
            </div>
            <div class=" "></div>
        </div>
    </div>

    <div class="table-responsive table-hover">
        @if($is_wordpress)
            <span class="badge badge-dark badge-pill">Powered by WordPress</span>
        @endif
        @if($instagram_account)
            <a class="badge badge-muted badge-pill" href="/tools/instagram-account-analyzer/{{$instagram_account}}">{{-- {{ '@'.$instagram_account }} --}}Instagram</a>
        @endif
        @if($facebook_account)
            <a class="badge badge-muted badge-pill" target="_BLANK" rel="noopener noreferrer" href="https://facebook.com/{{$facebook_account}}">{{-- {{ str_replace('/', '', $facebook_account) }} --}}Facebook ↗️</a>
        @endif
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>Scheme and domain</th>
                    <td>
                        <a target="_BLANK" rel="noopener noreferrer" href="{{ $website->url }}"><span class="text-{{ isset($website->scheme) && $website->scheme == 'https'  ? 'muted' : 'secondary' }}">{{ $website->scheme ?? "No scheme" }}</span><span class="text-muted">://</span>{{ $website->host }} ↗️</a><br/>
                        <small>Registered {{$website->latest_scrape->domain_created_at->diffForHumans()}}, expires {{$website->latest_scrape->domain_expires_at->diffForHumans()}}</small>
                    </td>
                </tr>
{{--                 <tr>
                    <th>Page</th>
                    <td><a target="_BLANK" rel="noopener noreferrer" href="{{ 'https://'.$parsed_url['host'].($parsed_url['path'] ?? "/") }}">{{ $parsed_url['path'] ?? "/" }} ↗️</a></td>
                </tr> --}}
                @if(!$instagram_account && !$facebook_account)
                <tr>
                    <th>Detected social media accounts</th>
                    <td>
                            <span class="text-secondary">No accounts detected</span>
                    </td>
                </tr>
                @endif

                <tr>
                    <th>Detected analytics services</th>
                    <td>
                        @if($uses_google_analytics || $uses_google_tag_manager)
                            @if($uses_google_analytics)
                                <span class="badge badge-muted badge-pill">Google Analytics</span>
                            @endif
                            @if($uses_google_tag_manager)
                                <span class="badge badge-muted badge-pill">Google Tag Manager</span>
                            @endif
                        @else
                            <span class="text-secondary">No analytics services detected</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Locale</th>
                    <td class="text-{{ $lang ? 'muted' : 'secondary' }}">{{ $lang ?? 'No locale specified' }}</td>
                </tr>

                <tr>
                    <th>Domain name registrar</th>
                    <td>{{ $website->latest_scrape->domain_registrar }}</td>
                </tr>

                <tr>
                    <th>Domain name owner</th>
                    <td>{{ $website->latest_scrape->domain_owner }}</td>
                </tr>
                <tr>
                    <th>Page load speed</th>
                    <td class="text-{{ $execution_time < 3.7  ? 'muted' : 'secondary' }}">{{round($execution_time, 3). " seconds"}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <span class="badge badge-pill badge-muted">Scraped {{ now()->diffForHumans() }}</span>
    <br/>
    <a href="#app">Jump to top</a>

  <h2 class="mt-5 mb-0" id="keywords">Keywords</h2>
    @if($detected_keywords->count() > 0)
    <div class="table-responsive table-hover">
        <table class="table mb-0 table-sm">
            <thead>
                <tr>
                   <th>Keyword</th>
                   <th>Certainty</th>
                </tr>
            </thead>
            <tbody>
    @foreach($detected_keywords as $keyword)
    <tr>
        <td>{{$keyword->topic}}</td>
        <td style="vertical-align: middle;" class="d-print-none">
            <div class="progress">
              <div class="progress-bar bg-secondary" role="progressbar" style="width: {{($keyword->score) / $detected_keywords[0]->score * 100 }}%" aria-valuenow="{{($keyword->score) / $detected_keywords[0]->score * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </td>
        {{-- Show percentage on print page --}}
        <td class="d-none d-print-block">{{($keyword->score) / $detected_keywords[0]->score * 100 }}%</td>
    </tr>
    @endforeach
                </tbody>
        </table>
    </div>
    @else
        <div class="alert text-muted">
             There's no keywords we could detect. Currently we can only detect keywords in English, which the opening html tag of your website must specify using the locale "en", "en-US", "en-GB", or "ALL". Text must be wrapped in <code>&lt;p> &lt;/p></code> tags.
        </div>
    @endif

    <a href="#app">Jump to top</a>

    <h2 class="mt-5 mb-0" id="links">Links</h2>
    @if($links->count() > 0)
    <canvas id="myChart" height="200"></canvas>
    <div class="table-responsive table-hover">
        <table class="table mb-0 table-sm">
            <thead>
                <tr>
                   <th>Type</th>
                   <th>Link</th>
                   <th>Text</th>
                   <th>Position</th>
                </tr>
            </thead>
            <tbody>
        @foreach($links as $link)
            <tr>
                <td class="text-muted">{{ $link['is_internal']  ? "Internal" : "External" }}</td>
{{--                 {{var_dump($link['url'])}}
 --}}           <td>
                    <a href="{{ isset($link['url']) ? $link['url']['host']."?page=".ltrim($link['url']['path'] ?? null, '/') : null }}">{{$link['src']}}</a>
                </td>
                <td>{{$link['value']}}</td>
                <td class="d-print-none">
                    <div class="progress" style="position: relative;width: 10px;height: 66px;margin: 0 auto;">
                      <div class="progress-bar bg-{{ $link['is_internal']  ? "primary" : "danger" }}" style="position: absolute;top: {{($link['position'] - $body_position + 1) / ($elements_count - $body_position) * 100 }}%;width: 100%;height: 100%;" role="progressbar" aria-valuenow="{{($link['position'] - $body_position + 1) / $elements_count * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </td>
                <td class="d-none d-print-block">{{($link['position'] - $body_position + 1) / ($elements_count - $body_position) * 100 }}%</td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert text-muted">
             There's no links to show.
        </div>
    @endif
    <a href="#app">Jump to top</a>

    <h2 class="mt-5 mb-0" id="phones">Phone numbers</h2>
    @if($phones)
    <div class="table-responsive table-hover">
        <table class="table mb-0 table-sm">
            <thead>
                <tr>
                   <th>Type</th>
                   <th>Address</th>
                   <th>Text</th>
                   <th>Position</th>
                </tr>
            </thead>
            <tbody>
    @foreach($phones as $number)
            <tr>
                <td class="text-muted">{{$number['phone']['number_type']}}</td>
                <td><a href="/tools/phone-debugger/{{$number['phone']['e164']}}">{{ $number['phone']['e164'] ? $number['phone']['e164'] : $number['phone']['src'] }}</a></td>
                <td>{{$number['value']}}</td>
                <td>
                    <div class="progress" style="position: relative;width: 10px;height: 66px;margin: 0 auto;">
                      <div class="progress-bar bg-secondary" role="progressbar" style="position: absolute;top: {{($number['position'] - $body_position + 1) / $elements_count * 100 }}%;width: 100%;height: 100%;" aria-valuenow="{{($number['position'] - $body_position + 1) / $elements_count * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </td>
            </tr>
    @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert text-muted">
             There's no phone numbers to show.
        </div>
    @endif
    <a href="#app">Jump to top</a>

    <h2 class="mt-5 mb-0" id="emails">Emails</h2>
    @if($emails)
     <div class="table-responsive table-hover">
        <table class="table mb-0 table-sm">
            <thead>
                <tr>
                   <th>Link</th>
                   <th>Text</th>
                   <th>Position</th>
                </tr>
            </thead>
            <tbody>
    @foreach($emails as $email)
            <tr>
                <td><a href="#">{{ $email['src']}}</a></td>
                <td>{{$email['value']}}</td>
                <td>
                    <div class="progress" style="position: relative;width: 10px;height: 66px;margin: 0 auto;">
                      <div class="progress-bar bg-secondary" role="progressbar" style="position: absolute;top: {{($email['position'] - $body_position + 1) / $elements_count * 100 }}%;width: 100%;height: 100%;" aria-valuenow="{{($email['position'] - $body_position + 1) / $elements_count * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </td>
            </tr>
    @endforeach
         </tbody>
        </table>
    </div>
    @else
        <div class="alert text-muted">
             There's no email addresses to show.
        </div>
    @endif
    <a href="#app">Jump to top</a>

    <h2 class="mt-5 mb-0" id="pictures">Pictures</h2>
    @if($images)
    <div class="table-responsive table-hover">
        <table class="table mb-0 table-sm">
            <thead>
                <tr>
                   <th>Link</th>
                   <th>Alt text</th>
                   <th>Position</th>
                </tr>
            </thead>
            <tbody>
    @foreach($images as $media)
            <tr>
                <td><img src="{{ $media['src'] }}" class="rounded img-thumbnail" style="max-height: 100px;max-width: 100px;" alt="{{ $media['alt'] }}"> <a href="#">{{ $media['src'] }}</a></td>
                <td>{{$media['alt']}}</td>
                <td>
                    <div class="progress" style="position: relative;width: 10px;height: 66px;margin: 0 auto;">
                      <div class="progress-bar bg-secondary" role="progressbar" style="position: absolute;top: {{($media['position'] - $body_position + 1) / $elements_count * 100 }}%;width: 100%;height: 100%;" aria-valuenow="{{($media['position'] - $body_position + 1) / $elements_count * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </td>
            </tr>
            {{-- <a class="action-section card mb-5 mt-5 round-all-round action-section-hover" target="_BLANK" rel="noopener noreferrer" href="{{$media['src']}}">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="{{$media['is_relative'] ? '//'.$parsed_url['host'].'/'.str_replace('../', '', ltrim($media['src'], '/')) : $media['src']}}" class="card-img" style="object-fit: scale-down;" alt="{{$media['alt']}}">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{$media['alt'] ?? $media['src']}}</h5>
                  </div>
                </div>
              </div>
            </a> --}}
    @endforeach
     </tbody>
        </table>
    </div>
    @else
        <div class="alert text-muted">
             There's no pictures to show. {{config('app.name')}} can only detect images that are have a clear "src" attribute in the HTML 'img' tag. If you're lazy-loading images, it's possible we can't detect them.
        </div>
    @endif
    <a href="#app">Jump to top</a>

<br/>
<small class="text-muted">Page processed in {{round((microtime(true) - LARAVEL_START), 3)-round($execution_time, 3). " seconds"}}</small>
@endsection


@if(isset($links) && $links)
@section('footer_scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
<script>

var timeFormat = 'YYYY-MM-DD';
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {

        datasets: [{
        data: [{{$links->where('is_internal', true)->count()}}, {{$links->where('is_internal', false)->count()}}],
        backgroundColor: ["#246EBA", "#eb4647"]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Internal links',
        'External links'
    ]
    },
    options: {
        tooltips: {
            //backgroundColor: '#246EBA'
        },
        legend: {
            position: 'bottom'
        }
    }
});
</script>
@endsection
@endif
