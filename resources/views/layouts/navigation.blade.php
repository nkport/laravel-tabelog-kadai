<header class="header">

    <nav class="nav">

        <a href="{{ url('/') }}">
            <h1 class="h1-title "><img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }}"></h1>
        </a>

        <div id="spMenuBtn2" class="headerNavBtn">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul class="nav-ul">
            @guest
                <li class="nav-li border-right mx-1">
                    <p class="lead-text">名古屋のB級グルメ専門予約＆レビューサイト</p>
                </li>
                @if (Route::has('register'))
                    <li class="nav-li">
                        <a href="{{ route('register') }}" class="guest-design">
                            <strong class="kadomaru-btn-red-line">{{ trans('messages.common_register') }}</strong>
                        </a>
                    </li>
                @endif
                @if (Route::has('login'))
                    <li class="nav-li">
                        <a href="{{ route('login') }}" class="guest-design">
                            <strong class="kadomaru-btn-red-bg">{{ trans('messages.common_login') }}</strong>
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-li">
                    <x-responsive-nav-link :href="route('profile.index')">
                        <strong class="txt-red">{{ Auth::user()->name }}</strong>
                        <span class="mx-1">{{ trans('messages.nav_compellation') }}</span>
                    </x-responsive-nav-link>
                </li>
            @endguest
            @if (auth()->check() && auth()->user()->role === 'premium')
                <li class="nav-li border-left pl-3">
                    <a class="nav-link auth-design" href="{{ route('profile.favorite') }}">
                        <div class="fontawesome-adjust">
                            <span class="kadomaru-btn-red-line"><i class="far fa-heart fa-fw"></i></span>
                            <strong>お気に入り</strong>
                        </div>
                    </a>
                </li>
                <li class="nav-li">
                    <a class="nav-link auth-design" href="{{ route('profile.reservation') }}">
                        <span class="kadomaru-btn-red-bg"><i class="fa-regular fa-calendar-days fa-fw"></i></span>
                        <strong>予約店舗</strong>
                    </a>
                </li>
            @endif
        </ul>

    </nav>

</header>
