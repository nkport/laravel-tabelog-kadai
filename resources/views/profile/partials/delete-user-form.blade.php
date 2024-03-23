<h2 class="h2-title">
    {{ __('Delete Account') }}
</h2>


<p class="txt-center">
    有料会員様はサブスクリプションを解除しないと<br>
    お支払いが継続してしまいますので、ご注意ください。<br>
    {{-- <a href="{{ route('subscription.cancel') }}" class="text-link txt-red"><strong>有料会員の解除はこちら</strong></a> --}}
</p>

<div class="txt-center">
    <x-danger-button class="mt-3 kadomaru-btn-red-line" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-danger-button>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="mt-4 h2-title">
            {{ __('Are you sure you want to delete your account?') }}
        </h2>

        <p class="txt-center">
            {!! nl2br(e(__('messages.profile_delete_msg'))) !!}
        </p>

        <p class="txt-center">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </p>

        <div class="mt-1 txt-center">
            <x-input-label class="display-none" for="password" value="{{ __('Password') }}" />
            <div class="form-group">
                <x-text-input id="password" name="password" type="password" class="mt-1"
                    placeholder="{{ __('Password') }}" />
            </div>
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <div class="mt-3 txt-center">
            <x-secondary-button class="mx-1 kadomaru-btn-red-bg" x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="mx-1 kadomaru-btn-red-line">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

    </form>

</x-modal>
