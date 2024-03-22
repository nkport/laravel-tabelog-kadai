<x-app-layout>

    @if (session('flash_message'))
        <div class="pt-80 -mb-4">
            <div class="alert alert-success txt-center">
                {{ session('flash_message') }}
            </div>
        </div>
    @endif

    <div class="wrapper">

        <div class="profile-container">

            @if (auth()->check() && auth()->user()->role === 'premium')
                <div class="profile-contents">
                    <div class="profile-contents-item">
                        <a href="{{ route('profile.reservation') }}">
                            <i class="far fa-calendar txt-red"></i>
                            予約したお店
                        </a>
                    </div>
                </div>
                <div class="profile-contents">
                    <div class="profile-contents-item">
                        <a href="{{ route('profile.favorite') }}">
                            <i class="fa-solid fa-heart txt-red"></i>
                            お気に入り一覧
                        </a>
                    </div>
                </div>
            @endif
            <div class="profile-contents">
                <div class="profile-contents-item">
                    <a href="{{ route('profile.edit') }}">
                        <i class="fa-regular fa-user txt-red"></i>
                        {{ trans('messages.profile_edit_title') }}
                    </a>
                </div>
            </div>
            @if (auth()->check() && auth()->user()->role === 'general' && auth()->user()->hasVerifiedEmail())
                <div class="profile-contents">
                    <div class="profile-contents-item">
                        <a href="{{ route('subscription.create') }}">
                            <i class="fa-regular fa-credit-card txt-red"></i>
                            有料会員登録
                        </a>
                    </div>
                </div>
            @endif
            @if (auth()->check() && auth()->user()->role === 'premium')
                <div class="profile-contents">
                    <div class="profile-contents-item">
                        <a href="{{ route('subscription.edit') }}">
                            <i class="fa-regular fa-credit-card txt-red"></i>
                            カード情報の編集
                        </a>
                    </div>
                </div>
                <div class="profile-contents">
                    <div class="profile-contents-item">
                        <a href="{{ route('subscription.cancel') }}">
                            <i class="fa-regular fa-rectangle-xmark txt-red"></i>
                            有料会員を解除
                        </a>
                    </div>
                </div>
            @endif
            <div class="profile-contents">
                <div class="profile-contents-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket txt-red"></i>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>

        </div>

        <div class="mt-5 txt-center">
            <a href="{{ route('shops') }}" class="kadomaru-btn-orange-bg"><i
                    class="fa-solid fa-caret-left mr-1"></i>お店一覧に戻る</a>
        </div>

    </div>

    </div>

</x-app-layout>
