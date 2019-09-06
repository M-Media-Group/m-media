@extends('layouts.clean')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>{{str_replace (["_", "-"], " ", $bot->alias)}}</h1>
        <h2>Marketing Automation Bot</h2>
    </div>
@endsection

@section('content')
    <div class="alert alert-info text-muted">
         Data relating to your bot is sensitive, so make sure to keep it secret.
    </div>
    <h2 class="mt-5 mb-0">Bot data</h2>
<div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $bot->id }}</td>
                </tr>
                <tr>
                    <th>Alias</th>
                    <td>{{ $bot->alias }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $bot->address }}</td>
                </tr>
                <tr>
                    <th>Last IP</th>
                    <td>{{ $bot->last_ip }}</td>
                </tr>
                <tr>
                    <th>Last internal IP</th>
                    <td>{{ $bot->last_internal_ip }}</td>
                </tr>
                <tr>
                    <th>Service title</th>
                    <td>{{ $bot->service_title }}</td>
                </tr>
                <tr>
                    <th>Georegion</th>
                    <td>{{ $bot->georegion }}</td>
                </tr>
                <tr>
                    <th>Active</th>
                    <td class="text-{{ $bot->is_active  ? 'success' : 'primary' }}">{{ $bot->is_active  ? 'Online' : 'Offline' }}</td>
                </tr>
                <tr>
                    <th>Serviceable</th>
                    <td class="text-{{ $bot->is_servicable  ? 'success' : 'primary' }}">{{ $bot->is_servicable  ? 'Yes' : 'Not serviceable' }} </td>
                </tr>
                <tr>
                    <th>Last contact</th>
                    <td class="text-{{ now()->diffInDays( $bot->last_contact_at ) > 6  ? 'primary' : null }}">{{ $bot->last_contact_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="mb-5"><a href="/automation-bot">Learn more about the Marketing Automation Bot</a></p>
        @if (Auth::user()->can('connect', App\Bot::class))
            @if($bot->is_active == 1)
                <a class="button button-primary" href="/bots/{{$bot->id}}/connect">
                    {{ __('Connect') }}
                </a>
            @elseif($bot->user)
            <a class="button button-primary" href="mailto:{{$bot->user->email}}?subject=You'll Need to Restart Your Bot&body=Hello! It looks like your bot is currently not connected to our servers. Please disconnect the power from your bot, wait 10 seconds, and reconnect the power. Then, kindly reply to this email when you have done so. You can check your bots status online, on https://mmediagroup.fr/bots/{{$bot->id}}. Thanks!">
                {{ __('Contact customer') }}
            </a>
            @endif
        @else
            <a class="button button-primary" href="mailto:m@mmediagroup.fr">
                {{ __('Get help') }}
            </a>
        @endif
@endsection
