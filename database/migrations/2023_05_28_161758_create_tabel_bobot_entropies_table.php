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
        Schema::create('tabel_bobot_entropies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hitung_id')->nullable();
            $table->double('bobot_entropy_1')->nullable();
            $table->double('bobot_entropy_2')->nullable();
            $table->double('bobot_entropy_3')->nullable();
            $table->double('bobot_entropy_4')->nullable();
            $table->double('bobot_entropy_5')->nullable();
            $table->double('bobot_entropy_6')->nullable();
            $table->double('bobot_entropy_7')->nullable();
            $table->double('bobot_entropy_8')->nullable();
            $table->double('bobot_entropy_9')->nullable();
            $table->double('bobot_entropy_10')->nullable();
            $table->foreign('hitung_id')->references('id')->on('perhitungan')->restrictOnDelete();
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
        Schema::dropIfExists('tabel_bobot_entropies');
    }
};
