<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box adjust-for-320">
                @auth
                    @if (auth()->user()->role === 'premium')
                        <h2 class="h2-title">ご予約ページ</h2>
                        <div class="reservations-container">
                            <p class="txt-center">※当日のご予約は2時間前までとなります。</p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="reservation-container">

                                <form method="POST" action="{{ route('reservations.store', ['shop' => $shop->id]) }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="reservation_date">予約日</label>
                                        <select id="reservation_date" class="form-control w-100" name="reservation_date"
                                            required>
                                            <option value="" disabled selected>選択してください</option>
                                            @foreach ($availableDates as $date)
                                                <option value="{{ $date }}">{{ $date }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="reservation_time">予約時間</label>
                                        <select id="reservation_time" class="form-control w-100" name="reservation_time"
                                            required>
                                            <option value="" disabled selected>選択してください</option>
                                            @foreach ($availableTimes as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="number_of_guests">ゲスト数</label>
                                        <input id="number_of_guests" type="number" class="form-control w-100"
                                            name="number_of_guests" required>
                                    </div>

                                    <!-- 追加 -->
                                    <input type="hidden" name="shops_id" value="{{ $shop->id }}">
                                    <!-- ログインユーザーのIDを含める -->
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                    <button type="submit"
                                        class="kadomaru-btn-green-bg w-100 border-none mt-4">予約する</button>
                                </form>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        var reservationDateSelect = document.getElementById("reservation_date");
                                        var reservationTimeSelect = document.getElementById("reservation_time");

                                        reservationDateSelect.addEventListener("change", function() {
                                            var selectedDate = new Date(this.value);
                                            var today = new Date();
                                            var deadline = new Date(today);
                                            deadline.setHours(today.getHours() + 2); // 当日の2時間前の時間

                                            if (selectedDate.toDateString() === today.toDateString()) {
                                                // 当日の場合、予約時間を制限する
                                                var options = reservationTimeSelect.options;
                                                for (var i = 0; i < options.length; i++) {
                                                    var time = options[i].value.split(":");
                                                    var reservationTime = new Date();
                                                    reservationTime.setHours(time[0]);
                                                    reservationTime.setMinutes(time[1]);
                                                    if (reservationTime < deadline) {
                                                        options[i].disabled = true;
                                                    } else {
                                                        options[i].disabled = false;
                                                    }
                                                }
                                            } else {
                                                // 他の日の場合、すべての予約時間を有効にする
                                                var options = reservationTimeSelect.options;
                                                for (var i = 0; i < options.length; i++) {
                                                    options[i].disabled = false;
                                                }
                                            }
                                        });
                                    });
                                </script>

                            </div>

                        </div>
                    @else
                        {{-- プレミアム会員ではないログインユーザーの場合 --}}
                        <div class="non-user">
                            <div class="callout mb-0">
                                <h2 class="h2-title">こちらの機能は有料会員限定です</h2>
                                <figure class="jump my-1">
                                    <img src="{{ asset('img/shachihoko.svg') }}" alt="跳ねるシャチホコ" class="m-auto"
                                        style="width: 80px;">
                                </figure>
                                <p class="txt-center"><strong class="txt-red">有料会員になって名古屋のB級グルメを応援しませんか？</strong></p>
                                <p class="txt-center">登録するとお店のご予約やレビュー機能、お気に入り機能が使えるようになります。</p>
                                <div class="txt-center mt-3 mb-2">
                                    <p class="mb-3 font-bold">＼ 詳しくはこちら！ ／</p>
                                    <a href="{{ route('subscription.create') }}">
                                        <strong class="kadomaru-btn-red-line">
                                            有料会員について　<i class="fa-solid fa-chevron-right"></i>
                                        </strong>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    {{-- 未ログインユーザーの場合 --}}
                    <div class="non-user">
                        <div class="callout mb-0">
                            <h2 class="h2-title">こちらの機能は有料会員限定です</h2>
                            <figure class="jump my-1">
                                <img src="{{ asset('img/shachihoko.svg') }}" alt="跳ねるシャチホコ" class="m-auto"
                                    style="width: 80px;">
                            </figure>
                            <p class="txt-center">有料会員になるとお店のご予約、レビュー投稿、お気に入り機能が使えるようになります。<br><strong
                                    class="txt-red">月額300円で、名古屋のB級グルメを応援しよう！</strong></p>
                            <div class="txt-center mt-3 mb-2">
                                <p class="mb-2 font-bold">＼ まずは新規登録しよう ／</p>
                                <a href="{{ route('register') }}"><strong
                                        class="kadomaru-btn-red-line">{{ trans('messages.common_register') }}</strong></a>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

        </div>

    </div>

</x-app-layout>
