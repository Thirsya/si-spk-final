<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerhitunganKriteriaPerAlternatif;
use App\Models\NilaiMaxTiapAlternatifBenefit;
use App\Models\NilaiMinTiapAlternatifCost;
use App\Models\NormalisaiMoora;
use App\Models\OptimasiMoora;
use App\Models\Perhitungan;
use App\Models\TabelBobotEntropy;
use App\Models\TabelHistory;
use App\Models\TabelTotalNilaiEntropy;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ApiHistoryController extends Controller
{
    public function index()
    {
        $tabelHistories = TabelHistory::all();

        return response()->json($tabelHistories);
    }

    public function show($idPerhitungan)
    {
        $tabelHistory = TabelHistory::find($idPerhitungan);

        if ($tabelHistory) {
            return response()->json($tabelHistory);
        } else {
            return response()->json(['message' => 'TabelHistory not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
