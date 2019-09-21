@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Create notification")
@section('meta_description', "This M Media tool will let admins notify M Media users." )

@section('above_container')
<div class="header-section" style="background:#246EBA;">
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
                            <option value="{{$user->id}}">{{$user->name}} {{$user->surname}}</option>
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
                        <textarea id="message" autocomplete="off" minlength="1" name="message" placeholder="Message" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="action" class="col-md-4 col-form-label text-md-right">{{ __('Action') }} {{ __('URL') }}</label>
                    <div class="col-md-6">
                        <input id="action" type="text" autocomplete="off" placeholder="Action" class="form-control" name="action">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="actiontext" class="col-md-4 col-form-label text-md-right">{{ __('Action') }} {{ __('text') }}</label>
                    <div class="col-md-6">
                        <input id="actiontext" type="text" autocomplete="off" placeholder="Action text" class="form-control" name="action_text">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sendemail" class="col-md-4 col-form-label text-md-right">{{ __('Send as email') }}</label>
                    <div class="col-md-6">
                        <input id="sendemail" type="checkbox" autocomplete="off" placeholder="send_email" class="form-control" name="send_email">
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
