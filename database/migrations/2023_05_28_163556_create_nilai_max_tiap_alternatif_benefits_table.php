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
        $table->double('max_Ranking_Kelas');
        $table->double('max_Disiplin');
        $table->double('max_Kemampuan_Bahasa_Asing');
        $table->double('max_Hafalan_Rumus_Periodik');
        $table->double('max_Teliti_Unsur_Kimia');

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
