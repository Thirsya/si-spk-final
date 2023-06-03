<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhitunganKriteriaPerAlternatif extends Model
{
    protected $table = 'perhitungan_kriteria_per_alternatif';

    protected $fillable = [
        'id_perhitungan',
        'nama_siswa',
        'Ranking_Kelas',
        'Disiplin',
        'Kemampuan_Bahasa_Asing',
        'Hafalan_Rumus_Periodik',
        'Teliti_Unsur_Kimia',
        'Riwayat_Sanksi',
        'Umur',
        'Sering_Terlambat',
        'Jumlah_Alpha',
        'Presentasi_Kekalahan',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
