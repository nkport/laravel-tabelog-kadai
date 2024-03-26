<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shops;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function index(Request $request)
    {
        // ログイン中のユーザーIDを取得
        $userId = Auth::id();

        // ユーザーの予約データを取得し、予約日時が新しい順に並べ替えて15件ずつページネーションを適用
        $reservations = Reservation::where('user_id', $userId)
            ->orderBy('reservation_datetime', 'desc')
            ->paginate(15);

        // 予約一覧ページで店舗名を表示
        $shopNames = Shops::whereIn('id', $reservations->pluck('shops_id'))->pluck('name', 'id');

        // ビューに変数を渡す
        return view('reservations.index', compact('reservations', 'shopNames'));
    }

    public function create($id)
    {
        try {
            $shop = Shops::findOrFail($id);
            $today = Carbon::now()->subHours(2);
            $maxReservationDate = Carbon::now()->addDays(14); // 2週間後までの予約を制限
            $availableDates = $this->getAvailableDates($shop, $today, $maxReservationDate); // 予約可能な日付のリストを取得
            $availableTimes = $this->getAvailableTimes($shop); // 店舗の営業時間内の時間のリストを取得

            return view('reservations.create', compact('shop', 'today', 'maxReservationDate', 'availableDates', 'availableTimes'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        }

        // ショップのデータを取得してビューに渡す
        // $shop = Shops::find($id);

        // ショップの開始時間と終了時間を取得
        // $openTime = $shop->open_time;
        // $closeTime = $shop->close_time;
        // $openTime = substr($shop->open_time, 0, 2) . ':00'; // 例: "18:05:11" -> "18:00"
        // $closeTime = substr($shop->close_time, 0, 2) . ':00'; // 例: "01:33:54" -> "01:00"

        // ビューにデータを渡す
        // return view('reservations.create', compact('shop', 'openTime', 'closeTime'));
    }


    private function getAvailableDates($shop, $startDate, $endDate)
    {
        // 今日の日付
        $today = Carbon::now()->format('Y-m-d');

        // 定休日の取得
        $closedDays = explode(',', $shop->closed_days);

        // 予約可能な日付のリストを生成
        $availableDates = [];
        $currentDate = $startDate->copy();
        while ($currentDate->lte($endDate)) {
            if (!in_array($currentDate->format('N'), $closedDays)) { // 定休日でない場合のみ追加
                $availableDates[] = $currentDate->format('Y-m-d');
            }
            $currentDate->addDay(); // 日付を1日進める
        }

        return $availableDates;
    }

    private function getAvailableTimes($shop)
    {
        // 営業時間の取得
        $openTime = Carbon::parse($shop->open_time);
        $closeTime = Carbon::parse($shop->close_time);

        // 定休日の取得
        $closedDays = explode(',', $shop->closed_days);

        // 営業時間内の時間のリストを生成
        $availableTimes = [];
        $currentTime = $openTime->copy();
        while ($currentTime->lt($closeTime)) {
            $currentTimeString = $currentTime->format('H:i');
            if (!in_array($currentTime->format('N'), $closedDays)) { // 定休日でない場合のみ追加
                $availableTimes[] = $currentTimeString;
            }
            $currentTime->addMinutes(30); // 30分単位で時間を追加
        }

        return $availableTimes;
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'reservation_date' => 'required|date_format:Y-m-d',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_guests' => 'required|integer|min:1|max:50',
        ]);

        // 新しい予約を作成
        $reservation = new Reservation;
        $reservation->shops_id = $request->shops_id; // shops_idの値を代入
        $reservation->user_id = $request->user_id; // user_idの値を代入
        $reservation->reservation_datetime = $request->reservation_date . ' ' . $request->reservation_time; // reserved_datetimeの値を代入
        $reservation->number_of_guests = $request->number_of_guests; // number_of_guestsの値を代入

        // 予約を保存
        $reservation->save();

        // フラッシュメッセージをセッションに保存
        $request->session()->flash('flash_message', '予約が完了しました。');

        // 予約一覧ページにリダイレクト
        return redirect()->route('reservations.index');
    }

    public function destroy(Reservation $reservation)
    {
        // 現在ログイン中のユーザーIDと予約ユーザーIDを比較
        if (Auth::id() !== $reservation->user_id) {
            // 一致しない場合は予約一覧ページにリダイレクト
            return redirect()->route('reservations.index')->with('error_message', '不正なアクセスです。');
        }

        // 予約を削除
        $reservation->delete();

        // フラッシュメッセージをセッションに保存
        session()->flash('flash_message', '予約をキャンセルしました。');

        // 予約一覧ページにリダイレクト
        return redirect()->route('reservations.index');
    }

}
