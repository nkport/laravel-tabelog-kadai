<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use App\Models\Category;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Http\Request;

class IndexHomeController extends Controller
{
    public function index(Request $request)
    {
        // お店の情報を取得
        $shops = Shops::all();

        // カテゴリーの情報を取得
        $categories = Category::all();

        // お店の情報と予約データの情報を取得し1件ずつ表示
        $shopsWithReservations = [];
        foreach ($shops as $shop) {
            $latestReservation = $shop->reservations()->latest()->first(); // 最新の予約データを取得
            if ($latestReservation) {
                $shopReservations = collect([$latestReservation]); // 予約がある場合はコレクションに追加
                $shopsWithReservations[] = [
                    'shops' => $shop,
                    'reservations' => $shopReservations,
                ];
            }
        }

        // お店の情報と最新のレビューデータの情報を取得し1件ずつ表示
        $shopsWithReviews = [];
        foreach ($shops as $shop) {
            $latestReview = $shop->reviews()->latest()->first(); // 最新のレビューデータを取得
            if ($latestReview) {
                $shopReviews = collect([$latestReview]); // レビューがある場合はコレクションに追加
                $shopsWithReviews[] = [
                    'shops' => $shop,
                    'reviews' => $shopReviews,
                ];
            }
        }

        // ビューに変数を渡す
        return view('index', compact('categories', 'shopsWithReservations', 'shopsWithReviews'));
    }

}
