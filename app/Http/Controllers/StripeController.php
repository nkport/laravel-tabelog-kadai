<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\View;

class StripeController extends Controller
{
    public function index()
    {
        // StripeのAPIキーをセットアップ
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Stripeから売上データを取得
        $charges = Charge::all(['limit' => 10]); // 最新の10件の売上データを取得

        // 取得したデータをビューに渡して表示
        return view('title', compact('charges'));
    }

    public function showSales()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Stripeから売上データを取得
        $charges = \Stripe\Charge::all(['limit' => 100]); // 100件の売上データを取得（取得件数を調整してください）

        // 月別に売上データを集計する
        $monthlySales = [];

        foreach ($charges->data as $charge) {
            // 通貨が日本円（JPY）であればそのまま、異なる通貨であれば日本円に変換
            $amount = ($charge->currency === 'JPY') ? $charge->amount / 1 : \Stripe\ExchangeRate::retrieve(['from' => $charge->currency, 'to' => 'JPY', 'amount' => $charge->amount])->rates[0]->mid;

            $created = date('Y-m', $charge->created);
            $monthlySales[$created] = isset ($monthlySales[$created]) ? $monthlySales[$created] + $amount : $amount;
        }

        // ビューにデータを渡す
        return View::make('admin.sales')->with('monthlySales', $monthlySales);
    }
}
