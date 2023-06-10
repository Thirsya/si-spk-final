<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhitunganKriteriaPerAlternatif extends Model
{
    protected $table = 'perhitungan_kriteria_per_alternatif';

    protected $fillable = [
        'id_perhitungan',
        'nama_restoran',
        'aksesbilitas',
        'keamanan',
        'kenyamanan',
        'luas_bangunan',
        'luas_parkir',
        'keramaian',
        'kebersihan',
        'fasilitas',
        'jarak_dengan_pusat_kota',
        'harga',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
