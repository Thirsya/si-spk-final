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
        Schema::create('tabel_total_nilai_entropies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hitung_id')->nullable();
            $table->double('total_nilai_entropy')->nullable();
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
