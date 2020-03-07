@extends('layouts.clean')

@section('title', $user->name )

@section('above_container')
    <div class="header-section u-bg-primary">
        <h1>{{ $user->name }} {{ $user->surname }}</h1>
        <p>{{config('app.name')}} Customer</p>
    </div>
@endsection

@section('content')

    @if(!$user->email_verified_at)
	    <div class="alert alert-danger text-muted">
	         Please verify your email address for full access to your account.
	         @if(Auth::id() == $user->id)
	         	If you did not receive the email, <a href="/email/resend">click here to request another</a>.
	         @endif
	    </div>
    @endif

    @if(!$user->primaryPhone)
	    <div class="alert alert-danger text-muted">
	         Please <a href="/contact">contact us</a> to add your phone number and get full access to your {{config('app.name')}} services.
	    </div>
    @endif

    Jump to:
    <a href="#data">data</a> |
    <a href="#websites">websites</a> |
    <a href="#instagram">Instagram profiles</a> |
    <a href="#emails">email accounts</a> |
    <a href="#files">files</a>

<div class="row m-0 pt-5 pb-5">
	<h2 class="mt-5 mb-0" id="data">Customer data</h2>
	<div class="table-responsive table-hover mb-3">
	    <table class="table mb-0">
	        <tbody>
	            <tr>
	                <th>Email</th>
	                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a> <small>({{ $user->email_verified_at ? 'Verified '.$user->email_verified_at->diffForHumans() : "Email not verified" }})</small></td>
	            </tr>
	            @if($user->primaryPhone)
		            <tr>
		                <th>Phone</th>
		                <td><a href="tel:{{ $user->primaryPhone->e164 }}">{{ $user->primaryPhone->number }}</a></td>
		            </tr>
	            @endif
	            <tr>
	                <th>Last seen</th>
	                <td>{{ $user->seen_at->diffForHumans() }}</td>
	            </tr>
	            <tr>
	                <th>ID</th>
	                <td>{{ $user->id }}</td>
	            </tr>
	        </tbody>
	    </table>
	</div>
	<div>
	    @can('update', $user)
	        <a class="button button-primary" href="/users/{{$user->id}}/edit">
	            {{ __('Edit account settings') }}
	        </a>
	    @endcan
	    @can('show', $user)
	        <a class="button" href="/users/{{$user->id}}/billing">
	            {{ __('Go to billing') }}
	        </a>
	    @endcan
	</div>
</div>

<div class="row m-0 pt-5 pb-5 ">
	<h2 class="mt-5 mb-0" id="websites">Websites</h2>
	@if($user->websites && count($user->websites) > 0)
	<div class="table-responsive">
		<table class="table mb-0">
				<thead>
					<tr>
					   <th>ID</th>
					   <th>Username</th>
					</tr>
				</thead>
				<tbody>
			@foreach ($user->websites as $website)
				<tr>
					<td>{{ $website->id }}</td>
					<td><a href="/tools/website-debugger/{{ $website->host }}">{{ $website->host }}</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no websites associated with your account.
		</div>
	@endif
    <a class="button button-primary mt-3" href="/domains/check-availability">
            {{ __('Register a new domain') }}
    </a>
</div>

@if($user->instagram_accounts_count > 0)
<div class="row m-0 pt-5 pb-5 ">
	<div class="action-section card round-all-round text-center" data-aos="fade" id="instagram">
	      <div class="card-body">
	        <h2 class="card-title">{{$user->instagram_accounts_count}} Instagram {{str_plural("accounts", $user->instagram_accounts_count)}}</h2>
	        <p class="card-text">Manage Instagram accounts on {{config('app.name')}} associated with you and your business.</p>
	        	<div class="card-footer">
	<a class="button button-primary" href="/instagram-accounts?user={{$user->id}}">
        {{ __('Your Instagram accounts') }}
    </a>
	</div>
	      </div>
	</div>
</div>
@else
@component('components.customContactCard', ['title' => 'No Instagram accounts', 'id' => 'instagram'])
    You have no Instagram accounts on {{config('app.name')}} associated with you and your business.
@endcomponent
@endif

@if($user->emails_count > 0)
<div class="row m-0 pt-5 pb-5 ">
	<div class="action-section card round-all-round text-center" data-aos="fade" id="emails">
	      <div class="card-body">
	        <h2 class="card-title">{{$user->emails_count}} email {{str_plural("accounts", $user->emails_count)}}</h2>
	        <p class="card-text">Manage email accounts associated with you and your business on {{config('app.name')}}.</p>
	        	<div class="card-footer">
	<a class="button button-primary" href="/emails?user={{$user->id}}">
        {{ __('Your email accounts') }}
    </a>
	</div>
	      </div>
	</div>
</div>
@else
@component('components.customContactCard', ['title' => 'No email accounts', 'id' => 'emails'])
    You have no email accounts on {{config('app.name')}} associated with you.
@endcomponent
@endif

@if($user->files_count > 0)
<div class="row m-0 pt-5 pb-5 ">
	<div class="action-section card round-all-round text-center" data-aos="fade" id="files">
{{-- 	      <img src="{{$user->files->where('extension', 'png')->last()->url}}" class="card-img-top" style="max-height: 200px;object-fit: scale-down;" alt="{{Config('app.name')}} Marketing Bot">
 --}}
	      <div class="card-body">
	        <h2 class="card-title">{{$user->files_count}} {{str_plural("files", $user->files_count)}}</h2>
	        <p class="card-text">Easily share and manage files related to your business on {{config('app.name')}}.</p>
	        	<div class="card-footer">
	<a class="button button-primary" href="/files?user={{$user->id}}">
        {{ __('All your files') }}
    </a>
	@can('create', App\File::class)
        <a class="button button" href="/files/create">
            {{ __('Upload a file') }}
        </a>
    @endcan
	</div>
	      </div>
	</div>
</div>
@else
	@component('components.customContactCard', ['title' => 'No files', 'id' => 'files', 'buttons' => [['type' => 'primary', 'link' => '/files/create', 'text' => 'Upload your first file']]])
	    You have no files on {{config('app.name')}} associated with you and your business.
	@endcomponent
@endif

@endsection
