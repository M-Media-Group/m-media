@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', "Upload a file")
@section('meta_description', "This M Media tool will let people upload files." )

@section('above_container')
<div class="header-section" style="background:#246EBA;">
    <h1>{{ __('Upload a file') }}</h1>
    <h2>Share files with M Media</h2>
</div>
<div>
    <div class="action-section container">
    	@if (session('success'))
			<div class="alert alert-success">
			    {{session('success')}}
			</div>
		@endif
        <div class="mt-5">
        	<form action="/files" enctype="multipart/form-data" method="post">
            	@csrf
                <div class="form-group row">
                    <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>

                    <div class="col-md-6">
	                    <input type="file" name="file" id="file" class="input" required autofocus>
	                    <span class="help-block text-danger">{{$errors->first('file')}}</span>
                	</div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-6">
	                    <input name="title" id="title" class="form-control" type="text" placeholder="Descriptive titles help SEO">
	                    <span class="help-block text-danger">{{$errors->first('title')}}</span>
	                </div>

                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="button button-primary">
                            {{ __('Upload') }}
                        </button>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12 text-muted">
                        Your file is private by default, which means that each URL generated to your file by M Media is valid only for five minutes. If you want your file public with long-lived URLs, <a href="/contact">contact us</a> after uploading.
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
