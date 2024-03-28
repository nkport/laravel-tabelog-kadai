<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use App\Models\Review;
use App\Models\Category;
use App\Models\Holiday;
use App\Models\ConnectHoliday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 全ての店舗を取得
        $shops = Shops::all();

        // カテゴリーを取得
        $categories = Category::all();

        // 名古屋駅の座標（仮の値）
        $nagoyaStationLat = 35.170915;
        $nagoyaStationLng = 136.881637;

        // 名古屋駅からの距離の処理
        foreach ($shops as $shop) {

            // 店舗の座標
            $shopLat = $shop->latitude;
            $shopLng = $shop->longitude;

            // ヒュベニの公式を使用して距離を計算（要らないかも？）
            $distance = $this->haversine($nagoyaStationLat, $nagoyaStationLng, $shopLat, $shopLng);

            // キャッシュから距離を取得
            $distance = Cache::get("distance_{$shop->id}");

            // キャッシュに距離が存在しない場合は計算
            if ($distance === null) {
                $distance = $this->haversine($nagoyaStationLat, $nagoyaStationLng, $shopLat, $shopLng);
                // 距離をキャッシュに保存
                Cache::put("distance_{$shop->id}", $distance, 60 * 24); // 24時間保存
            }

            // 距離を更新
            $shop->distance = $distance;
            $shop->save(); // データベースに保存
        }

        // カテゴリー選択とキーワード検索
        $keyword = $request->keyword;
        $query = Shops::query();

        if ($request->category !== null) {
            $query->where('category_id', $request->category);
            $category = Category::find($request->category);
        } elseif ($keyword !== null) {
            $query->where('name', 'like', "%{$keyword}%");
            $category = null;
        } else {
            $category = null;
        }

        // ソート機能
        $sort = $request->input('sort');
        $direction = $request->input('direction', 'asc');

        if ($sort === 'score') {
            $reviews = Review::orderByDesc('score')->get();
            $shopIds = $reviews->pluck('shops_id')->unique();
            $query->whereIn('id', $shopIds);
            $query->orderByRaw('(SELECT SUM(score) FROM reviews WHERE reviews.shops_id = shops.id) ' . $direction);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $direction);
        } elseif ($sort === 'avg_price_low') {
            $query->orderBy('avg_price_low', 'asc');
        } elseif ($sort === 'avg_price_high') {
            $query->orderBy('avg_price_high', 'desc');
        } else {
            $query->orderBy('id', 'asc');
        }

        $shops = $query->paginate(7);
        $total_count = $shops->total();

        return response(view('shops.index', compact('shops', 'category', 'categories', 'total_count', 'keyword', 'distance')));
    }

    private function haversine($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // 地球の半径（km）

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance; // 距離（km）
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return response(view('shops.create', compact('shops', 'categories')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $shops = new Shops();
        $shops->name = $request->input('name');
        $shops->category_id = $request->input('category_id');
        $shops->avg_price_low = $request->input('avg_price_low');
        $shops->avg_price_high = $request->input('avg_price_high');
        $shops->description = $request->input('description');
        $shops->open_time = $request->input('open_time');
        $shops->close_time = $request->input('close_time');
        $shops->holiday = $request->input('holiday');
        $shops->address = $request->input('address');
        $shops->tel = $request->input('tel');
        $shops->save();

        return redirect()->route('shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shops  $shops
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $shop = Shops::find($id);
        $reviews = $shop->reviews()->paginate(3);
        $reservations = $shop->reservations;

        // $startTime = Carbon::createFromFormat('H:i:s', $shop->open_time)->format('H:i');
        // $endTime = Carbon::createFromFormat('H:i:s', $shop->close_time)->format('H:i');
        $startTime = substr($shop->open_time, 0, 2) . ':00'; // 例: "18:05:11" -> "18:00"
        $endTime = substr($shop->close_time, 0, 2) . ':00'; // 例: "01:33:54" -> "01:00"

        $holidayId = ConnectHoliday::where('shops_id', $id)->pluck('holidays_id');
        $weekdays = Holiday::whereIn('id', $holidayId)->pluck('day');

        return response(view('shops.show', compact('shop', 'reviews', 'reservations', 'startTime', 'endTime', 'holidayId', 'weekdays')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shops  $shops
     * @return \Illuminate\Http\Response
     */
    public function edit(Shops $shop)
    {
        $categories = Category::all();

        return response(view('shops.edit', compact('shop', 'categories')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shops  $shops
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shops $shop)
    {
        $shop->name = $request->input('name');
        $shop->category_id = $request->input('category_id');
        $shop->avg_price_low = $request->input('avg_price_low');
        $shop->avg_price_high = $request->input('avg_price_high');
        $shop->description = $request->input('description');
        $shop->open_time = $request->input('open_time');
        $shop->close_time = $request->input('close_time');
        $shop->holiday = $request->input('holiday');
        $shop->address = $request->input('address');
        $shop->tel = $request->input('tel');
        $shop->save();

        return redirect()->route('shops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shops  $shops
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shops $shop)
    {
        $shop->delete();

        return redirect()->route('shops.index');
    }
}
