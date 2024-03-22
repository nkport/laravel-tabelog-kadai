<x-guest-layout>

    <h2 class="h2-title">{{ __('messages.verify_title') }}</h2>

    <p class="txt-center line-height-wide">
        {!! nl2br(e(__('messages.verify_thank_you'))) !!}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-2 txt-orange txt-center">
            <strong>
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </strong>
        </div>
    @endif

    <div class="mt-2">

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div class="txt-center">
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>

        </form>

        {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form> --}}

    </div>

</x-guest-layout>
