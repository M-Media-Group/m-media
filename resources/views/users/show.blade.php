@extends('layouts.clean')

@section('title', $user->name )

@section('above_container')
    <div class="header-section u-bg-primary">
        <h1> Hi 👋 {{ $user->name }}!</h1>
        <p>{{ $user->name }} {{ $user->surname }}</p>
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
    <a href="#files">files</a> |
    <a href="#emails">email accounts</a> |
    <a href="#phones">phone numbers</a> |
    <a href="#instagram">Instagram profiles</a> |
    <a href="#bots">bots</a>

@component('components.customContactCard', ['title' => $user->name." ". $user->surname, 'id' => 'data', 'buttons' => [['type' => 'primary', 'link' => '/users/'.$user->id."/billing", 'text' => __('Go to billing')], ['link' => '/users/'.$user->id.'/edit', 'text' => __('Edit account settings')]]])
	    Welcome back {{$user->name}}!<br/><br/>Quickly access important things relating to your {{config('app.name')}} account here or keep scrolling for other important stuff.
	@endcomponent


@if($user->websites_count > 0)
@component('components.customContactCard', ['title' => $user->websites_count." ".str_plural("website", $user->websites_count), 'id' => 'websites', 'buttons' => [['type' => 'primary', 'link' => '/domains/check-availability', 'text' => __('Register a new domain')]]])
	    Easily share and manage websites related to your business on {{config('app.name')}}.
	    	@if($user->websites && count($user->websites) > 0)
	<div class="table-responsive">
		<table class="table mb-0">
				<thead>
					<tr>
					   <th>Website domain</th>
					</tr>
				</thead>
				<tbody>
			@foreach ($user->websites as $website)
				<tr>
					<td><a href="/tools/website-debugger/{{ $website->host }}">{{ $website->host }}</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@endif
	@endcomponent
@else
	@component('components.customContactCard', ['title' => 'No websites', 'id' => 'websites', 'buttons' => [['type' => 'primary', 'link' => '/domains/check-availability', 'text' => __('Register a new domain')]]])
	    You have no websites on {{config('app.name')}} associated with you or your business.
	@endcomponent
@endif

@if($user->files_count > 0)
@component('components.customContactCard', ['title' => $user->files_count." ".str_plural("file", $user->files_count), 'id' => 'files', 'buttons' => [['type' => 'primary', 'link' => '/files?user='.$user->id, 'text' => __('All your files')], ['link' => '/files/create', 'text' => __('Upload a file')]]])
	    Easily share and manage files related to your business on {{config('app.name')}}.
	@endcomponent
@else
	@component('components.customContactCard', ['title' => 'No files', 'id' => 'files', 'buttons' => [['type' => 'primary', 'link' => '/files/create', 'text' => 'Upload your first file']]])
	    You have no files on {{config('app.name')}} associated with you and your business.
	@endcomponent
@endif

@if($user->emails_count > 0)
@component('components.customContactCard', ['title' => $user->emails_count.' email ' .str_plural("account", $user->emails_count), 'id' => 'emails', 'buttons' => [['type' => 'primary', 'link' => '/emails?user='.$user->id, 'text' => __('Your email accounts')]]])
	    Manage email accounts associated with you and your business on {{config('app.name')}}.
	@endcomponent
@else
@component('components.customContactCard', ['title' => 'No email accounts', 'id' => 'emails', 'image' => '/images/emails.svg'])
    You have no email accounts on {{config('app.name')}} associated with you.
@endcomponent
@endif

@if($user->phones_count > 0)
@component('components.customContactCard', ['title' => $user->phones_count.' phone ' .str_plural("number", $user->phones_count), 'id' => 'phones', 'buttons' => [['type' => 'primary', 'link' => '/phones?user='.$user->id, 'text' => __('Your phone numbers')]]])
	    Manage phone numbers associated with you and your business on {{config('app.name')}}.
	@endcomponent
@else
@component('components.customContactCard', ['title' => 'No phone accounts', 'id' => 'phones'])
    You have no phone numbers on {{config('app.name')}} associated with you.
@endcomponent
@endif

@if($user->instagram_accounts_count > 0)
<div class="row m-0 pt-5 pb-5 ">
	<div class="action-section card round-all-round text-center" data-aos="fade" id="instagram">
	      <div class="card-body">
	        <h2 class="card-title">{{$user->instagram_accounts_count}} Instagram {{str_plural("account", $user->instagram_accounts_count)}}</h2>
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
@component('components.customContactCard', ['title' => 'No Instagram accounts', 'id' => 'instagram', 'image' => '/images/polaroid.svg'])
    You have no Instagram accounts on {{config('app.name')}} associated with you and your business.
@endcomponent
@endif

@if($user->bots_count > 0)
@component('components.customContactCard', ['title' => $user->bots_count.' ' .str_plural("bot", $user->bots_count), 'id' => 'bots', 'buttons' => [['type' => 'primary', 'link' => '/my-bots', 'text' => __('Your bots')]]])
	    Manage physical marketing automation bots associated with your business on {{config('app.name')}}.
	@endcomponent
@else
@component('components.customContactCard', ['title' => 'No bots', 'id' => 'bots', 'image' => '/images/box.png'])
    Order a new Marketing Automation Bot from {{Config('app.name')}} loaded with custom-coded automations and scripts to make your business marketing life easier, faster, and cheaper.
@endcomponent
@endif

@endsection
