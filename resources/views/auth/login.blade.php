<x-guest-layout>

    <h2 class="h2-title">{{ __('messages.common_login') }}</h2>

    <!-- Session Status -->
    <x-auth-session-status class="txt-orange txt-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="w-100" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <label for="remember_me" class="inline-flex items-center">
                <input type="checkbox" id="remember_me" name="remember" checked="checked">
                <span for="remember_me" class="checkbox">
                    {{ trans('messages.login_remember_me') }}
                </span>
            </label>
        </div>

        <div class="form-group mt-3">
            <x-primary-button class="kadomaru-btn-red-bg w-100">
                {{ __('Log in') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <p class="mt-3 txt-center">
                    <a class="txt-orange text-link-underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </p>
            @endif
        </div>

    </form>

</x-guest-layout>
