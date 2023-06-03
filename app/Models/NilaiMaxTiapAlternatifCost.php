<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMaxTiapAlternatifCost extends Model
{
    protected $table = 'nilai_max_tiap_alternatif_benefit';

    protected $fillable = [
        'id_perhitungan',
        'max_Riwayat_Sanksi',
        'max_Umur',
        'max_Sering_Terlambat',
        'max_Jumlah_Alpha',
        'max_Presentasi_Kekalahan',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
