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
            'nilai_kriteria_1' => 'required|numeric',
            'nilai_kriteria_2' => 'required|numeric',
            'nilai_kriteria_3' => 'required|numeric',
            'nilai_kriteria_4' => 'required|numeric',
            'nilai_kriteria_5' => 'required|numeric',
            'nilai_kriteria_6' => 'required|numeric',
            'nilai_kriteria_7' => 'required|numeric',
            'nilai_kriteria_8' => 'required|numeric',
            'nilai_kriteria_9' => 'required|numeric',
            'nilai_kriteria_10' => 'required|numeric',
        ]);

        $perhitunganKriteriaPerAlternatif = PerhitunganKriteriaPerAlternatif::create($data);

        return response()->json($perhitunganKriteriaPerAlternatif, 201);
    }
}