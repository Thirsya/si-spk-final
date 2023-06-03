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
        Schema::create('tabel_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perhitungan');
            $table->unsignedBigInteger('id_kriteria_per_alternatif');
            $table->unsignedBigInteger('id_nilai_max_benefit');
            $table->unsignedBigInteger('id_nilai_min_cost');
            $table->unsignedBigInteger('id_hasil_normalisasi_entropy');
            $table->unsignedBigInteger('id_jumlah_normalisasi_entropy');
            $table->unsignedBigInteger('id_nilai_entropy_e');
            $table->unsignedBigInteger('id_total_nilai_entropy');
            $table->unsignedBigInteger('id_bobot_entropy');
            $table->unsignedBigInteger('id_normalisasi_moora');
            $table->unsignedBigInteger('id_optimasi_moora');



            $table->foreign('id_perhitungan')->references('id')->on('perhitungan')->restrictOnDelete();
            $table->foreign('id_kriteria_per_alternatif')->references('id')->on('perhitungan_kriteria_per_alternatif')->restrictOnDelete();
            $table->foreign('id_nilai_max_benefit')->references('id')->on('nilai_max_tiap_alternatif_benefit')->restrictOnDelete();
            $table->foreign('id_nilai_min_cost')->references('id')->on('nilai_min_tiap_alternatif_cost')->restrictOnDelete();
            $table->foreign('id_hasil_normalisasi_entropy')->references('id')->on('hasil_normalisasi_entropy')->restrictOnDelete();
            $table->foreign('id_jumlah_normalisasi_entropy')->references('id')->on('jumlah_normalisasi_entropies')->restrictOnDelete();
            $table->foreign('id_nilai_entropy_e')->references('id')->on('tabel_nilai_entropies')->restrictOnDelete();
            $table->foreign('id_total_nilai_entropy')->references('id')->on('tabel_total_nilai_bobot_entropies')->restrictOnDelete();
            $table->foreign('id_bobot_entropy')->references('id')->on('tabel_bobot_entropies')->restrictOnDelete();
            $table->foreign('id_normalisasi_moora')->references('id')->on('normalisasi_moora')->restrictOnDelete();
            $table->foreign('id_optimasi_moora')->references('id')->on('optimasi_moora')->restrictOnDelete();
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
        Schema::dropIfExists('tabel_histories');
    }
};
