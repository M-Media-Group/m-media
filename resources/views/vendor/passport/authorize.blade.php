@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('above_container')
<div class="header-section u-bg-primary">
    <h1>{{ $client->name }}</strong> is requesting permission to access your {{ config('app.name') }} account.</h1>
</div>
<div class="action-section container" data-aos="fade">
    <div class="mt-5">
          <!-- Scope List -->
                        @if (count($scopes) > 0)
                            <div class="scopes">
                                    <p><strong>This application will be able to:</strong></p>

                                    <ul>
                                        @foreach ($scopes as $scope)
                                            <li>{{ $scope->description }}</li>
                                        @endforeach
                                    </ul>
                            </div>
                        @else
                        <div class="scopes">
                            <p><strong>This application will be able to access all your data and perform operations on your behalf.</strong></p>
                        </div>
                        @endif

                        <div class="buttons">
                            <!-- Authorize Button -->
                            <form method="post" action="{{ route('passport.authorizations.approve') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="button button-secondary">Authorize</button>
                            </form>
                             <!-- Cancel Button -->
                            <form method="post" action="{{ route('passport.authorizations.deny') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button class="button">Cancel</button>
                            </form>
                        </div>
    </div>
</div>
@endsection
