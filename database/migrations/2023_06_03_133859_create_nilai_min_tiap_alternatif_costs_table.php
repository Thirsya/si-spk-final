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
        Schema::create('nilai_min_tiap_alternatif_cost', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_perhitungan');
        $table->double('min_Riwayat_Sanksi');
        $table->double('min_Umur');
        $table->double('min_Sering_Terlambat');
        $table->double('min_Jumlah_Alpha');
        $table->double('min_Presentasi_Kekalahan');

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
        Schema::dropIfExists('nilai_max_tiap_alternatif_cost');
    }
};
