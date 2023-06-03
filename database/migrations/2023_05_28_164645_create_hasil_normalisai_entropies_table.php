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
            $table->double('nilai_normalisasi_Ranking_Kelas');
            $table->double('nilai_normalisasi_Disiplin');
            $table->double('nilai_normalisasi_Kemampuan_Bahasa_Asing');
            $table->double('nilai_normalisasi_Hafalan_Rumus_Periodik');
            $table->double('nilai_normalisasi_Teliti_Unsur_Kimia');
            $table->double('nilai_normalisasi_Riwayat_Sanksi');
            $table->double('nilai_normalisasi_Umur');
            $table->double('nilai_normalisasi_Sering_Terlambat');
            $table->double('nilai_normalisasi_Jumlah_Alpha');
            $table->double('nilai_normalisasi_Presentasi_Kekalahan');

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
