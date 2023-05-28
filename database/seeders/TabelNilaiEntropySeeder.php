<?php

namespace Database\Seeders;

use App\Models\TabelNilaiEntropy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TabelNilaiEntropySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TabelNilaiEntropy::create([
            'hitung_id' => 1,
            'nilai_e_kriteria_1' => 2.5,
            'nilai_e_kriteria_2' => 3.8,
            'nilai_e_kriteria_3' => 4.2,
            'nilai_e_kriteria_4' => 1.9,
            'nilai_e_kriteria_5' => 3.6,
            'nilai_e_kriteria_6' => 2.1,
            'nilai_e_kriteria_7' => 4.7,
            'nilai_e_kriteria_8' => 3.3,
            'nilai_e_kriteria_9' => 2.8,
            'nilai_e_kriteria_10' => 3.9,
        ]);
    }
}
