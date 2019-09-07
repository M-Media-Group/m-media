@extends('layouts.clean')

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

    @if($data->private)
    <p class="mb-0">To help your account reach more people:</p>
    <p>- Make your account public by switching off 'Private Account' in your Instagram settings</p>
    @endif

    @if($data->followers/$data->following <= 3)
    <p class="mb-0">To improve your follower to following ratio:</p>
    <p>- Unfollow more people</p>
    @endif

    @if( ($data->avgPostLikes/$data->followers) * 100 <= 5)
    <p class="mb-0">To improve engagement health:</p>
    <p class="mb-0">- Use higher quality media posts that resonate better with your audience</p>
    <p class="mb-0">- Update the hashtags you use to hashtags that are more relevant to your users</p>
    <p>- Try altering your posting frequency and schedule</p>
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
                    <td>{{ \Carbon\Carbon::parse($data->medias[0]->date->date)->diffForHumans()}}</td>
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
            </tbody>
        </table>
    </div>

    <h2 class="mt-5 mb-0">Recent hashtags</h2>
    @foreach($hashtags as $hashtag)
        #{{$hashtag}}
    @endforeach

    <h2 class="mt-5 mb-0">Recent locations</h2>
    @foreach($locations as $location)
        {{$location['name']}}
    @endforeach
@endsection
