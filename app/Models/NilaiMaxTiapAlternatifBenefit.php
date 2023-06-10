<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMaxTiapAlternatifBenefit extends Model
{
    protected $table = 'nilai_max_tiap_alternatif_benefit';

    protected $fillable = [
        'id_perhitungan',
        'max_aksesbilitas',
        'max_keamanan',
        'max_kenyamanan',
        'max_luas_bangunan',
        'max_luas_parkir',
        'max_keramaian',
        'max_kebersihan',
        'max_fasilitas',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
