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
        Schema::create('nilai_max_tiap_alternatif_cost', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_perhitungan');
        $table->double('max_Riwayat_Sanksi');
        $table->double('max_Umur');
        $table->double('max_Sering_Terlambat');
        $table->double('max_Jumlah_Alpha');
        $table->double('max_Presentasi_Kekalahan');

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
