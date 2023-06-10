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
            $table->unsignedBigInteger('id_perhitungan')->nullable();
            $table->double('jumlah_normalisasi_aksesbilitas')->nullable();
            $table->double('jumlah_normalisasi_keamanan')->nullable();
            $table->double('jumlah_normalisasi_kenyamanan')->nullable();
            $table->double('jumlah_normalisasi_luas_bangunan')->nullable();
            $table->double('jumlah_normalisasi_luas_parkir')->nullable();
            $table->double('jumlah_normalisasi_keramaian')->nullable();
            $table->double('jumlah_normalisasi_kebersihan')->nullable();
            $table->double('jumlah_normalisasi_fasilitas')->nullable();
            $table->double('jumlah_normalisasi_jarak_dengan_pusat_kota')->nullable();
            $table->double('jumlah_normalisasi_harga')->nullable();

            $table->foreign('id_perhitungan')->references('id')->on('perhitungan')->restrictOnDelete();
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
