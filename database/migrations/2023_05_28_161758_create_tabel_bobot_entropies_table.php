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
        Schema::create('tabel_bobot_entropies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hitung_id')->nullable();
            $table->double('bobot_entropy_aksesbilitas')->nullable();
            $table->double('bobot_entropy_keamanan')->nullable();
            $table->double('bobot_entropy_kenyamanan')->nullable();
            $table->double('bobot_entropy_luas_bangunan')->nullable();
            $table->double('bobot_entropy_luas_parkir')->nullable();
            $table->double('bobot_entropy_keramaian')->nullable();
            $table->double('bobot_entropy_kebersihan')->nullable();
            $table->double('bobot_entropy_fasilitas')->nullable();
            $table->double('bobot_entropy_jarak_dengan_pusat_kota')->nullable();
            $table->double('bobot_entropy_harga')->nullable();
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
        Schema::dropIfExists('tabel_bobot_entropies');
    }
};
