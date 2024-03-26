<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box user-page">

                @if (session('subscription_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('subscription_message') }}</p>
                    </div>
                @endif

                <h2 class="h2-title mb-1" name="header">サブスクリプション</h2>

                <p class="txt-center mb-1">有料会員へのお申し込みはこちらから行えます。</p>

                <figure class="jump mb-2">
                    <img src="{{ asset('img/shachihoko.svg') }}" alt="跳ねるシャチホコ" class="m-auto" style="width: 80px;">
                </figure>

                <div class="callout">
                    <ul class="list-group">
                        <li class="list-group-item">月額たったの300円</li>
                        <li class="list-group-item">当日の2時間前までならいつでも予約可能</li>
                        <li class="list-group-item">店舗をお好きなだけお気に入りに追加可能</li>
                        <li class="list-group-item">レビューを全件閲覧可能</li>
                        <li class="list-group-item">レビューを投稿可能</li>
                    </ul>
                </div>

                <div class="txt-red font-weight" id="card-error" role="alert">
                    <p class="mb-2" id="error-list"></p>
                </div>

                <form id="card-form" action="{{ route('subscription.store') }}" method="post">
                    @csrf
                    <input id="card-holder-name" type="text" placeholder="カード名義人" required>
                    <div id="card-element"></div>
                </form>
                <button id="card-button" data-secret="{{ $intent->client_secret }}">
                    有料会員に登録する
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
