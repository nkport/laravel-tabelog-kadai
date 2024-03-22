<x-app-layout>

    <div class="wrapper pb-0">

        <!-- メインビジュアル -->
        <div id="slider" class="mv">
            <img src="{{ asset('img/mv_center.svg') }}" alt="{{ config('app.name', 'Laravel') }}">
        </div>

        <!-- キャッチ -->
        <div class="new-reservation-container">
            <h2 class="h2-title txt-white">
                新着の予約店舗
                <span class="subtitle">NEW RESERVATIONS</span>
            </h2>
            <ul class="new-reservation">
                @php $count = 0 @endphp
                @foreach ($shopsWithReservations as $shopWithReservations)
                    @if ($count < 5)
                        @php $shop = $shopWithReservations['shops'] @endphp
                        <a href="{{ route('shops.show', $shop->id) }}">
                            <li class="new-reservation-item">
                                <div class="txt-center">
                                    <h4 class="h4-title">{{ $shopWithReservations['shops']->name }}</h4>
                                    @foreach ($shopWithReservations['reservations'] as $reservation)
                                        @if ($count < 5)
                                            <figure class="py-1 txt-center">
                                                <img src="{{ asset('img/top_icon_1.svg') }}" alt="お店アイコン"
                                                    class="m-auto" width="15%">
                                            </figure>
                                            <p><strong>{{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('Y年m月d日') }}</strong>に、<br><strong>{{ $reservation->number_of_guests }}人</strong>の予約がありました！
                                            </p>
                                            @php $count++ @endphp
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                        </a>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- メインコンテンツ -->
        <div class="top-container">

            <!-- 検索機能 -->
            <div class="w-49">

                <div class="kadomaru-box-left">
                    <h2 class="h2-title">
                        なごやめしとは？
                        <span class="subtitle">ABOUT THIS SITE</span>
                    </h2>
                    <img src="{{ asset('img/castle.svg') }}" alt="名古屋城のアイコン" class="top-image-1">
                    <div class="my-2 txt-center">
                        <p>みなさまから愛される「B級グルメ」に特化型した予約＆レビューサイトです。</p>
                        <p>お店のご予約、レビュー投稿、お気に入り機能を使って名古屋のB級グルメを一緒に応援しませんか？</p>
                    </div>
                    <div class="txt-center mt-2">
                        <a href="{{ route('shops') }}" class="maru-btn-lg-bg">
                            <i class="fa fas fa-knife"></i>
                            <span class="adjust-480">ひとまず「</span>なごやめし<span class="adjust-480">」</span>を見る
                        </a>
                        {{-- <a href="{{ route('shops', ['sort' => 'created_at', 'direction' => 'desc']) }}" class="maru-btn-lg-bg">
                                <i class="fa fas fa-knife"></i>
                                ひとまず「なごやめし」を見る
                            </a> --}}
                    </div>
                </div>

                <div class="kadomaru-box-left mt-3 txt-center">
                    <h2 class="h2-title search-parts mb-2"><i class="fa-solid fa-tags txt-red"></i> カテゴリーから探す</h2>
                    <div class="shops-list">
                        <span>
                            <a class="category-tags {{ request('category') == null ? 'selected-category' : '' }}"
                                href="{{ route('shops') }}">すべて</a>
                        </span>
                        @foreach ($categories as $category)
                            <span>
                                <a class="category-tags {{ request('category') == $category->id ? 'selected-category' : '' }}"
                                    href="{{ route('shops', ['category' => $category->id]) }}">{{ $category->name }}</a>
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="kadomaru-box-left mt-3 txt-center">
                    <h2 class="h2-title search-parts mb-2"><i class="fa-solid fa-store txt-red"></i> 店名・キーワードから探す</h2>
                    <div class="search-form">
                        <form action="{{ route('shops') }}" method="GET">
                            <input name="keyword" placeholder="店名・キーワード検索">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- レビュー -->
            <div class="kadomaru-box-right w-49">
                <h2 class="h2-title">
                    新着レビュー
                    <i class="fa-solid fa-comment-dots txt-red"></i>
                    <span class="subtitle">NEW REVIEWS</span>
                </h2>
                <div class="new-review px-2">
                    @php
                        // 配列を新着順にソート
                        usort($shopsWithReviews, function ($a, $b) {
                            return max(array_column($a['reviews']->toArray(), 'created_at')) <
                                max(array_column($b['reviews']->toArray(), 'created_at'));
                        });
                        $count = 0;
                    @endphp
                    @foreach ($shopsWithReviews as $shopWithReviews)
                        @foreach ($shopWithReviews['reviews'] as $review)
                            @if ($count < 3)
                                <div class="new-review-item">
                                    <div class="callout">
                                        <h3 class="h4-title">{{ $shopWithReviews['shops']->name }}</h3>
                                        <h3 class="h4-title txt-red">
                                            {{ str_repeat('★', $review->score) }}
                                        </h3>
                                        <p>{{ $review->content }}</p>
                                        <p class="txt-right mt-1">by
                                            {{ optional($review->user)->name }}（<strong>{{ $review->created_at->format('Y/m/d') }}</strong>）
                                        </p>
                                    </div>
                                </div>
                                @php $count++ @endphp
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>

        </div>

        <!-- 画像スライド -->
        <ul class="shops-feature">
            <li><img src="{{ asset('img/img_01.jpg') }}" alt="画像ギャラリー"></li>
            <li><img src="{{ asset('img/img_02.jpg') }}" alt="画像ギャラリー"></li>
            <li><img src="{{ asset('img/img_03.jpg') }}" alt="画像ギャラリー"></li>
            <li><img src="{{ asset('img/img_04.jpg') }}" alt="画像ギャラリー"></li>
            <li><img src="{{ asset('img/img_05.jpg') }}" alt="画像ギャラリー"></li>
        </ul>

        <!-- ロゴ -->
        <div class="company-box">
            <img src="{{ asset('img/footer_logo.svg') }}" alt="{{ config('app.name', 'Laravel') }}"
                class="m-auto top-logo">
            @php
                $name = App\Models\Company::select('company_name')->first();
                $address = App\Models\Company::select('address')->first();
                $tel = App\Models\Company::select('tel')->first();
            @endphp
            <h2 class="h4-title mt-2">{{ $name->company_name }}</h2>
            <p>{{ $address->address }}</p>
            <p>TEL：{{ $tel->tel }}</p>
        </div>

    </div>

</x-app-layout>
