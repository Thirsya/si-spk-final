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
            $table->double('jumlah_normalisasi_Ranking_Kelas')->nullable();
            $table->double('jumlah_normalisasi_Disiplin')->nullable();
            $table->double('jumlah_normalisasi_Kemampuan_Bahasa_Asing')->nullable();
            $table->double('jumlah_normalisasi_Hafalan_Rumus_Periodik')->nullable();
            $table->double('jumlah_normalisasi_Teliti_Unsur_Kimia')->nullable();
            $table->double('jumlah_normalisasi_Riwayat_Sanksi')->nullable();
            $table->double('jumlah_normalisasi_Umur')->nullable();
            $table->double('jumlah_normalisasi_Sering_Terlambat')->nullable();
            $table->double('jumlah_normalisasi_Jumlah_Alpha')->nullable();
            $table->double('jumlah_normalisasi_Presentasi_Kekalahan')->nullable();
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
