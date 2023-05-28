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
        Schema::create('jumlah_normalisasi_entropies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hitung_id')->nullable();
            $table->double('jumlah_kriteria_1')->nullable();
            $table->double('jumlah_kriteria_2')->nullable();
            $table->double('jumlah_kriteria_3')->nullable();
            $table->double('jumlah_kriteria_4')->nullable();
            $table->double('jumlah_kriteria_5')->nullable();
            $table->double('jumlah_kriteria_6')->nullable();
            $table->double('jumlah_kriteria_7')->nullable();
            $table->double('jumlah_kriteria_8')->nullable();
            $table->double('jumlah_kriteria_9')->nullable();
            $table->double('jumlah_kriteria_10')->nullable();
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
        Schema::dropIfExists('jumlah_normalisasi_entropies');
    }
};
