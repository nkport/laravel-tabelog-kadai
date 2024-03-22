<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connect_holiday', function (Blueprint $table) { // テーブルを作成するための定義
            $table->id();
            $table->foreignId('shops_id')->constrained()->cascadeOnDelete(); // 他の関連レコードも自動的に削除
            $table->foreignId('holidays_id')->constrained()->cascadeOnDelete(); // 他の関連レコードも自動的に削除
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
        Schema::dropIfExists('connect_holiday');
    }
};
