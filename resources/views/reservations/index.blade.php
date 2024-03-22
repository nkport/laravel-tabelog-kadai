<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box user-page px-3">

                <h2 class="h2-title">ご予約店舗</h2>

                <div class="view-reservation">

                    @if ($reservations->isEmpty())
                        <p class="txt-center">まだ、ご予約店舗はございません。</p>
                    @else
                        <table class="tb01">
                            <tr class="head">
                                <th>店舗名</th>
                                <th>予約日時</th>
                                <th>予約人数</th>
                            </tr>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td><a href="{{ route('shops.show', $reservation->shops_id) }}" class="accent-red text-link">
                                            {{ $shopNames[$reservation->shops_id] }}
                                        </a>
                                    </td>
                                    <td data-label="予約日時">{{ $reservation->reservation_datetime }} </td>
                                    <td data-label="予約人数"> {{ $reservation->number_of_guests }}</td>
                                </tr>
                            @endforeach
                        </table>

                        {{ $reservations->links() }}
                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
