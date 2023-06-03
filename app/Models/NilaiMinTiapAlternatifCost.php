<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMinTiapAlternatifCost extends Model
{
    protected $table = 'nilai_min_tiap_alternatif_cost';

    protected $fillable = [
        'id_perhitungan',
        'min_Riwayat_Sanksi',
        'min_Umur',
        'min_Sering_Terlambat',
        'min_Jumlah_Alpha',
        'min_Presentasi_Kekalahan',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
