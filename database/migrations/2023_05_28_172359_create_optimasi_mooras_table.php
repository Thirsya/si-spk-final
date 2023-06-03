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
        Schema::create('optimasi_moora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perhitungan');
            $table->string('nama_siswa');
            $table->double('nilai_kriteria_Ranking_Kelas');
            $table->double('nilai_kriteria_Disiplin');
            $table->double('nilai_kriteria_Kemampuan_Bahasa_Asing');
            $table->double('nilai_kriteria_Hafalan_Rumus_Periodik');
            $table->double('nilai_kriteria_Teliti_Unsur_Kimia');
            $table->double('nilai_kriteria_Riwayat_Sanksi');
            $table->double('nilai_kriteria_Umur');
            $table->double('nilai_kriteria_Sering_Terlambat');
            $table->double('nilai_kriteria_Jumlah_Alpha');
            $table->double('nilai_kriteria_Presentasi_Kekalahan');

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
        Schema::dropIfExists('optimasi_moora');
    }
};
