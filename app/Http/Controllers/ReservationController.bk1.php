<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shops;
use Illuminate\Support\Facades\Auth;

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
        // ショップのデータを取得してビューに渡す
        $shop = Shops::find($id);

        // ショップの開始時間と終了時間を取得
        // $openTime = $shop->open_time;
        // $closeTime = $shop->close_time;
        $openTime = substr($shop->open_time, 0, 2) . ':00'; // 例: "18:05:11" -> "18:00"
        $closeTime = substr($shop->close_time, 0, 2) . ':00'; // 例: "01:33:54" -> "01:00"

        // ビューにデータを渡す
        return view('reservations.create', compact('shop', 'openTime', 'closeTime'));
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