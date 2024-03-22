<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box">
                <ul>
                    @foreach ($reservations as $reservation)
                        <li class="mt-3">
                            <div class="flex-box">
                                <figure class="shops-image">
                                    @if ($reservation->shop && !empty($reservation->shop->image))
                                        @php
                                            $images = is_array($reservation->shop->image)
                                                ? $reservation->shop->image
                                                : json_decode($reservation->shop->image, true);
                                        @endphp
                                        @if ($images)
                                            @foreach ($images as $image)
                                                <img src="{{ asset($image) }}" class="img-thumbnail"
                                                    alt="{{ $reservation->shop->name }}">
                                            @endforeach
                                        @else
                                            <img src="{{ asset('storage/images/dummy.png') }}" class="img-thumbnail"
                                                alt="画像が登録されていません">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/images/dummy.png') }}" class="img-thumbnail"
                                            alt="画像が登録されていません">
                                    @endif
                                </figure>
                                <div>
                                    <h3>{{ $reservation->reservation_datetime }} に予約しました</h3>
                                    <p>予約日時：<strong>XXXX/XX/XX</strong>　<strong>00:00～</strong></p>
                                    <p>予約人数：{{ $reservation->number_of_guests }} 人</p>
                                    <hr class="mt-3">
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

        </div>

    </div>

</x-app-layout>
