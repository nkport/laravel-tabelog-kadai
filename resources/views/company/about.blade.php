<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box">
                <h2 class="h2-title">{{ trans('messages.footer_nav_company') }}</h2>
                @if (optional($company)->isNotEmpty())
                    @foreach ($company as $item)
                        <div class="about-container">
                            <table class="about-information">
                                <tr>
                                    <th>{{ trans('messages.about_company_name') }}</th>
                                    <td>{{ $item->company_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.about_company_establishment') }}</th>
                                    <td>{{ \Carbon\Carbon::parse($item->establishment_date)->format('Y年m月d日') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.about_company_address') }}</th>
                                    <td>{!! nl2br(e($item->address)) !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.about_company_capital') }}</th>
                                    <td>{{ $item->capital }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.about_company_representative') }}</th>
                                    <td>{{ $item->representative }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.about_company_description') }}</th>
                                    <td>{!! nl2br(e($item->description)) !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.about_company_suppliers') }}</th>
                                    <td>{!! nl2br(e($item->suppliers)) !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.about_company_suppliers_bank') }}</th>
                                    <td>{!! nl2br(e($item->suppliers_bank)) !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('messages.about_company_history') }}</th>
                                    <td>{!! nl2br(e($item->history)) !!}</td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                @else
                    <p>会社情報がまだ登録されていません。</p>
                @endif
            </div>

            <div class="kadomaru-box mt-3">

                <h2 id="contact" class="h2-title">{{ trans('messages.footer_nav_contact') }}</h2>

                <div class="company-info-container">

                    @if (optional($company)->isNotEmpty())
                        @foreach ($company as $item)
                            <div class="about-container">
                                <table class="about-information">
                                    <tr>
                                        <th>{{ trans('messages.footer_nav_contact') }}</th>
                                        <td>{{ $item->contact }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('messages.about_company_tel') }}</th>
                                        <td>{{ $item->tel }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endforeach
                    @else
                        <p>お問い合わせ情報がまだ登録されていません。</p>
                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
