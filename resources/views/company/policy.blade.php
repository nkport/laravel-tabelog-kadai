<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box">

                <h2 class="h2-title">{{ trans('messages.footer_nav_policy') }}</h2>

                <div class="company-info-container">

                    @if ($policy)
                        <p>{!! $policy->description !!}</p>
                        @if ($company->isNotEmpty())
                            @foreach ($company as $item)
                                <h3 class="h4-title txt-left">{{ trans('messages.policy_footer') }}</h3>
                                <p>
                                    {!! nl2br(e($item->address)) !!}<br>
                                    {{ $item->company_name }}<br>
                                    メール：{{ $item->contact }}<br>
                                    TEL：{{ $item->tel }}
                                </p>
                            @endforeach
                        @else
                            <p>会社情報がまだ登録されていません。</p>
                        @endif
                    @else
                        <p>プライバシーポリシーがまだ登録されていません。</p>
                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
