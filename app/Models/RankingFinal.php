<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingFinal extends Model
{
    protected $table = 'ranking_finals';

    protected $fillable = [
        'id_perhitungan',
        'nama_restoran',
        'max_optimasi',
        'min_optimasi',
        'pengurangan_maxmin',
        'ranking',
    ];

    public function perhitungan()
    {
        return $this->belongsTo(Perhitungan::class, 'id_perhitungan');
    }
}