<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\TermsOfServiceController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\IndexHomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 「/」を指定した時に「resources\views\index.blade.php」へ飛ぶ
// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [IndexHomeController::class, 'index'])->name('index');

// プロフィール編集周り
Route::middleware('auth')->group(function () {
    Route::get('/shops', function () {
        return view('shops');
    })->name('shops');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 有料会員
Route::get('/premium-content', function () { // HTTP GET リクエストが /premium-content というパスに対して行われた場合にコールバック関数（無名関数）を実行します、の意味。
    return view('profile.index'); // 「resources/views/profile/index.blade.php」に遷移します、の意味。
});
Route::middleware(['auth', 'verified', 'checkrole:premium'])->group(function () {
    Route::resource('shops', ShopsController::class);
    Route::post('favorites/{shops_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{shops_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('profile.favorite');
    Route::get('/reservation', [ReservationController::class, 'index'])->name('profile.reservation');
});

require __DIR__ . '/auth.php';

// 店舗一覧
Route::resource('shops', ShopsController::class);
Route::get('/shops', [ShopsController::class, 'index'])->name('shops');

// 会社情報
Route::get('/about', [CompanyController::class, 'show'])->name('company.show');

// プライバシーポリシー
Route::get('/policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');

// 利用規約
Route::get('/terms', [TermsOfServiceController::class, 'show'])->name('terms.show');

// NAGOYAMESHIとは？
Route::get('/introduction', [AboutController::class, 'show'])->name('about.show');

// レビュー投稿
Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

// 定休日
Route::resource('holidays', HolidayController::class);

// 予約システム
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/shops/{shop}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/shops/{shop}/reservations/create', [ReservationController::class, 'store'])->name('reservations.store');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

// サブスクリプション
Route::get('/subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
Route::post('/subscription/store', [SubscriptionController::class, 'store'])->name('subscription.store');
Route::get('/subscription/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
Route::match(['put', 'patch'], '/subscription', [SubscriptionController::class, 'update'])->name('subscription.update');
Route::get('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
Route::delete('/subscription/destroy', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');