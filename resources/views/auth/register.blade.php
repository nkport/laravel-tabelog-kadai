<x-guest-layout>

    <h2 class="h2-title">{{ __('messages.common_register') }}</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" class="require" />
            <x-text-input id="name" class="w-100" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name"
                placeholder="{{ __('messages.registration_name_placeholder') }}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" class="require" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required
                autocomplete="username"
                placeholder="{{ __('messages.registration_mail_placeholder') }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" class="require" />
            <x-text-input id="password" class="w-100" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="w-100" type="password" name="password_confirmation"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="form-group mt-3">
            <x-primary-button class="w-100">
                {{ __('messages.registration_submit') }}
            </x-primary-button>

            <p class="mt-3 txt-center">
                <a class="txt-orange text-link-underline" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </p>

        </div>

    </form>

</x-guest-layout>
