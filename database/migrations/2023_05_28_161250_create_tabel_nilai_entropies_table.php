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
        Schema::create('tabel_nilai_entropies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perhitungan')->nullable();
            $table->double('nilai_e_kriteria_aksesbilitas')->nullable();
            $table->double('nilai_e_kriteria_keamanan')->nullable();
            $table->double('nilai_e_kriteria_kenyamanan')->nullable();
            $table->double('nilai_e_kriteria_luas_bangunan')->nullable();
            $table->double('nilai_e_kriteria_luas_parkir')->nullable();
            $table->double('nilai_e_kriteria_keramaian')->nullable();
            $table->double('nilai_e_kriteria_kebersihan')->nullable();
            $table->double('nilai_e_kriteria_fasilitas')->nullable();
            $table->double('nilai_e_kriteria_jarak_dengan_pusat_kota')->nullable();
            $table->double('nilai_e_kriteria_harga')->nullable();
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
        Schema::dropIfExists('tabel_nilai_entropies');
    }
};
