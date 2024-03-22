<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box user-page">

                <h2 class="h2-title">お気に入りのお店</h2>

                @if (!$favorite_shops->isEmpty())
                    @foreach ($favorite_shops as $favorite_shop)
                        <div class="fav-container callout">
                            <figure class="favs-image w-15 mr-2">
                                @php
                                    $images = is_array($favorite_shop->image)
                                        ? $favorite_shop->image
                                        : json_decode($favorite_shop->image, true);
                                @endphp
                                @if (is_array($images) && count($images) > 0)
                                    @php
                                        $firstImage = reset($images); // 配列の最初の要素を取得
                                    @endphp
                                    <img src="{{ asset($firstImage) }}" class="img-thumbnail"
                                        alt="{{ $favorite_shop->name }}">
                                @else
                                    <img src="{{ asset('storage/images/dummy.png') }}" class="img-thumbnail"
                                        alt="{{ $favorite_shop->name }}">
                                @endif
                            </figure>
                            <div class="fav-container-item">
                                <a href="{{ route('shops.show', $favorite_shop->id) }}">
                                    <span class="shops-title">
                                        <img src="{{ asset('img/food.png') }}">
                                        {{ $favorite_shop->category ? $favorite_shop->category->name : '未指定' }}
                                    </span>
                                    <h2 class="h2-title">{{ $favorite_shop->name }}</h2>
                                </a>
                                <div class="fav-container-item-btn">
                                    <a href="{{ route('favorites.destroy', $favorite_shop->id) }}"
                                        class="kadomaru-btn-red-bg"
                                        onclick="event.preventDefault(); document.getElementById('favorites-destroy-form-{{ $favorite_shop->id }}').submit();">
                                        <i class="fa fa-heart"></i>
                                        お気に入り解除
                                    </a>
                                    <form id="favorites-destroy-form-{{ $favorite_shop->id }}"
                                        action="{{ route('favorites.destroy', $favorite_shop->id) }}" method="POST"
                                        class="display-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $favorite_shops->links() }}
                @else
                    <p class="txt-center">まだ、お気に入り店舗はございません。</p>
                @endif

            </div>

        </div>

    </div>

</x-app-layout>
