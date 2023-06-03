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
            'Ranking_Kelas' => 8.1,
            'Disiplin' => 8.2,
            'Kemampuan_Bahasa_Asing' => 8.3,
            'Hafalan_Rumus_Periodik' => 8.4,
            'Teliti_Unsur_Kimia' => 8.5,
            'Riwayat_Sanksi' => 8.6,
            'Umur' => 8.7,
            'Sering_Terlambat' => 8.8,
            'Jumlah_Alpha' => 8.8,
            'Presentasi_Kekalahan' => 8.9,

        ]);

        PerhitunganKriteriaPerAlternatif::create([
            'id_perhitungan' => 2,
            'nama_siswa' => 'Jane Smith',
            'Ranking_Kelas' => 8.1,
            'Disiplin' => 8.2,
            'Kemampuan_Bahasa_Asing' => 8.3,
            'Hafalan_Rumus_Periodik' => 8.4,
            'Teliti_Unsur_Kimia' => 8.5,
            'Riwayat_Sanksi' => 8.6,
            'Umur' => 8.7,
            'Sering_Terlambat' => 8.8,
            'Jumlah_Alpha' => 8.8,
            'Presentasi_Kekalahan' => 8.9,
        ]);
    }
}
