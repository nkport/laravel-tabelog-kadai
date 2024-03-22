<p>今日の日付：{{ $currentDay }}</p>
<p>今の時間：{{ $currentTime }}</p>
<p>開始時刻：{{ $open }}</p>
<p>終了時刻：{{ $close }}</p>
<p>仮の時刻：{{ $test }}</p>

<h2>営業時間によって表示される行数が変わる</h2>
@php
    $open = $shop->open_time;
    $close = $shop->close_time;

    $openTime = DateTime::createFromFormat('H:i', $open);
    $closeTime = DateTime::createFromFormat('H:i', $close);

    $interval = new DateInterval('PT1H');
    $periods = new DatePeriod($openTime, $interval, $closeTime);
@endphp
<table>
    <thead>
        <tr>
            <th>時間</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($periods as $period): ?>
        <tr>
            <td><?php echo $period->format('H:i'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>時間帯によって○×が切り替わるテーブル</h2>
<table class="maru-batsu-kirikawaru-table">
    @for ($i = 0; $i < 24; $i++)
        <tr>
            @if ($currentTime > $open)
                <td>
                    <div class="reserve"><a href="#">◯</a></div>
                </td>
            @else
                <td>
                    <div class="cannot-reserve">✕</div>
                </td>
            @endif
        </tr>
    @endfor
</table>

{{-- <form id="reservationForm" method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div class="form-group">
            <label for="reservation_datetime">予約日時</label>
            <input type="datetime-local" id="reservation_datetime" name="reservation_datetime"
                required min="{{ now()->format('Y-m-d\TH:i') }}">
        </div>
        <div class="form-group">
            <label for="number_of_guests">人数</label>
            <select id="number_of_guests" name="number_of_guests" required>
                <option value="">選択してください</option>
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
                <option value="4">4人</option>
                <option value="5">5人</option>
                <option value="6">6人</option>
                <option value="7">7人</option>
                <option value="8">8人</option>
                <option value="9">9人</option>
                <option value="10">10人</option>
            </select>
        </div>
        <input type="hidden" name="shops_id" value="{{ $shops->id }}">
        <button type="button" onclick="validateReservation()">予約する</button>
    </form>
    <script>
        function validateReservation() {
            var reservationDatetime = document.getElementById('reservation_datetime').value;
            var selectedDatetime = new Date(reservationDatetime);
            var now = new Date();

            if (selectedDatetime <= now) {
                alert('当日は選択できません。');
            } else {
                var confirmReservation = confirm('予約しますか？');
                if (confirmReservation) {
                    alert('予約しました！');
                    window.location.href = "{{ route('profile.reservation') }}";
                }
            }
        }
    </script> --}}