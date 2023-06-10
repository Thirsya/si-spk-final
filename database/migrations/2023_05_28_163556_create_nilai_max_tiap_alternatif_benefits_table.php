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
        Schema::create('nilai_max_tiap_alternatif_benefit', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_perhitungan');
        $table->double('max_aksesbilitas');
        $table->double('max_keamanan');
        $table->double('max_kenyamanan');
        $table->double('max_luas_bangunan');
        $table->double('max_luas_parkir');
        $table->double('max_keramaian');
        $table->double('max_kebersihan');
        $table->double('max_fasilitas');

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
        Schema::dropIfExists('nilai_max_tiap_alternatif');
    }
};
