@extends('layouts.clean')

@section('title', $user->name )

@section('above_container')
    <div class="header-section bg-secondary">
        <h1> Hi 👋 {{ $user->name }}!</h1>
        <p>{{ $user->name }} {{ $user->surname }}</p>
    </div>
@endsection

@section('content')

<div style="margin-top:-10rem;" class="pb-5">
	@if($user->is_locked)
	    <div class="alert alert-info text-muted">
	         This <a href="https://blog.mmediagroup.fr/post/about-locked-accounts/" target="_BLANK">account is locked</a>, preventing you from adding, editing, or deleting resources.
	    </div>
    @endif

    @if(!$user->email_verified_at)
	    <div class="alert alert-info text-muted">
	         Please verify your email address for full access to your account.
	         @if(Auth::id() == $user->id)
	         	If you did not receive the email, <a href="/email/resend">click here to request another</a>.
	         @endif
	    </div>
    @endif

    @if(!$user->primaryPhone)
	    <div class="alert alert-info text-muted">
	         Please <a href="/contact">contact us</a> to add your phone number and get full access to your {{config('app.name')}} services.
	    </div>
    @endif

@component('components.customContactCard', ['title' => $user->name." ". $user->surname, 'id' => 'data'])
	    Welcome back {{$user->name}}!<br/><br/>Quickly access important things relating to your {{config('app.name')}} account here.
	@endcomponent

<div class="d-none">
@if($user->websites_count > 0)
@component('components.customContactCard', ['image' => '/images/icons/website.svg', 'title' => $user->websites_count." ".str_plural("website", $user->websites_count), 'id' => 'websites', 'buttons' => [['type' => 'primary', 'link' => '/domains/check-availability', 'text' => __('Register a new domain')]]])
	    See and manage websites related to your business on {{config('app.name')}}.
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
					{{-- <td><a href="/tools/website-debugger/{{ $website->host }}">{{ $website->host }}</a></td> --}}

					<td><a href="https://{{ $website->host }}">{{ $website->host }}</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@endif
	@endcomponent
@elseif (!$user->is_locked)
	@component('components.customContactCard', ['image' => '/images/icons/website.svg', 'title' => 'No websites', 'id' => 'websites', 'buttons' => [['type' => 'primary', 'link' => '/domains/check-availability', 'text' => __('Register a new domain')]]])
	    You have no websites on {{config('app.name')}} associated with you or your business.
	@endcomponent
@endif
</div>

@if($user->files_count > 0)
@component('components.customSmallCard', ['image' => '/images/icons/files-empty.svg', 'title' => $user->files_count." ".str_plural("file", $user->files_count), 'id' => 'files', 'link' => '/files?user='.$user->id])
	    Easily share and manage files related to your business on {{config('app.name')}}.
	@endcomponent
@elseif (!$user->is_locked)
	@component('components.customContactCard', ['image' => '/images/icons/files-empty.svg', 'title' => 'No files', 'id' => 'files', 'buttons' => [['type' => 'primary', 'link' => '/files/create', 'text' => 'Upload your first file']]])
	    You have no files on {{config('app.name')}} associated with you and your business.
	@endcomponent
@endif

@if($user->ad_accounts_count > 0)
@component('components.customSmallCard', ['image' => '/images/icons/google-ad-outline.svg', 'title' => $user->ad_accounts_count." ".str_plural("ad account", $user->ad_accounts_count), 'id' => 'files', 'link' => '/ad-accounts?user='.$user->id])
	    Easily see data related to your ad accounts linked to your {{config('app.name')}} account.
	@endcomponent
@elseif (!$user->is_locked)
	@component('components.customContactCard', ['image' => '/images/icons/google-ad-outline.svg', 'title' => 'No ad accounts', 'id' => 'files', 'buttons' => [['type' => 'primary', 'link' => '/contact', 'text' => 'Link an advertising platform'], ['type' => '', 'link' => '/digital-ads', 'text' => 'Learn more']]])
	    You have no ad accounts on {{config('app.name')}} associated with you and your business.
	@endcomponent
@endif

@if($user->emails_count > 0)
@component('components.customSmallCard', ['image' => '/images/icons/email-multiple-outline.svg', 'title' => $user->emails_count.' email ' .str_plural("account", $user->emails_count), 'id' => 'emails', 'link' => '/emails?user='.$user->id, ])
	    Manage email accounts associated with you and your business on {{config('app.name')}}.
	@endcomponent
@elseif (!$user->is_locked)
@component('components.customContactCard', ['image' => '/images/icons/email-multiple-outline.svg', 'title' => 'No email accounts', 'id' => 'emails', 'image' => '/images/emails.svg'])
    You have no email accounts on {{config('app.name')}} associated with you.
@endcomponent
@endif

@if($user->phones_count > 0)
@component('components.customSmallCard', ['image' => '/images/icons/phone.svg', 'title' => $user->phones_count.' phone ' .str_plural("number", $user->phones_count), 'id' => 'phones', 'link' => '/phones?user='.$user->id])
	    Manage phone numbers associated with you and your business on {{config('app.name')}}.
	@endcomponent
@elseif (!$user->is_locked)
@component('components.customContactCard', ['image' => '/images/icons/phone.svg', 'title' => 'No phone accounts', 'id' => 'phones'])
    You have no phone numbers on {{config('app.name')}} associated with you.
@endcomponent
@endif

@if($user->instagram_accounts_count > 0)
@component('components.customSmallCard', ['image' => '/images/icons/instagram.svg', 'title' => $user->instagram_accounts_count.' Instagram ' .str_plural("account", $user->instagram_accounts_count), 'id' => 'instagram', 'link' => '/instagram-accounts?user='.$user->id])
	    Manage Instagram accounts on {{config('app.name')}} associated with you and your business.
	@endcomponent
@elseif (!$user->is_locked)
@component('components.customContactCard', ['title' => 'No Instagram accounts', 'id' => 'instagram', 'image' => '/images/icons/instagram.svg'])
    You have no Instagram accounts on {{config('app.name')}} associated with you and your business.
@endcomponent
@endif

@if($user->bots_count > 0)
@component('components.customSmallCard', ['image' => '/images/pi-top.png', 'title' => $user->bots_count.' ' .str_plural("bot", $user->bots_count), 'id' => 'bots', 'link' => '/my-bots'])
	    Manage physical marketing automation bots associated with your business on {{config('app.name')}}.
	@endcomponent
@endif

@if($user->internships_count > 0)
@component('components.customSmallCard', ['image' => '/images/internship/intern.svg', 'title' => $user->internships_count.' ' .str_plural("internship", $user->internships_count), 'id' => 'internships', 'link' => '/internships?user='.$user->id])
	    See your internships at {{config('app.name')}}.
	@endcomponent
@endif

<h2 class="mt-5 mb-0" id="subscriptions">More rescources</h2>
@component('components.customSmallCard', ['image' => '/images/icons/euro.svg', 'title' => 'Billing and payments', 'id' => 'payment', 'link' => '/users/'.$user->id."/billing" ])
	@endcomponent
@can('update', $user)
	@component('components.customSmallCard', ['image' => '/images/icons/settings-solid.svg', 'title' => 'Account settings', 'id' => 'settings', 'link' => '/users/'.$user->id.'/edit' ])
	@endcomponent
@endcan
@component('components.customSmallCard', ['image' => '/images/icons/key-security.svg', 'title' => 'Login history', 'id' => 'settings', 'link' => '/authentication-events?user='.$user->id ])
	@endcomponent

    <h2 class="mt-5 mb-0">From our Help Center</h2>
    <block-post-component category="35"></block-post-component>

</div>
@endsection
