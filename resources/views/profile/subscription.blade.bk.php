<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box">
                <h2 class="h2-title" name="header">サブスクリプション</h2>
                <p class="txt-center mb-3">月額会員へのお申し込み等はこちらから行えます。</p>
                <form id="setup-form" action="{{ route('subscribe.post') }}" method="post">
                    @csrf
                    <input id="card-holder-name" type="text" placeholder="カード名義人">
                    <div id="card-element"></div>
                    <button id="card-button" data-secret="{{ $intent->client_secret }}">
                        有料会員登録
                    </button>
                </form>
            </div>

            @push('scripts')
                <script src="https://js.stripe.com/v3/"></script>
                <script>
                    const stripe = Stripe(
                        'pk_test_51OgORZCqDLjiACIRhtVir6ch87q3YY9ocoJVbKAAre1CTEyaz8ar0OYRzC4kCb7hfkklcT90ZrCkoWWMDCXe9LBf002G3Pwm0v'
                    );

                    const elements = stripe.elements();
                    const cardElement = elements.create('card');
                    cardElement.mount('#card-element');

                    const cardHolderName = document.getElementById('card-holder-name');
                    const cardButton = document.getElementById('card-button');
                    const clientSecret = cardButton.dataset.secret;

                    cardButton.addEventListener('click', async (e) => {
                        e.preventDefault();
                        const {
                            setupIntent,
                            error
                        } = await stripe.confirmCardSetup(
                            clientSecret, {
                                payment_method: {
                                    card: cardElement,
                                    billing_details: {
                                        name: cardHolderName.value
                                    }
                                }
                            }
                        );
                        if (error) {
                            // Display "error.message" to the user...
                            console.log(error);
                        } else {
                            // The card has been verified successfully...
                            stripePaymentIdHandler(setupIntent.payment_method);
                        }
                    });

                    function stripePaymentIdHandler(paymentMethodId) {
                        // Insert the paymentMethodId into the form so it gets submitted to the server
                        const form = document.getElementById('setup-form');

                        const hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'paymentMethodId');
                        hiddenInput.setAttribute('value', paymentMethodId);
                        form.appendChild(hiddenInput);

                        // Submit the form
                        form.submit();
                    }
                </script>
            @endpush

        </div>

    </div>

</x-app-layout>
