@extends('layouts.clean')

@section('title', 'Create a bot')

@section('content')
	<h1>Edit a bot</h1>
	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<div class="mb-0">
        <div class="form-group row">
            <label for="dynamic_checkbox" class="four columns col-form-label u-right-text-on-desktop">Is serviceable</label>
            <div class="six columns">
				<checkbox-toggle-component checked="{{$bot->is_servicable ? true : false}}" title="Is serviceable" url="/bots/{{$bot->id}}" column_title="is_servicable"></checkbox-toggle-component>
            </div>
        </div>
    </div>

@endsection
