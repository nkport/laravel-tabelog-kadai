<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box user-page">

                @if (session('subscription_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('subscription_message') }}</p>
                    </div>
                @endif

                <h2 class="h2-title" name="header">有料会員の解約</h2>

                <p class="txt-center mb-3">本当に解約してもよろしいですか？</p>

                <form id="cardForm" action="{{ route('subscription.destroy') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="form-group txt-center">
                        <button class="kadomaru-btn-red-bg">いますぐ解約する</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</x-app-layout>
