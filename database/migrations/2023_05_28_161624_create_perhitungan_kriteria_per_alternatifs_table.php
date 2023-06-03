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
            $table->double('Ranking_Kelas');
            $table->double('Disiplin');
            $table->double('Kemampuan_Bahasa_Asing');
            $table->double('Hafalan_Rumus_Periodik');
            $table->double('Teliti_Unsur_Kimia');
            $table->double('Riwayat_Sanksi');
            $table->double('Umur');
            $table->double('Sering_Terlambat');
            $table->double('Jumlah_Alpha');
            $table->double('Presentasi_Kekalahan');


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
