<nav class="flex" style="position: fixed; left:2rem; right:2rem; top:2rem;z-index: 999;">
    <div class=" flex flex-center dropdown" style="width:initial;">
        <a href="/" class="logo-container"><img src="/images/logo.png" height="35" alt="M Media logo"></a>
        <div class="dropdown-content" style="max-height: 80vh;overflow-y: scroll;">
            <a href="/">Home</a>
            <a href="/automation-bot">Marketing Automation Bot</a>
            <a href="/instagram">Instagram Solutions</a>
{{--              <a href="/web-development">Web Development</a>
           <a href="/print-media">Print Media</a>
 --}}            <hr class="mb-0 mt-0">
                @guest
                    <a href="/login">Login</a>
                @else
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
                    @can('manage roles')
                        <a href="/roles">
                            {{ __('Manage roles') }}
                        </a>
                        <a href="/roles/create">
                            {{ __('Create roles') }}
                        </a>
                    @endcan
                    <a href="/my-bots">
                            {{ __('My bots') }}
                    </a>
                    <a href="/users/{{ Auth::user()->id }}/edit">
                            {{ __('Account settings') }}
                    </a>
                    <a href="/users/{{ Auth::user()->id }}/invoices">
                            {{ __('Invoices') }}
                    </a>
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
