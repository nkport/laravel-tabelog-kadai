<x-guest-layout>

    <h2 class="h2-title">{{ __('messages.forgot_password_title') }}</h2>

    <p class="txt-center line-height-wide">
        {!! nl2br(e(__('messages.forgot_password_msg'))) !!}
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mt-2 txt-orange txt-center" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="txt-center mt-2">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>
