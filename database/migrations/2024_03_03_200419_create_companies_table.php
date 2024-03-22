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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->timestamp('establishment_date');
            $table->string('address');
            $table->string('capital');
            $table->string('representative');
            $table->text('description');
            $table->text('suppliers')->nullable();
            $table->text('suppliers_bank')->nullable();
            $table->text('history');
            $table->string('contact');
            $table->string('tel');
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
        Schema::dropIfExists('companies');
    }
};
