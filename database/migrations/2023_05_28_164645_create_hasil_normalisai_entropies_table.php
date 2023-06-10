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
        Schema::create('hasil_normalisasi_entropy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perhitungan')->nullable();
            $table->double('nilai_normalisasi_aksesbilitas')->nullable();
            $table->double('nilai_normalisasi_keamanan')->nullable();
            $table->double('nilai_normalisasi_kenyamanan')->nullable();
            $table->double('nilai_normalisasi_luas_bangunan')->nullable();
            $table->double('nilai_normalisasi_luas_parkir')->nullable();
            $table->double('nilai_normalisasi_keramaian')->nullable();
            $table->double('nilai_normalisasi_kebersihan')->nullable();
            $table->double('nilai_normalisasi_fasilitas')->nullable();
            $table->double('nilai_normalisasi_jarak_dengan_pusat_kota')->nullable();
            $table->double('nilai_normalisasi_harga')->nullable();

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
