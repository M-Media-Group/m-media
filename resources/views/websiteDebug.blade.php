@extends('layouts.clean')

@section('title', "Website debugging for ".$title)

@section('meta_description', "This M Media tool will scan and quickly analyze your website to provide you with suggestions on improving your web strategy." )

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
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
    @if(strlen($title) > 10 && strlen($title) < 55)
        <p class="mb-0 text-muted">To help your website look better on Google:</p>
        <p class="mb-0">- Consider adjusting your page title to be at least 10 characters long but no longer than 55 characters</p>
        <p>- Subscribe to our <a href="mailto:contact@mmediagroup.fr">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(count($images) < 5)
        <p class="mb-0 text-muted">To help your website convey a better message:</p>
        <p class="mb-0">- You currently have {{count($images)}} pictures on your website. Consider adding more photos to increase your engagement</p>
        <p>- Subscribe to our <a href="mailto:contact@mmediagroup.fr">Web Management service</a> to implement this solution automatically</p>
    @endif

    @if(count($links) < 10)
        <p class="mb-0 text-muted">To help your website convey a better message:</p>
        <p class="mb-0">- You currently have {{count($links)}} links on your website, both internal and external. Consider adding more links to increase your positioning on Google</p>
        <p>- Subscribe to our <a href="mailto:contact@mmediagroup.fr">Web Management service</a> to implement this solution automatically</p>
    @endif
    <h2 class="mt-5 mb-0">Website data</h2>
    <div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>URL</th>
                    <td><a target="_BLANK" href="{{ urlencode($parsed_url['path']) }}">{{ urlencode($parsed_url['path']) }}</a></td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $title }}</td>
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
                    <td><a href="/tools/instagram-account-debugger{{$instagram_account}}">{{ (str_replace('/', '@', $instagram_account)) }}</a></td>
                </tr>

                <tr>
                    <th>Last scraped</th>
                    <td>{{ now()->diffForHumans() }}</td>
                </tr>
                <th>Qualifies for M Media services</th>
                    <td class="text-{{ count($images) >= 3  ? 'muted' : 'primary' }}">{{ count($images) >= 3 ? 'Yes' : 'No' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 class="mt-5 mb-0">Links</h2>
    @if($links)
    @foreach($links as $link)
            <a class="action-section card mb-5 mt-5 round-all-round action-section-hover" target="_BLANK" href="{{$link['src']}}">
              <div class="row no-gutters">
                <div class="col-md-12">
                  <div class="card-body">
                    <h5 class="card-title">{{$link['value']}}</h5>
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

    <h2 class="mt-5 mb-0">Pictures</h2>
    @if($images)
    @foreach($images as $media)
            <a class="action-section card mb-5 mt-5 round-all-round action-section-hover" target="_BLANK" href="{{$media['src']}}">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="{{$media['src']}}" class="card-img" style="object-fit: scale-down;" alt="M Media Marketing Bot">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{$media['alt']}}</h5>

                  </div>
                </div>
              </div>
            </a>
    @endforeach
    @else
        <div class="alert text-muted">
             There's no pictures to show.
        </div>
    @endif
@endsection
