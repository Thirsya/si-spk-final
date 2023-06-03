<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PerhitunganKriteriaPerAlternatif;

class ApiPerhitunganKriteriaPerAlternatifController extends Controller
{

    public function index()
    {
        $perhitunganKriteriaPerAlternatif = PerhitunganKriteriaPerAlternatif::all();

        return response()->json($perhitunganKriteriaPerAlternatif);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_perhitungan' => 'required|exists:perhitungan,id',
            'nama_siswa' => 'required|string',
            'Ranking_Kelas' => 'required|numeric',
            'Disiplin' => 'required|numeric',
            'Kemampuan_Bahasa_Asing' => 'required|numeric',
            'Hafalan_Rumus_Periodik' => 'required|numeric',
            'Teliti_Unsur_Kimia' => 'required|numeric',
            'Riwayat_Sanksi' => 'required|numeric',
            'Umur' => 'required|numeric',
            'Sering_Terlambat' => 'required|numeric',
            'Jumlah_Alpha' => 'required|numeric',
            'Presentasi_Kekalahan' => 'required|numeric',
        ]);

        $perhitunganKriteriaPerAlternatif = PerhitunganKriteriaPerAlternatif::create($data);

        return response()->json($perhitunganKriteriaPerAlternatif, 201);
    }
}
