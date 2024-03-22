<x-app-layout>

    <div class="wrapper">

        <div class="container">

            @if ($category !== null)
                <h3 class="h3-title">「{{ $category->name }}」のお店一覧</h3>
            @else
                <h3 class="h3-title">{{ config('app.name', 'Laravel') }} のお店一覧</h3>
            @endif

            <div class="shops-list">
                <span>
                    <a class="category-tags {{ request('category') == null ? 'selected-category' : '' }}"
                        href="{{ route('shops') }}">すべて</a>
                </span>
                @foreach ($categories as $item)
                    <span>
                        <a class="category-tags {{ request('category') == $item->id ? 'selected-category' : '' }}"
                            href="{{ route('shops', ['category' => $item->id]) }}">{{ $item->name }}</a>
                    </span>
                @endforeach
            </div>

            <div class="shops-list-function">
                <div class="search-form">
                    <form action="{{ route('shops') }}" method="GET">
                        <input name="keyword" placeholder="店名・キーワード検索">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="search-path">
                    <form method="get" action="{{ route('shops') }}">
                        <strong>名古屋駅から</strong>
                        <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>近い順</option>
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>遠い順</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="flex-box justify-between align-end mx-1 mb-1">
                <div class="shops-num-data">
                    全 {{ $shops->total() }} 件（{{ $shops->firstItem() }}~{{ $shops->lastItem() }}件）
                </div>
                <div class="sort-select">
                    <select id="sort-select"
                        onchange="location = window.location.pathname + window.location.search + (window.location.search ? '&' : '?') + this.options[this.selectedIndex].value;">
                        <option value="">並び替え</option>
                        <option value="sort=created_at&direction=desc">新着順</option>
                        <option value="sort=avg_price_low&direction=asc">価格が安い順</option>
                        <option value="sort=avg_price_high&direction=desc">価格が高い順</option>
                        <option value="sort=score&direction=desc">スコアが高い順</option>
                    </select>
                </div>
            </div>
            @foreach ($shops as $shop)
                <a href="{{ route('shops.show', $shop->id) }}">
                    <div class="shops-item flex-box">
                        <figure class="shops-image">
                            @if ($shop->image !== null && $shop->image !== '')
                                @php
                                    $images = is_array($shop->image) ? $shop->image : json_decode($shop->image, true);
                                @endphp
                                @if (is_array($images) && count($images) > 0)
                                    @php
                                        $firstImage = reset($images); // 配列の最初の要素を取得
                                    @endphp
                                    <img src="{{ asset($firstImage) }}" class="img-thumbnail" alt="{{ $shop->name }}">
                                @else
                                    <img src="{{ asset('storage/images/dummy.png') }}" class="img-thumbnail" alt="{{ $shop->name }}">
                                @endif
                            @else
                                <img src="{{ asset('storage/images/dummy.png') }}" class="img-thumbnail" alt="画像が登録されていません">
                            @endif
                        </figure>
                        <div class="shops-data">
                            <div class="shops-header">
                                <span class="flex-box align-center">
                                    <img src="{{ asset('img/food.png') }}">
                                    {{ $shop->category ? $shop->category->name : '未指定' }}
                                </span>
                                <h3 class="h3-title">{{ $shop->name }}</h3>
                            </div>
                            <div class="shops-main">
                                <p>{{ Illuminate\Support\Str::limit($shop->description, 180) }}</p>
                            </div>
                            <div class="shops-footer mt-2">
                                <div class="flex-box align-center">
                                    <img src="{{ asset('img/wallet.png') }}">
                                    <span>
                                        {{ $shop->avg_price_low }} ～
                                        {{ $shop->avg_price_high }} 円
                                    </span>
                                </div>
                                <div class="flex-box align-center">
                                    <img src="{{ asset('img/map.png') }}">
                                    <span>
                                        名古屋駅から {{ number_format($shop->distance, 0) }} km
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

            <div>
                {{ $shops->appends(request()->query())->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
