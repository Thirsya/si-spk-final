<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiMaxTiapAlternatif extends Model
{
    protected $table = 'nilai_max_tiap_alternatif';

    protected $fillable = [
        'id_perhitungan',
        'max_kriteria_1',
        'max_kriteria_2',
        'max_kriteria_3',
        'max_kriteria_4',
        'max_kriteria_5',
        'max_kriteria_6',
        'max_kriteria_7',
        'max_kriteria_8',
        'max_kriteria_9',
        'max_kriteria_10',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}
