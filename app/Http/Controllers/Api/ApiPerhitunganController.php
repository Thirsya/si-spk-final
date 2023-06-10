<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPerhitunganController extends Controller
{
    public function index()
    {
        $perhitungans = DB::table('perhitungan')->get();
        return response()->json($perhitungans);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_perhitungan' => 'required|string',
        ]);

        $data['waktu_perhitungan'] = now();

        $perhitungan = DB::table('perhitungan')->insert($data);

        if ($perhitungan) {
            $response = [
                'message' => 'Perhitungan created successfully.',
                'judul_perhitungan' => $data['judul_perhitungan'],
                'waktu_perhitungan' => $data['waktu_perhitungan'],
            ];

            return response()->json($response);
        }

        return response()->json(['message' => 'Failed to create perhitungan.'],500);
    }
}