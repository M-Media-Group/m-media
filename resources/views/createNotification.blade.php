@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Create notification")
@section('meta_description', "This ".config('app.name')." tool will let admins notify ".config('app.name')." users." )

@section('above_container')
<div class="header-section u-bg-primary">
    <h1>{{ __('Create a notification') }}</h1>
</div>
<div>
    <div class="action-section container">
        <div class="mt-5">
            <form method="POST" action="/custom-notifications">
                @csrf
                <div class="form-group row">
                    <label for="users" class="col-md-4 col-form-label text-md-right">{{ __('Users') }}</label>

                    <div class="col-md-6">
                        <select multiple="multiple" name="users[]" id="users" class="form-control">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->id}}: {{$user->name ?? $user->email}} {{$user->surname}} <small>{{$user->primaryPhone && strtolower($user->primaryPhone->number_type) == "mobile" ? "(SMS-able)" : null}}</small></option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                    <div class="col-md-6">
                        <input id="title" type="text" autocomplete="off" minlength="1" maxlength="78" placeholder="Title" class="form-control" name="title" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>
                    <div class="col-md-6">
                        <textarea-autosize id="message" autocomplete="off" minlength="1" name="message" placeholder="Message" class="form-control"></textarea-autosize>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="action" class="col-md-4 col-form-label text-md-right">{{ __('Action') }} {{ __('URL') }}</label>
                    <div class="col-md-6">
                        <input id="action" type="text" autocomplete="off" placeholder="/url/to/action" class="form-control" name="action">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="actiontext" class="col-md-4 col-form-label text-md-right">{{ __('Action') }} {{ __('text') }}</label>
                    <div class="col-md-6">
                        <input id="actiontext" type="text" autocomplete="off" placeholder="Action text" class="form-control" name="action_text">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="send_voice" class="col-md-4 col-form-label text-md-right">{{ __('Send as a voice message (phone call)') }}</label>
                    <div class="col-md-6">
                        <input id="send_voice" type="checkbox" autocomplete="off" placeholder="send_voice" class="form-control" name="send_voice">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="send_sms" class="col-md-4 col-form-label text-md-right">{{ __('Send as a text message (Transactional SMS)') }}</label>
                    <div class="col-md-6">
                        <input id="send_sms" type="checkbox" autocomplete="off" placeholder="send_sms" class="form-control" name="send_sms">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sendemail" class="col-md-4 col-form-label text-md-right">{{ __('Send as an email') }}</label>
                    <div class="col-md-6">
                        <input id="sendemail" type="checkbox" autocomplete="off" placeholder="send_email" class="form-control" name="send_email">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="send_database" class="col-md-4 col-form-label text-md-right">{{ __('Send as a website notification') }}</label>
                    <div class="col-md-6">
                        <input id="send_database" type="checkbox" autocomplete="off" checked placeholder="send_database" class="form-control" name="send_database">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
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
