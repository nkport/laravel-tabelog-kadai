<x-app-layout>

    <x-slot name="header">
        <h2>
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box user-page">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="mt-3">
                <div class="kadomaru-box user-page">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="mt-3">
                <div class="kadomaru-box user-page">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
