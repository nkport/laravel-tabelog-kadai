<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="shops-item">

                <div class="px-2 flex-box justify-between">
                    <div class="shops-header">
                        <span><img src="{{ asset('img/food.png') }}" class="display-inline mr-1">
                            {{ $shop->category ? $shop->category->name : '未指定' }}</span>
                        <h3 class="h3-title">{{ $shop->name }}</h3>
                    </div>
                    @auth
                        @if (auth()->user()->role === 'premium')
                            <div class="">
                                <form method="POST" class="">
                                    @csrf
                                    @if (Auth::user()->favorite_shops()->where('shops_id', $shop->id)->exists())
                                        <a href="{{ route('favorites.destroy', $shop->id) }}" class="fav-btn-active"
                                            onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('favorites.store', $shop->id) }}" class="fav-btn"
                                            onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    @endif
                                </form>
                                <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $shop->id) }}"
                                    method="POST" class="display-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <form id="favorites-store-form" action="{{ route('favorites.store', $shop->id) }}"
                                    method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @else
                            {{-- プレミアム会員ではないログインユーザーの場合 --}}
                            <a href="{{ route('reservations.create', ['shop' => $shop->id]) }}" class="fav-btn">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        @endif
                    @else
                        {{-- 未ログインユーザーの場合 --}}
                        <a href="{{ route('reservations.create', ['shop' => $shop->id]) }}" class="fav-btn">
                            <i class="fa-regular fa-heart"></i>
                        </a>
                    @endauth
                </div>

                <div class="flex-box justify-around">

                    <figure class="shops-image">
                        @if ($shop && !empty($shop->image))
                            @php
                                $images = is_array($shop->image) ? $shop->image : json_decode($shop->image, true);
                            @endphp
                            @if ($images)
                                <ul class="shops-image">
                                    @foreach ($images as $image)
                                        <li class="slider-item slider-item01"><img src="{{ asset($image) }}"
                                                class="img-thumbnail" alt="{{ $shop->name }}"></li>
                                    @endforeach
                                </ul>
                            @else
                                <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail" alt="画像が登録されていません">
                            @endif
                        @else
                            <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail" alt="画像が登録されていません">
                        @endif
                    </figure>

                    <div class="shops-data">
                        <table class="shops-data-table">
                            <tr>
                                <th><i class="fa-solid fa-shop mr-1"></i>住所</th>
                                <td>{{ $shop->address }}</td>
                            </tr>
                            <tr>
                                <th><i class="fa-solid fa-clock mr-1"></i>営業時間</th>
                                <td>{{ $startTime }}～{{ $endTime }}
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fa-regular fa-circle-xmark mr-1"></i>定休日</th>
                                <td>
                                    @if ($weekdays->isEmpty())
                                        <p>店舗にお問い合わせください</p>
                                    @else
                                        <p>{{ implode('｜', $weekdays->toArray()) }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <div class="flex-box align-center">
                                        <img src="{{ asset('img/wallet.png') }}" class="display-inline mr-1">平均費用
                                    </div>
                                </th>
                                <td>
                                    ￥{{ $shop->avg_price_low }} ～
                                    ￥{{ $shop->avg_price_high }}
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fa-solid fa-phone mr-1"></i>電話番号</th>
                                <td>{{ $shop->tel }}</td>
                            </tr>
                            <tr>
                                <th>
                                    <div class="flex-box align-center">
                                        <img src="{{ asset('img/map.png') }}" class="display-inline mr-1">
                                        駅からの距離
                                    </div>
                                </th>
                                <td>名古屋駅から約 {{ number_format($shop->distance, 0) }} km</td>
                            </tr>
                        </table>

                        <div class="mt-1">
                            <a href="{{ route('reservations.create', ['shop' => $shop->id]) }}"
                                class="w-100 display-block txt-center kadomaru-btn-green-bg-slim">
                                <i class="fa-regular fa-calendar-days mr-tiny"></i>
                                お店を予約する
                            </a>
                        </div>
                        <div class="mt-1 txt-center">
                            <a href="#review" class="txt-red">
                                レビューを投稿する
                                <i class="fa-solid fa-comment-dots"></i>
                            </a>
                        </div>

                    </div>

                </div>

                <div class="my-2 px-2">
                    <p>{{ $shop->description }}</p>
                </div>

                <div class="review-container px-2">
                    <h2 class="h2-title txt-left mb-2">
                        新着レビュー
                        <i class="fa-solid fa-comment-dots txt-red"></i>
                    </h2>
                    @php
                        // 特定の店舗のレビューを取得するクエリ
                        $shopReviews = App\Models\Review::where('shops_id', $shop->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(3);
                    @endphp
                    @foreach ($shopReviews as $review)
                        <div class="new-review-item">
                            <div class="callout">
                                <h3 class="h4-title txt-red">
                                    {{ str_repeat('★', $review->score) }}
                                </h3>
                                <p>{{ $review->content }}</p>
                                <p class="txt-right mt-1">
                                    by
                                    {{ optional($review->user)->name }}
                                    （<strong>{{ $review->created_at->format('Y/m/d') }}</strong>）
                                </p>
                            </div>
                        </div>
                    @endforeach
                    @auth
                        @if (auth()->user()->role === 'premium')
                            <div class="review-pagination">
                                {{ $shopReviews->links() }}
                            </div>
                        @else
                            <p class="txt-center txt-orange">有料会員になるとレビュー投稿や続きが読めます。</p>
                        @endif
                    @else
                        <p class="txt-center txt-orange">有料会員になるとレビュー投稿や続きが読めます。</p>
                    @endauth
                </div>

                <div id="review" class="review-container-form">
                    @if (auth()->check() && auth()->user()->role === 'premium')
                        @auth
                            <div class="mt-2 px-2">
                                <h2 class="h2-title txt-left mb-2">
                                    レビューを書く
                                    <i class="fa-solid fa-pencil txt-red"></i>
                                </h2>
                                <form method="POST" action="{{ route('reviews.store') }}">
                                    @csrf
                                    <h4 class="mb-1">評価</h4>
                                    <div class="star-select">
                                        <select name="score">
                                            <option value="5" class="review-score-color">★★★★★</option>
                                            <option value="4" class="review-score-color">★★★★</option>
                                            <option value="3" class="review-score-color">★★★</option>
                                            <option value="2" class="review-score-color">★★</option>
                                            <option value="1" class="review-score-color">★</option>
                                        </select>
                                    </div>
                                    <h4 class="mt-2 mb-1">レビュー内容</h4>
                                    @error('content')
                                        <strong>レビュー内容を入力してください</strong>
                                    @enderror
                                    <textarea name="content" rows="6" class="form-control w-100"></textarea>
                                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                    <button type="submit"
                                        class="kadomaru-btn-green-bg border-none w-100 display-block mt-2">レビューを追加</button>
                                </form>
                            </div>
                        @endauth
                    @endif
                </div>
            </div>

        </div>

        <div class="mt-5 txt-center">
            <a href="{{ route('shops') }}" class="kadomaru-btn-orange-bg"><i
                    class="fa-solid fa-caret-left mr-1"></i>お店一覧に戻る</a>
        </div>

    </div>

    </div>

</x-app-layout>
