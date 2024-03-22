<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shops;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function index(Request $request)
    {
        // ログイン中のユーザーのIDを取得
        $userId = Auth::id();

        // ユーザーに属する予約データを取得し、予約日時が新しい順に並べ替えて15件ずつページネーションを適用
        $reservations = Reservation::where('user_id', $userId)
            ->orderBy('reservation_datetime', 'desc')
            ->paginate(15);

        $shopNames = Shops::whereIn('id', $reservations->pluck('shops_id'))->pluck('name', 'id');

        // ビューに変数を渡して予約一覧ページを表示
        return view('reservations.index', compact('reservations', 'shopNames'));
    }

    public function create($id)
    {
        // その店舗のデータを取得
        $shop = Shops::find($id);

        // 今日の日付を取得
        $currentDay = now()->format('Y-m-d');

        // 今の時間を取得
        $currentTime = now()->format('H:i:s');

        // 開始時刻
        $open = $shop->open_time;

        // 終了時刻
        $close = $shop->close_time;

        $test = '15:00:00';

        // 取得した営業時間をビューに渡す
        return view('reservations.create', compact('shop', 'currentDay', 'currentTime', 'open', 'close', 'test'));
    }

    private function getOpeningHours()
    {
        // ここで実際にショップの営業時間を取得する処理を行う
        // 例えば、Shopモデルのメソッドを使って取得するなど
        // 仮のコード例
        $shop = Shops::first(); // 仮の取得方法
        if ($shop) {
            return $shop->opening_hours;
        } else {
            return null;
        }
    }

    public function store(Request $request)
    {
        // 予約の作成処理
        return redirect()->route('reservations.index')->with('success', '予約が作成されました。');
    }

    public function destroy($id)
    {
        // 予約の削除処理
        return redirect()->route('reservations.index')->with('success', '予約が削除されました。');
    }

}