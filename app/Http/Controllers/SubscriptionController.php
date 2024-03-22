<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function create()
    {
        // ユーザーのSetupIntentオブジェクトを作成
        $intent = Auth::user()->createSetupIntent();

        // ビューに変数を渡す
        return view('subscription.create', compact('intent'));
    }

    public function store(Request $request)
    {
        // サブスクリプションを作成
        $request->user()->newSubscription('premium_plan', 'price_1OuqZtCqDLjiACIRFVI82AZC')->create($request->paymentMethodId);

        // Userモデルを取得してroleカラムを更新
        $user = Auth::user();
        $user->role = 'premium';
        $user->save();

        // フラッシュメッセージ
        $request->session()->flash('flash_message', '有料プランへの登録が完了しました。');

        // 決済後に飛ぶビュー
        return redirect()->route('profile.index');
    }

    public function edit()
    {
        // 現在ログイン中のユーザーのIDを取得
        $userId = Auth::id();

        // ユーザーテーブルからログイン中のユーザーの全てのデータを取得
        $user = User::findOrFail($userId);

        // ユーザーのSetupIntentオブジェクトを作成
        $intent = $user->createSetupIntent();

        // ビューに変数を渡す
        return view('subscription.edit', compact('user', 'intent'));
    }

    public function update(Request $request)
    {
        // デフォルトの支払い方法を更新
        $request->user()->updateDefaultPaymentMethod($request->paymentMethodId);

        // フラッシュメッセージをセッションに保存
        $request->session()->flash('flash_message', 'カード情報を変更しました。');

        // 更新後に飛ぶビュー
        return redirect()->route('profile.index');
    }

    public function cancel()
    {
        // 有料プラン解約ページを表示
        return view('subscription.cancel');
    }

    public function destroy(Request $request)
    {
        // デフォルトの支払い方法を更新
        $request->user()->subscription('premium_plan')->cancelNow();

        // Userモデルを取得してroleカラムを更新
        $user = Auth::user();
        $user->role = 'general';
        $user->save();

        // フラッシュメッセージをセッションに保存
        $request->session()->flash('flash_message', '有料会員を解約しました。');

        // 更新後に飛ぶビュー
        return redirect()->route('profile.index');
    }

}
