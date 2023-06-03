<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMaxTiapAlternatif extends Model
{
    protected $table = 'nilai_max_tiap_alternatif_benefit';

    protected $fillable = [
        'id_perhitungan',
        'max_Ranking_Kelas',
        'max_Disiplin',
        'max_Kemampuan_Bahasa_Asing',
        'max_Hafalan_Rumus_Periodik',
        'max_Teliti_Unsur_Kimia',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
