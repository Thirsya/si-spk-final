<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    protected $table = 'perhitungan';

    protected $fillable = [
        'judul_perhitungan',
        'waktu_perhitungan',
    ];

}
