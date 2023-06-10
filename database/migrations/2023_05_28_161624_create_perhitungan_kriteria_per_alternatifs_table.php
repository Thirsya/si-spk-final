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
            $table->string('nama_restoran');
            $table->double('aksesbilitas');
            $table->double('keamanan');
            $table->double('kenyamanan');
            $table->double('luas_bangunan');
            $table->double('luas_parkir');
            $table->double('keramaian');
            $table->double('kebersihan');
            $table->double('fasilitas');
            $table->double('jarak_dengan_pusat_kota');
            $table->double('harga');


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
