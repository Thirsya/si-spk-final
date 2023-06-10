<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NilaiMaxTiapAlternatifBenefit;


class MaxBenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NilaiMaxTiapAlternatifBenefit::create([
            'id_perhitungan' => 1,
            'max_Ranking_Kelas' => 5.0,
            'max_Disiplin' => 3.0,
            'max_Kemampuan_Bahasa_Asing' => 2.2,
            'max_Hafalan_Rumus_Periodik' => 2.4,
            'max_Teliti_Unsur_Kimia' => 1.2,

        ]);

        NilaiMaxTiapAlternatifBenefit::create([
            'id_perhitungan' => 2,
            'max_Ranking_Kelas' => 5.0,
            'max_Disiplin' => 3.0,
            'max_Kemampuan_Bahasa_Asing' => 2.2,
            'max_Hafalan_Rumus_Periodik' => 2.4,
            'max_Teliti_Unsur_Kimia' => 1.2,
        ]);
    }
}
