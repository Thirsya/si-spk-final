<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PerhitunganKriteriaPerAlternatif;

class PerhitunganKriteriaPerAlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PerhitunganKriteriaPerAlternatif::create([
            'id_perhitungan' => 1,
            'nama_siswa' => 'John Doe',
            'nilai_kriteria_1' => 8.1,
            'nilai_kriteria_2' => 8.2,
            'nilai_kriteria_3' => 8.3,
            'nilai_kriteria_4' => 8.4,
            'nilai_kriteria_5' => 8.5,
            'nilai_kriteria_6' => 8.6,
            'nilai_kriteria_7' => 8.7,
            'nilai_kriteria_8' => 8.8,
            'nilai_kriteria_9' => 8.8,
            'nilai_kriteria_10' => 8.9,

        ]);

        PerhitunganKriteriaPerAlternatif::create([
            'id_perhitungan' => 2,
            'nama_siswa' => 'Jane Smith',
            'nilai_kriteria_1' => 7.0,
            'nilai_kriteria_1' => 7.0,
            'nilai_kriteria_2' => 7.0,
            'nilai_kriteria_3' => 7.0,
            'nilai_kriteria_4' => 7.0,
            'nilai_kriteria_5' => 7.0,
            'nilai_kriteria_6' => 7.0,
            'nilai_kriteria_7' => 7.0,
            'nilai_kriteria_8' => 7.0,
            'nilai_kriteria_9' => 7.0,
            'nilai_kriteria_10' => 7.0,
        ]);
    }
}
