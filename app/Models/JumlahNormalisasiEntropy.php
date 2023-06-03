<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JumlahNormalisasiEntropy extends Model
{
    protected $table = 'jumlah_normalisasi_entropies'; // Ganti 'nama_tabel' dengan nama tabel yang sesuai

    protected $fillable = [
        'hitung_id',
        'jumlah_normalisasi_Ranking_Kelas',
        'jumlah_normalisasi_Disiplin',
        'jumlah_normalisasi_Kemampuan_Bahasa_Asing',
        'jumlah_normalisasi_Hafalan_Rumus_Periodik',
        'jumlah_normalisasi_Teliti_Unsur_Kimia',
        'jumlah_normalisasi_Riwayat_Sanksi',
        'jumlah_normalisasi_Umur',
        'jumlah_normalisasi_Sering_Terlambat',
        'jumlah_normalisasi_Jumlah_Alpha',
        'jumlah_normalisasi_Presentasi_Kekalahan',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}
