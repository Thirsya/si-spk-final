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
        Schema::create('perhitungan_kriteria_per_alternatif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perhitungan');
            $table->string('nama_siswa');
            $table->double('nilai_kriteria_1');
            $table->double('nilai_kriteria_2');
            $table->double('nilai_kriteria_3');
            $table->double('nilai_kriteria_4');
            $table->double('nilai_kriteria_5');
            $table->double('nilai_kriteria_6');
            $table->double('nilai_kriteria_7');
            $table->double('nilai_kriteria_8');
            $table->double('nilai_kriteria_9');
            $table->double('nilai_kriteria_10');


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
        Schema::dropIfExists('perhitungan_kriteria_per_alternatif');
    }
};
