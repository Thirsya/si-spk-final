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
            $table->double('nilai_normalisasi_Ranking_Kelas')->nullable();
            $table->double('nilai_normalisasi_Disiplin')->nullable();
            $table->double('nilai_normalisasi_Kemampuan_Bahasa_Asing')->nullable();
            $table->double('nilai_normalisasi_Hafalan_Rumus_Periodik')->nullable();
            $table->double('nilai_normalisasi_Teliti_Unsur_Kimia')->nullable();
            $table->double('nilai_normalisasi_Riwayat_Sanksi')->nullable();
            $table->double('nilai_normalisasi_Umur')->nullable();
            $table->double('nilai_normalisasi_Sering_Terlambat')->nullable();
            $table->double('nilai_normalisasi_Jumlah_Alpha')->nullable();
            $table->double('nilai_normalisasi_Presentasi_Kekalahan')->nullable();

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