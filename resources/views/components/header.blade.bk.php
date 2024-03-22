<header class="header">
    <nav class="nav">
        @guest
            <a href="{{ url('/') }}">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
            </a>
        @else
            <a href="{{ route('shops.index') }}">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
            </a>
        @endguest
        <ul class="nav-ul">
            @guest
                @if (Route::has('register'))
                    <li class="nav-li border-right mx-1 text-link">
                        <a href="#">{{ trans('messages.nav_about') }}</a>
                    </li>
                    <li class="nav-li">
                        <a href="{{ route('register') }}"><strong
                                class="kadomaru-btn-red-line">{{ trans('messages.common_register') }}</strong></a>
                    </li>
                @endif
                @if (Route::has('login'))
                    <li class="nav-li">
                        <a href="{{ route('login') }}"><strong
                                class="kadomaru-btn-red-bg">{{ trans('messages.common_login') }}</strong></a>
                    </li>
                @endif
            @else
                <li class="nav-li">
                    <a href="{{ route('profile.index') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                        <strong class="txt-red">{{ Auth::user()->name }}</strong>
                        <span class="mx-1">{{ trans('messages.nav_compellation') }}</span>
                    </a>
                </li>
            @endguest
        </ul>
    </nav>
</header>
