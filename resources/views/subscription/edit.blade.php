<x-app-layout>

    @if (session('subscription_message'))
        <div class="pt-80 -mb-4">
            <div class="alert alert-success txt-center">
                {{ session('subscription_message') }}
            </div>
        </div>
    @endif

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box user-page">

                <h2 class="h2-title" name="header">カード情報の編集</h2>

                <p class="txt-center mb-3">お支払いに登録したカード情報を編集できます。</p>

                <div class="mb-3">
                    <table class="card-information">
                        <tr>
                            <th>カード種別</th>
                            <td>{{ $user->pm_type }}</td>
                        </tr>
                        <tr>
                            <th>カード名義人</th>
                            <td>{{ $user->defaultPaymentMethod()->billing_details->name }}</td>
                        </tr>
                        <tr>
                            <th>カード番号</th>
                            <td>**** **** **** {{ $user->pm_last_four }}</td>
                        </tr>
                    </table>
                </div>

                <div class="font-weight txt-red" id="card-error" role="alert">
                    <ul class="mb-0" id="error-list"></ul>
                </div>

                <form id="card-form" action="{{ route('subscription.update') }}" method="post">
                    @csrf
                    @method('patch')
                    <input type="text" id="card-holder-name" placeholder="カード名義人" required>
                    <div id="card-element"></div>
                </form>
                <button id="card-button" data-secret="{{ $intent->client_secret }}">
                    カード情報を変更する
                </button>

                @push('scripts')
                    <script src="https://js.stripe.com/v3/"></script>
                    <script>
                        const stripeKey = "{{ env('STRIPE_KEY') }}";
                    </script>
                    <script src="{{ asset('/js/stripe.js') }}"></script>
                @endpush

            </div>

        </div>

    </div>

</x-app-layout>
