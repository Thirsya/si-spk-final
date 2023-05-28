<?php

namespace Database\Seeders;

use App\Models\JumlahNormalisasiEntropy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JumlahNormalisasiEntropySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JumlahNormalisasiEntropy::create([
            'hitung_id' => 1,
            'jumlah_kriteria_1' => 2.5,
            'jumlah_kriteria_2' => 3.8,
            'jumlah_kriteria_3' => 4.2,
            'jumlah_kriteria_4' => 1.9,
            'jumlah_kriteria_5' => 3.6,
            'jumlah_kriteria_6' => 2.1,
            'jumlah_kriteria_7' => 4.7,
            'jumlah_kriteria_8' => 3.3,
            'jumlah_kriteria_9' => 2.8,
            'jumlah_kriteria_10' => 3.9,
        ]);
    }
}
