@extends('layouts.clean')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>{{str_replace (["_", "-"], " ", $bot->alias)}}</h1>
        <h2>Marketing Automation Bot</h2>
    </div>
@endsection

@section('content')
    @if(!$bot->is_active && $bot->is_servicable)
    <div class="alert alert-danger text-muted">
         <p>This bot lost contact to our servers {{ $bot->last_contact_at->diffForHumans() }}. Please unplug the power from the bot, wait 10 seconds, and reconnect the power.</p>
         It may take up to two hours for the status to show 'Online' on our website.
    </div>
    @endif
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
                    <th>Status</th>
                    <td class="text-{{ $bot->is_active  ? 'success' : 'primary' }}">{{ $bot->is_active  ? 'Online' : 'Offline' }}</td>
                </tr>
                <tr>
                    <th>Serviceable</th>
                    <td class="text-{{ $bot->is_servicable  ? 'muted' : 'primary' }}">{{ $bot->is_servicable  ? 'Yes' : 'Not serviceable' }} </td>
                </tr>
                @if($bot->user)
                    <tr>
                        <th>Owned by</th>
                        <td><a href="/users/{{ $bot->user->id }}">{{ $bot->user->name }}</a></td>
                    </tr>
                @endif
                <tr>
                    <th>Last contact</th>
                    <td class="text-{{ now()->diffInDays( $bot->last_contact_at ) > 3  ? 'primary' : 'muted' }}">{{ $bot->last_contact_at->diffForHumans() }}</td>
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
            <a class="button button-primary" href="/bots/{{$bot->id}}/contact-user">
                {{ __('Email customer') }}
            </a>
            @endif
        @else
            <a class="button button-primary" href="mailto:contact@mmediagroup.fr">
                {{ __('Get help') }}
            </a>
        @endif
@endsection
