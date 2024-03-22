
{{-- @auth
@if (auth()->user()->role === 'premium') --}}
    <div class="reservations-container">
        <p>※当日のご予約は各店舗に直接お問い合わせください。</p>
        <form id="reservationForm" method="POST" action="{{ route('reservations.store') }}">
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
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
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
        </script>
    </div>
{{-- @endif
@endauth --}}