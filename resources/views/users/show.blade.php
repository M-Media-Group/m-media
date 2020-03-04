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
    <a href="#instagram">Instagram profiles</a> |
    <a href="#websites">websites</a> |
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

<div class="row m-0 pt-5 pb-5 ">
    <h2 class="mt-5 mb-0" id="instagram">Instagram profiles</h2>
	@if($user->instagramAccounts && count($user->instagramAccounts) > 0)
	<div class="table-responsive">
		<table class="table mb-0">
				<thead>
					<tr>
					   <th>ID</th>
					   <th>Username</th>
					</tr>
				</thead>
				<tbody>
			@foreach ($user->instagramAccounts as $account)
				<tr>
					<td>{{ $account->id }}</td>
					<td><a href="/tools/instagram-account-analyzer/{{ $account->username }}">{{ '@'.$account->username }}</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no Instagram profiles associated with your account.
		</div>
	@endif
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

<div class="row m-0 pt-5 pb-5 ">
	<h2 class="mt-5 mb-0" id="emails">Email accounts</h2>
	<div class="table-responsive">
		<table class="table mb-0">
				<thead>
					<tr>
					   <th>ID</th>
					   <th>Email</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td>{{ $user->primaryEmail->id }}</td>
					<td><a href="/emails/{{ $user->primaryEmail->id }}">{{ $user->primaryEmail->email }}</a></td>
				</tr>
			@foreach ($user->emails as $email)
				<tr>
					<td>{{ $email->id }}</td>
					<td><a href="/emails/{{ $email->id }}">{{ $email->email }}</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="row m-0 pt-5 pb-5 ">
	<h2 class="mt-5 mb-0" id="files">Files</h2>
	@if($user->files && count($user->files) > 0)
	<div class="table-responsive">
		<table class="table mb-0">
				<thead>
					<tr>
					   <th>Preview</th>
					   <th>Name</th>
					   <th>Public</th>
					</tr>
				</thead>
				<tbody>
			@foreach ($user->files as $file)
				<tr>
                    <td><img src="{{ $file->url }}" class="rounded img-thumbnail" style="max-height: 30px;" alt="{{ $file->name }}"></td>
					<td><a href="/files/{{ $file->id }}">{{ $file->name }}</a></td>
					<td class="text-{{ $file->is_public  ? 'primary' : 'muted' }}">{{ $file->is_public  ? 'Yes' : 'No' }} </td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no files associated with your account. You can upload and share up to 1gb files with {{config('app.name')}}.
		</div>
	@endif
	@can('create', App\File::class)
        <a class="button button-primary mt-3" href="/files/create">
            {{ __('Upload a file') }}
        </a>
    @endcan
</div>
@endsection
