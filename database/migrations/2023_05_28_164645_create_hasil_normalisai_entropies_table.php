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
        Schema::create('hasil_normalisai_entropy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perhitungan');
            $table->float('nilai_normalisasi_kriteria_1');
            $table->float('nilai_normalisasi_kriteria_2');
            $table->float('nilai_normalisasi_kriteria_3');
            $table->float('nilai_normalisasi_kriteria_4');
            $table->float('nilai_normalisasi_kriteria_5');
            $table->float('nilai_normalisasi_kriteria_6');
            $table->float('nilai_normalisasi_kriteria_7');
            $table->float('nilai_normalisasi_kriteria_8');
            $table->float('nilai_normalisasi_kriteria_9');
            $table->float('nilai_normalisasi_kriteria_10');

            $table->foreign('id_perhitungan')->references('id')->on('perhitungan');
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
        Schema::dropIfExists('hasil_normalisai_entropy');
    }
};
