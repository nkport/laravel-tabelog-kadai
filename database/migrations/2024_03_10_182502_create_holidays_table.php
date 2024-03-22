<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // わからなすぎて教材を参照
        // https://terakoya.sejuku.net/practices/01HN9QGR22EBHCMECWM8RJK5NJ/
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('day')->nullable();
            $table->integer('day_index')->nullable();
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
        Schema::dropIfExists('holidays');
    }
};
