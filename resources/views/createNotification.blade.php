@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Create notification")
@section('meta_description', "This ".config('app.name')." tool will let admins notify ".config('app.name')." users." )

@section('above_container')
<div class="header-section bg-secondary">
    <h1>{{ __('Create a notification') }}</h1>
</div>
<div>
    <div class="action-section card">
        <div class="mt-5">
            <form method="POST" action="/custom-notifications">
                @csrf
                <div class="form-group row">
                    <label for="users" class="four columns col-form-label u-right-text-on-desktop">{{ __('Users') }}</label>

                    <div class="six columns">
                        <select multiple="multiple" name="users[]" id="users" class="form-control">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->id}}: {{$user->name ?? $user->email}} {{$user->surname}} <small>{{$user->primaryPhone && strtolower($user->primaryPhone->number_type) == "mobile" ? null : "(no SMS)" }}</small></option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="four columns col-form-label u-right-text-on-desktop">{{ __('Title') }}</label>
                    <div class="six columns">
                        <input id="title" type="text" autocomplete="off" minlength="1" maxlength="78" placeholder="Title" class="form-control" name="title" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="message" class="four columns col-form-label u-right-text-on-desktop">{{ __('Message') }}</label>
                    <div class="six columns">
                        <textarea-autosize id="message" autocomplete="off" minlength="1" name="message" placeholder="Message" class="form-control"></textarea-autosize>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="action" class="four columns col-form-label u-right-text-on-desktop">{{ __('Action') }} {{ __('URL') }}</label>
                    <div class="six columns">
                        <input id="action" type="text" autocomplete="off" placeholder="/url/to/action" class="form-control" name="action">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="actiontext" class="four columns col-form-label u-right-text-on-desktop">{{ __('Action') }} {{ __('text') }}</label>
                    <div class="six columns">
                        <input id="actiontext" type="text" autocomplete="off" placeholder="Action text" class="form-control" name="action_text">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="send_voice" class="four columns col-form-label u-right-text-on-desktop">{{ __('Send as a voice message (phone call)') }}</label>
                    <div class="six columns">
                        <input id="send_voice" type="checkbox" autocomplete="off" placeholder="send_voice" class="form-control" name="send_voice">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="send_sms" class="four columns col-form-label u-right-text-on-desktop">{{ __('Send as a text message (Transactional SMS)') }}</label>
                    <div class="six columns">
                        <input id="send_sms" type="checkbox" autocomplete="off" placeholder="send_sms" class="form-control" name="send_sms">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sendemail" class="four columns col-form-label u-right-text-on-desktop">{{ __('Send as an email') }}</label>
                    <div class="six columns">
                        <input id="sendemail" type="checkbox" autocomplete="off" placeholder="send_email" class="form-control" name="send_email">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="send_database" class="four columns col-form-label u-right-text-on-desktop">{{ __('Send as a website notification') }}</label>
                    <div class="six columns">
                        <input id="send_database" type="checkbox" autocomplete="off" checked placeholder="send_database" class="form-control" name="send_database">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="eight columns offset-by-four">
                        <button type="submit" class="button button-primary">
                            {{ __('Send') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
