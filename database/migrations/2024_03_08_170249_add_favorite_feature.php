<?php

use Illuminate\Database\Migrations\Migration; // Migration クラスを使用するために必要な名前空間をインポート
use Illuminate\Database\Schema\Blueprint; // Blueprint クラスを使用するための名前空間をインポート
use Illuminate\Support\Facades\Schema; // Schema クラスを使用するための名前空間をインポート ※Schema クラスは、データベーススキーマの操作を行うために使用される。

return new class extends Migration { // 無名クラスを作成、Migration クラスを拡張し、データベースのマイグレーションを定義している。
    /**
     * Run the migrations.
     *
     * @return void
     */
    // ↓ マイグレーションを実行する際に呼び出されるメソッドでfavorites テーブルを作成の意味。
    public function up()
    {
        Schema::create('shops_user', function (Blueprint $table) { // テーブルを作成するための定義
            $table->id();
            // shop_id という名前の外部キーをテーブルに追加→外部キーを制約→shopsテーブルのレコードが削除された場合、shop_user テーブルの関連レコードも自動的に削除
            $table->foreignId('shops_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops_user');
    }
};