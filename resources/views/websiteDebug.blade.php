@extends('layouts.clean')

@section('title', "Website debugging for ".$title)

@section('meta_description', "This M Media tool will scan and quickly analyze your website to provide you with suggestions on improving your web strategy." )

@section('above_container')
    <div class="header-section background-filter" style="background:linear-gradient(
      rgba(0, 0, 0, 0.3),
      rgba(0, 0, 0, 0.3)
    ),url({{$image ?? $images[0]['src'] ?? null}}), #246EBA;background-position: center;background-repeat: no-repeat;background-size: cover;">
        <h1>{{$title}}</h1>
        <h2>Website debugger</h2>
    </div>
@endsection

@section('content')

    <div class="alert alert-info text-muted">
         This tool is in beta testing and some data may not be accurate.</a>
    </div>
    <h2 class="mt-5 mb-0">Website suggestions</h2>
    <p>M Media suggests the following actions to your site to improve your website performance.</p>
    @if(strlen($title) < 10 || strlen($title) > 55)
        <p class="mb-0 text-muted">To help your website look better on Google:</p>
        <p class="mb-0">- Consider adjusting your page title to be at least 10 characters long but no longer than 55 characters. It is currently {{strlen($title)}} characters</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(strlen($description) < 50 || strlen($description) > 160)
        <p class="mb-0 text-muted">To help Google understand your website:</p>
        <p class="mb-0">- Edit your page description to be at least 50 characters long but no longer than 160 characters. It is currently {{strlen($description)}} characters</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(count($images) < 5)
        <p class="mb-0 text-muted">To help your website convey a better message:</p>
        <p class="mb-0">- You currently have {{count($images)}} pictures on your website. Consider adding more photos to increase your engagement</p>
        <p class="mb-0">- If you're lazy-loading images, consider having at least 5 that aren't lazy-loaded</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @elseif(count($images) > 50)
        <p class="mb-0 text-muted">To help your website load faster:</p>
        <p class="mb-0">- You currently have {{count($images)}} pictures on your website. Consider reducing the amount of photos to less than 50 per page to increase your website speed</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(!$uses_google_analytics && !$uses_google_tag_manager)
        <p class="mb-0 text-muted">To help you understand who visits your websites:</p>
        <p class="mb-0">- Consider using Google Analytics or Google Tag Manager (with Google Analytics) to track your website visitors</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(count($links) < 10)
        <p class="mb-0 text-muted">To help your website convey a better message:</p>
        <p class="mb-0">- You currently have {{count($links)}} links on your website, both internal and external. Consider adding more links to increase your positioning on Google</p>
        <p>- Subscribe to our <a href="/contact">Web Management service</a> to implement this solution automatically</p>
    @endif
    <h2 class="mt-5 mb-0">Website data</h2>
    <div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>URL</th>
                    <td><a target="_BLANK" rel="noopener noreferrer" href="{{ 'https://'.urlencode($parsed_url['path']) }}">{{ urlencode($parsed_url['path']) }}</a></td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $title }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $description }}</td>
                </tr>
                <tr>
                    <th>Images count</th>
                    <td>{{ number_format(count($images)) }}</td>
                </tr>

                <tr>
                    <th>Links count</th>
                    <td>{{ number_format(count($links)) }}</td>
                </tr>

                <tr>
                    <th>Detected Instagram account</th>
                    <td>
                        @if($instagram_account)
                        <a href="/tools/instagram-account-analyzer/{{$instagram_account}}">{{ '@'.$instagram_account }}</a>
                        @else
                        <span class="text-primary">No account detected</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Detected Facebook page</th>
                    <td>
                        @if($facebook_account)
                        <a target="_BLANK" rel="noopener noreferrer" href="https://facebook.com{{$facebook_account}}">{{ str_replace('/', '', $facebook_account) }}</a>
                        @else
                        <span class="text-primary">No account detected</span>
                        @endif
                    </td>
                </tr>

                <th>Uses Google Analytics</th>
                    <td class="text-{{ $uses_google_analytics  ? 'muted' : 'primary' }}">{{ $uses_google_analytics ? 'Yes' : 'No' }}</td>
                </tr>

                <th>Uses Google Tag Manager</th>
                    <td class="text-{{ $uses_google_tag_manager  ? 'muted' : 'primary' }}">{{ $uses_google_tag_manager ? 'Yes' : 'No' }}</td>
                </tr>

                <th>Is on WordPress</th>
                    <td class="text-{{ $is_wordpress  ? 'm' : 'muted' }}">{{ $is_wordpress ? 'Yes' : 'No' }}</td>
                </tr>

                <th>Locale</th>
                    <td class="text-{{ $lang ? 'muted' : 'primary' }}">{{ $lang ? $lang : 'No locale specified' }}</td>
                </tr>

                <tr>
                    <th>Last scraped</th>
                    <td>{{ now()->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th>Qualifies for M Media services</th>
                    <td class="text-{{ count($images) >= 3  ? 'muted' : 'primary' }}">{{ count($images) >= 3 ? 'Yes' : 'No' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

  <h2 class="mt-5 mb-0">Detected keywords</h2>
    @if($detected_keywords)
    @foreach($detected_keywords as $keyword => $value)
            <a class="action-section card mb-5 mt-5 round-all-round action-section-hover" target="_BLANK" rel="noopener noreferrer" href="#">
              <div class="row no-gutters">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">{{$keyword}}</h5>
                    <p class="card-text">
                        <small class="text-muted">{{$value}} points certainty</small>
                    </p>
                  </div>
                </div>
              </div>
            </a>
    @endforeach
    @else
        <div class="alert text-muted">
             There's no keywords we could detect. Currently we can only detect keywords in English, which the opening html tag of your website must specify.
        </div>
    @endif

    <h2 class="mt-5 mb-0">Pictures</h2>
    @if($images)
    @foreach($images as $media)
            <a class="action-section card mb-5 mt-5 round-all-round action-section-hover" target="_BLANK" rel="noopener noreferrer" href="{{$media['src']}}">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="{{$media['is_relative'] ? '//'.$parsed_url['path'].'/'.str_replace('../', '', ltrim($media['src'], '/')) : $media['src']}}" class="card-img" style="object-fit: scale-down;" alt="{{$media['alt']}}">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{$media['alt'] ?? $media['src']}}</h5>
                  </div>
                </div>
              </div>
            </a>
    @endforeach
    @else
        <div class="alert text-muted">
             There's no pictures to show. M Media can only detect images that are have a clear "src" attribute in the HTML 'img' tag. If you're lazy-loading images, it's possible we can't detect them.
        </div>
    @endif

    <h2 class="mt-5 mb-0">Links</h2>
    @if($links)
    @foreach($links as $link)
            <a class="action-section card mb-5 mt-5 round-all-round action-section-hover" target="_BLANK" rel="noopener noreferrer" href="{{$link['src']}}">
              <div class="row no-gutters">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">{{ $link['value'] ? $link['value'] : $link['src'] }}</h5>
                    <p class="card-text">
                        <small class="text-muted">{{ $link['is_internal']  ? "Internal" : "External" }} link</small>
                    </p>
                  </div>
                </div>
              </div>
            </a>
    @endforeach
    @else
        <div class="alert text-muted">
             There's no recent links to show.
        </div>
    @endif

@endsection
