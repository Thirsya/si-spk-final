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
        Schema::create('nilai_max_tiap_alternatif', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('id_perhitungan');
        $table->float('max_kriteria_1');
        $table->float('max_kriteria_2');
        $table->float('max_kriteria_3');
        $table->float('max_kriteria_4');
        $table->float('max_kriteria_5');
        $table->float('max_kriteria_6');
        $table->float('max_kriteria_7');
        $table->float('max_kriteria_8');
        $table->float('max_kriteria_9');
        $table->float('max_kriteria_10');

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
