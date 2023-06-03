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
            'nilai_e_kriteria_Ranking_Kelas' => 2.5,
            'nilai_e_kriteria_Disiplin' => 3.8,
            'nilai_e_kriteria_Kemampuan_Bahasa_Asing' => 4.2,
            'nilai_e_kriteria_Hafalan_Rumus_Periodik' => 1.9,
            'nilai_e_kriteria_Teliti_Unsur_Kimia' => 3.6,
            'nilai_e_kriteria_Riwayat_Sanksi' => 2.1,
            'nilai_e_kriteria_Umur' => 4.7,
            'nilai_e_kriteria_Sering_Terlambat' => 3.3,
            'nilai_e_kriteria_Jumlah_Alpha' => 2.8,
            'nilai_e_kriteria_Presentasi_Kekalahan' => 3.9,
        ]);
    }
}
