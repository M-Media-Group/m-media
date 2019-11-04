<nav class="flex" style="position: fixed; left:2rem; right:2rem; top:2rem;z-index: 999;">
    <div class=" flex flex-center dropdown" style="width:initial;">
        <a href="#" class="logo-container"><img src="/images/logo.png" height="35" alt="{{config('app.name')}} logo"></a>
        <div class="dropdown-content" style="max-height: 80vh;overflow-y: scroll;">
            <a href="/">Home</a>
            <a href="/web-development">Web Development</a>
            <a href="/instagram">Instagram Solutions</a>
{{--             <a href="/automation-bot">Marketing Automation Bot</a>
 --}}{{--            <a href="/print-media">Print Media</a>
 --}}           <hr class="mb-0 mt-0">
                <a href="/case-studies">Case Studies</a>
                <hr class="mb-0 mt-0">
                @guest
                    <a href="/contact">Contact us</a>
                    <hr class="mb-0 mt-0">
                    <a href="/login">Login</a>
                @else
                 <a href="/users/{{Auth::id()}}">
                            {{ __('Your profile') }}
                    </a>
                    <a href="/notifications">
                            {{ __('Notifications') }}
                            @if(Auth::user()->unreadNotifications->count())
                            <span class="text-primary">({{Auth::user()->unreadNotifications->count()}})</span>
                            @endif
                    </a>
                    <a href="/my-bots">
                            {{ __('Your bots') }}
                    </a>
                    <a href="/users/{{ Auth::id() }}/billing">
                            {{ __('Billing') }}
                    </a>
                    <a href="/users/{{ Auth::id() }}/edit">
                            {{ __('Account settings') }}
                    </a>
{{--                     <hr class="mb-0 mt-0">
                    <a href="/tools/instagram-account-analyzer">
                            {{ __('Instagram account analyzer') }}
                    </a> --}}
  {{--                   <a href="/tools/website-debugger">
                            {{ __('Website debugger') }}
                    </a> --}}
                    <hr class="mb-0 mt-0">
                    @can('index', App\User::class)
                        <a href="/users">
                            {{ __('Users') }}
                        </a>
                    @endcan
                    @can('index', App\Bot::class)
                        <a href="/bots">
                            {{ __('Bots') }}
                        </a>
                    @endcan
                    @can('index', App\InstagramAccount::class)
                        <a href="/instagram-accounts">
                            {{ __('Instagram accounts') }}
                        </a>
                    @endcan
                    @can('index', App\File::class)
                        <a href="/files">
                            {{ __('Files') }}
                        </a>
                    @endcan
                    @can('index', App\Email::class)
                        <a href="/emails">
                            {{ __('Emails') }}
                        </a>
                    @endcan
                    @can('index', App\EmailLog::class)
                        <a href="/email-logs">
                            {{ __('Email logs') }}
                        </a>
                    @endcan
                    @can('index', App\PhoneLog::class)
                        <a href="/phone-logs">
                            {{ __('Phone logs') }}
                        </a>
                    @endcan
                    {{-- @can('manage roles')
                        <a href="/roles">
                            {{ __('Manage roles') }}
                        </a>
                        <a href="/roles/create">
                            {{ __('Create roles') }}
                        </a>
                    @endcan --}}
                    @can('create custom notifications')
                        <a href="/custom-notifications/create">
                            {{ __('Notify users') }}
                        </a>
                    @endcan
                    <a href="/contact">Contact us</a>
                    <hr class="mb-0 mt-0">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
        </div>
    </div>
</nav>
