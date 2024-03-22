<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box">

                <h2 class="h2-title">{{ trans('messages.introduction_title') }}</h2>

                <div class="company-info-container">
                    @if ($about)
                        <p>{!! $about->description !!}</p>
                    @else
                        <p>まだこのページには情報が登録されていません。</p>
                    @endif
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
