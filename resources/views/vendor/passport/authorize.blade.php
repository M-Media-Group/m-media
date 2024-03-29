@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('above_container')
<div class="header-section bg-secondary">
    <h1>{{ $client->name }} is requesting access your {{ config('app.name') }} account.</h1>
</div>
<div class="action-section card" data-aos="fade">
    <div class="mt-5">
          <!-- Scope List -->
        @if (count($scopes) > 0)
            <div class="scopes">
                    <p>{{ $client->name }} will have permission to:</p>

                    <ul>
                        @foreach ($scopes as $scope)
                            <li><strong>{{ $scope->description }}</strong></li>
                        @endforeach
                    </ul>
            </div>
        @else
        <div class="scopes">
            <p><strong>{{ $client->name }} will have permission to access all your {{ config('app.name') }} data and perform operations on your behalf.</strong></p>
        </div>
        @endif

        <div class="buttons">
            <!-- Authorize Button -->
            <form method="post" action="{{ route('passport.authorizations.approve') }}" style="display:inline-block;">
                {{ csrf_field() }}

                <input type="hidden" name="state" value="{{ $request->state }}">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <button type="submit" class="button button-primary">Authorize</button>
            </form>
             <!-- Cancel Button -->
            <form method="post" action="{{ route('passport.authorizations.deny') }}" style="display:inline-block;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <input type="hidden" name="state" value="{{ $request->state }}">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <button class="button">Deny</button>
            </form>
        </div>
        @if($client->user_id)
            @php
                $user = App\User::find($client->user_id);
            @endphp
            <p class="text-muted small">{{ $client->name }} is owned by {{config('app.name')}} customer <strong>{{ $user->name }} {{$user->surname[0]}}</strong>. Only allow applications from sources you trust to access your data.</p>
        @else
            <p class="text-muted small">Only allow applications from sources you trust to access your data.</p>
        @endif
    </div>
</div>
@endsection
