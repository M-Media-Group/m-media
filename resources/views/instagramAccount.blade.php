@extends('layouts.clean')

@section('title', "Instagram data debugging for ".$data->fullName)
@section('meta_image', $data->profilePicture)

@section('meta_description', "This M Media tool will scan and quickly analyze your Instagram profile to provide you with suggestions on improving your Instagram strategy." )

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>{{$data->fullName}}</h1>
        <h2>Instagram data debugger</h2>
    </div>
@endsection

@section('content')
    <div class="alert alert-info text-muted">
         This tool is in beta testing and some results may not be accurate.</a>
    </div>
    <h2 class="mt-5 mb-0">Account suggestions</h2>
    <p>M Media suggests the following actions to your account to improve your Instagram performance.</p>

    @if(!$data->biography)
        <p class="mb-0 text-muted">To improve your account info:</p>
        <p>- Set a biography, or description, on your Instagram profile</p>
    @endif

    @if($data->private)
    <p class="mb-0 text-muted">To help your account reach more people:</p>
    <p>- Make your account public by switching off 'Private Account' in your Instagram settings</p>
    @endif

    @if(!$locations)
        <p class="mb-0 text-muted">To help your posts reach more people:</p>
        <p class="mb-0">- Tag locations on your Instagram posts</p>
        <p>- Subscribe to our <a href="/instagram-content-management">Instagram Content Management solutions</a></p>
    @endif

    @if(!$data->mediaCount || $data->mediaCount < 10)
        <p class="mb-0 text-muted">To grow your account:</p>
        <p class="mb-0">- You currently have {{$data->mediaCount}} posts on your profile. Consider adding more posts to grow your account</p>
        <p>- Subscribe to our <a href="/instagram-content-management">Instagram Content Management solutions</a></p>
    @endif

    @if(!$hashtags || count($hashtags) < 10)
        <p class="mb-0 text-muted">To aid your posts exposure:</p>
        <p class="mb-0">- In your recent posts, you've used {{count($hashtags)}} unique hashtags. Use at least 10 and a wider variety of them on each post to gain more exposure</p>
        <p>- Subscribe to our <a href="/instagram-content-management">Instagram Content Management solutions</a></p>
    @endif

    @if(!($data->followers) || $data->followers/$data->following <= 3)
    <p class="mb-0 text-muted">To improve your follower to following ratio:</p>
    <p class="mb-0">- Unfollow more people</p>
    <p>- Subscribe to our <a href="/instagram-engagement">Instagram Engagement solutions</a></p>
    @endif

    @if(!($data->avgPostLikes) || ($data->avgPostLikes/$data->followers) * 100 <= 5)
        <p class="mb-0 text-muted">To improve engagement health:</p>
        <p class="mb-0">- Use higher quality media posts that resonate better with your audience</p>
        <p class="mb-0">- Update the hashtags you use to hashtags that are more relevant to your users</p>
        @if($data->medias)
            <p class="mb-0">- Your last post was {{ \Carbon\Carbon::parse($data->medias[0]->date->date)->diffForHumans()}}. Try altering your posting frequency and schedule for better engagement results</p>
        @else
            <p class="mb-0">- Your have not posted a post yet. Post your first picture or video for better engagement results</p>
        @endif
        <p>- Subscribe to our <a href="/instagram-content-management">Instagram Content Management solutions</a></p>
    @endif

    @if(!$data->externalUrl)
    <p class="mb-0 text-muted">To help get more people to your website:</p>
    <p>- Include a secure external URL, or a link to your website, on your Instagram profile. It's strongly suggested your link starts with 'https' rather than 'http'</p>
    @endif

    @if($data->followers <= 100)
    <p class="mb-0 text-muted">To qualify for M Media Instagram services:</p>
    <p>- Gain a few more followers by sharing your Instagram account with friends, family, and customers</p>
    @endif

    <h2 class="mt-5 mb-0">Account data</h2>
    <div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>Instagram ID</th>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $data->userName }}</td>
                </tr>
                <tr>
                    <th>Full name</th>
                    <td>{{ $data->fullName }}</td>
                </tr>
                <tr>
                    <th>Biography</th>
                    <td>{{$data->biography}}</td>
                </tr>
{{--                 <tr>
                    <th>Profile picture URL</th>
                    <td>{{$data->profilePicture}}</td>
                </tr> --}}
                <tr>
                    <th>External URL</th>
                    <td><a href="{{$data->externalUrl}}">{{ $data->externalUrl }}</a></td>
                </tr>
                <tr>
                    <th>Media count</th>
                    <td>{{ number_format($data->mediaCount) }}</td>
                </tr>
                <tr>
                    <th>Last post</th>
                    @if($data->medias)
                        <td>{{ \Carbon\Carbon::parse($data->medias[0]->date->date)->diffForHumans()}}</td>
                   @else
                        <td>No recent posts</td>
                    @endif
                </tr>
                <tr>
                    <th>Average amount of likes per post</th>
                    <td>{{ number_format($data->avgPostLikes) }}</td>
                </tr>
                <tr>
                    <th>Average amount of comments per post</th>
                    <td>{{ number_format($data->avgPostComments) }}</td>
                </tr>
                <tr>
                    <th>Followers</th>
                    <td>{{ number_format($data->followers) }}</td>
                </tr>
                <tr>
                    <th>Following</th>
                    <td>{{ number_format($data->following) }}</td>
                </tr>
                <tr>
                    <th>Follower to following ratio health</th>
                    <td class="text-{{ $data->followers/$data->following > 3  ? 'muted' : 'primary' }}">{{ $data->followers/$data->following > 3 ? 'Healthy' : 'Degraded' }}</td>
                </tr>
                <tr>
                    <th>Engagement health</th>
                    <td class="text-{{ ($data->avgPostLikes/$data->followers)*100 > 5  ? 'muted' : 'primary' }}">{{ ($data->avgPostLikes/$data->followers)*100 > 5 ? 'Healthy' : 'Degraded' }}</td>
                </tr>
                <tr>
                    <th>Private</th>
                    <td class="text-{{ $data->private  ? 'primary' : 'muted' }}">{{ $data->private  ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>Verified</th>
                    <td class="text-{{ $data->private  ? 'muted' : 'muted' }}">{{ $data->private  ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>Last scraped</th>
                    <td>{{ now()->diffForHumans() }}</td>
                </tr>
                <th>Qualifies for M Media services</th>
                    <td class="text-{{ $data->followers > 100  ? 'muted' : 'primary' }}">{{ $data->followers > 100 ? 'Yes' : 'Not enough followers to service' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 class="mt-5 mb-0">Recent hashtags</h2>
    @if($hashtags)
    @foreach($hashtags as $hashtag)
        <a target="_BLANK" href="https://www.instagram.com/explore/tags/{{$hashtag}}">#{{$hashtag}}</a>
    @endforeach
    @else
        <div class="alert text-muted">
             There's currently no hashtags that you used in the most recent posts that we can show. <a target="_BLANK" href="https://help.instagram.com/488619974671134">Learn more on the Instagram help page</a>.
        </div>
    @endif

    <h2 class="mt-5 mb-0">Recent locations</h2>
    @if($locations)
    @foreach($locations as $location)
        <a target="_BLANK" href="https://www.instagram.com/explore/locations/{{$location['id']}}">📍{{$location['name']}} </a>
    @endforeach
    @else
        <div class="alert text-muted">
             There's currently no tagged locations from the most recent posts. <a target="_BLANK" href="https://help.instagram.com/488619974671134">Learn more on the Instagram help page</a>.
        </div>
    @endif

    <h2 class="mt-5 mb-0">Recently mentioned accounts</h2>
    @if($users)
    @foreach($users as $user)
        <a target="_BLANK" href="https://instagram.com/{{$user}}">{{"@".$user}}</a>
    @endforeach
    @else
        <div class="alert text-muted">
             There's currently no other accounts tagged in the most recent posts. <a target="_BLANK" href="https://help.instagram.com/627963287377328">Learn more on the Instagram help page</a>.
        </div>
    @endif

    <h2 class="mt-5 mb-0">Recent posts</h2>
    @if($data->medias)
    @foreach($data->medias as $media)
            <a class="action-section card mb-5 mt-5 round-all-round action-section-hover" target="_BLANK" href="{{$media->link}}">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="{{$media->displaySrc}}" class="card-img" style="object-fit: scale-down;" alt="M Media Marketing Bot">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{\Carbon\Carbon::parse($media->date->date)->diffForHumans()}}<span>{{ $media->location  ? " · ".$media->location->name : null }}</span></h5>
                    <p class="card-text">{{$media->caption}}</p>
                    <p class="card-text">
                        <small class="text-muted"><span>{{ number_format($media->likes) }} likes</span> · {{number_format($media->comments)}} comments</small>
                    </p>
                  </div>
                </div>
              </div>
            </a>
    @endforeach
    @else
        <div class="alert text-muted">
             There's no recent posts to show. <a target="_BLANK" href="https://help.instagram.com/488619974671134">Learn how to post on the Instagram help page</a>.
        </div>
    @endif
@endsection
