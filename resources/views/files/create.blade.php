@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Upload a file")
@section('meta_description', "This ".config('app.name')." tool will let people upload files." )

@section('above_container')
<div class="header-section u-bg-primary">
    <h1>{{ __('Upload a file') }}</h1>
    <p>Share files with {{config('app.name')}}</p>
</div>
<div>
    <div class="action-section container">
    	@if (session('success'))
			<div class="alert alert-success">
			    {{session('success')}}
			</div>
		@endif
        <div class="mt-5">
            <file-upload-component url="/api/files" />
        </div>
    </div>
</div>

@endsection
