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
        Schema::create('normalisasi_moora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perhitungan');
            $table->double('nilai_normalisasi_moora_aksesbilitas');
            $table->double('nilai_normalisasi_moora_keamanan');
            $table->double('nilai_normalisasi_moora_kenyamanan');
            $table->double('nilai_normalisasi_moora_luas_bangunan');
            $table->double('nilai_normalisasi_moora_luas_parkir');
            $table->double('nilai_normalisasi_moora_keramaian');
            $table->double('nilai_normalisasi_moora_kebersihan');
            $table->double('nilai_normalisasi_moora_fasilitas');
            $table->double('nilai_normalisasi_moora_jarak_dengan_pusat_kota');
            $table->double('nilai_normalisasi_moora_harga');

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
        Schema::dropIfExists('normalisai_moora');
    }
};
