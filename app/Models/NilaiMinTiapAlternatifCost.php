<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMinTiapAlternatifCost extends Model
{
    protected $table = 'nilai_min_tiap_alternatif_cost';

    protected $fillable = [
        'id_perhitungan',
        'min_jarak_dengan_pusat_kota',
        'min_harga',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
