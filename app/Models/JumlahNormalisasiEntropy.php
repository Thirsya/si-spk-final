<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JumlahNormalisasiEntropy extends Model
{
    protected $table = 'jumlah_normalisasi_entropies'; // Ganti 'nama_tabel' dengan nama tabel yang sesuai

    protected $fillable = [
        'id_perhitungan',
        'jumlah_normalisasi_aksesbilitas',
        'jumlah_normalisasi_keamanan',
        'jumlah_normalisasi_kenyamanan',
        'jumlah_normalisasi_luas_bangunan',
        'jumlah_normalisasi_luas_parkir',
        'jumlah_normalisasi_keramaian',
        'jumlah_normalisasi_kebersihan',
        'jumlah_normalisasi_fasilitas',
        'jumlah_normalisasi_jarak_dengan_pusat_kota',
        'jumlah_normalisasi_harga',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'hitung_id');
    }
}
