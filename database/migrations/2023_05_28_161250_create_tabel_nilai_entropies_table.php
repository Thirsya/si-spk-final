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
            $table->unsignedBigInteger('hitung_id')->nullable();
            $table->double('nilai_e_kriteria_Ranking_Kelas')->nullable();
            $table->double('nilai_e_kriteria_Disiplin')->nullable();
            $table->double('nilai_e_kriteria_Kemampuan_Bahasa_Asing')->nullable();
            $table->double('nilai_e_kriteria_Hafalan_Rumus_Periodik')->nullable();
            $table->double('nilai_e_kriteria_Teliti_Unsur_Kimia')->nullable();
            $table->double('nilai_e_kriteria_Riwayat_Sanksi')->nullable();
            $table->double('nilai_e_kriteria_Umur')->nullable();
            $table->double('nilai_e_kriteria_Sering_Terlambat')->nullable();
            $table->double('nilai_e_kriteria_Jumlah_Alpha')->nullable();
            $table->double('nilai_e_kriteria_Presentasi_Kekalahan')->nullable();
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
        Schema::dropIfExists('tabel_nilai_entropies');
    }
};
