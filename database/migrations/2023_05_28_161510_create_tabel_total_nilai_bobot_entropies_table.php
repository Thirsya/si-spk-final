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
        Schema::create('tabel_total_nilai_bobot_entropies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hitung_id')->nullable();
            $table->double('total_nilai_bobot_entropy_Ranking_Kelas')->nullable();
            $table->double('total_nilai_bobot_entropy_Disiplin')->nullable();
            $table->double('total_nilai_bobot_entropy_Kemampuan_Bahasa_Asing')->nullable();
            $table->double('total_nilai_bobot_entropy_Hafalan_Rumus_Periodik')->nullable();
            $table->double('total_nilai_bobot_entropy_Teliti_Unsur_Kimia')->nullable();
            $table->double('total_nilai_bobot_entropy_Riwayat_Sanksi')->nullable();
            $table->double('total_nilai_bobot_entropy_Umur')->nullable();
            $table->double('total_nilai_bobot_entropy_Sering_Terlambat')->nullable();
            $table->double('total_nilai_bobot_entropy_Jumlah_Alpha')->nullable();
            $table->double('total_nilai_bobot_entropy_Presentasi_Kekalahan')->nullable();
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
        Schema::dropIfExists('tabel_total_nilai_entropies');
    }
};
