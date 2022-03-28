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
        Schema::create('promo_school', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('promo_id');
            $table->unsignedBigInteger('school_id');

            $table->foreign('promo_id')->references('id')->on('promos')->cascadeOnDelete();
            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_school');
    }
};
