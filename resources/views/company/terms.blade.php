<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box">

                <h2 class="h2-title">{{ trans('messages.footer_nav_terms') }}</h2>

                <div class="company-info-container">
                    @if ($terms)
                        <p>{!! $terms->description !!}</p>
                    @else
                        <p>利用規約がまだ登録されていません。</p>
                    @endif
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
