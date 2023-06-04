<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerhitunganKriteriaPerAlternatif;
use App\Models\NilaiMaxTiapAlternatifBenefit;
use App\Models\NilaiMinTiapAlternatifCost;
use App\Models\TabelBobotEntropy;
use App\Models\TabelTotalNilaiEntropy;
use Illuminate\Support\Facades\DB;


class ApiMetodeEntropyController extends Controller
{
    public function PerhitunganTotal(Request $request)
    {
        $perhitunganID = $request->perhitungan_id;
        $perhitungans = DB::table('perhitungan')
            ->where('id', $request->perhitungan_id)
            ->get();
        $perhitunganKriteriaPerAlternatif = DB::table('perhitungan_kriteria_per_alternatif')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();


        DB::beginTransaction();

        //Mengambil Nilai Max Benefit
        try {
            // Inisialisasi array kosong untuk menyimpan nilai terbesar per kolom
            $highestValues = [];

            // Tentukan daftar kolom yang ingin diambil
            $kolomYangDiambil = [
                'Ranking_Kelas',
                'Disiplin',
                'Kemampuan_Bahasa_Asing',
                'Hafalan_Rumus_Periodik',
                'Teliti_Unsur_Kimia'
            ];

            // Looping untuk mengambil nilai terbesar per kolom
            foreach ($perhitunganKriteriaPerAlternatif as $data) {
                foreach ($kolomYangDiambil as $kolom) {
                    $value = $data->$kolom;

                    if (!isset($highestValues[$kolom]) || $value > $highestValues[$kolom]) {
                        // Mengupdate nilai terbesar per kolom
                        $highestValues[$kolom] = $value;
                    }
                }
            }

            // Menyimpan nilai terbesar ke dalam tabel "nilai_max_tiap_alternatif_benefit"
            $nilaiMaxTiapAlternatifBenefit = new NilaiMaxTiapAlternatifBenefit([
                'id_perhitungan' => $perhitunganID, // Ganti dengan nilai ID perhitungan yang sesuai
                'max_Ranking_Kelas' => $highestValues['Ranking_Kelas'],
                'max_Disiplin' => $highestValues['Disiplin'],
                'max_Kemampuan_Bahasa_Asing' => $highestValues['Kemampuan_Bahasa_Asing'],
                'max_Hafalan_Rumus_Periodik' => $highestValues['Hafalan_Rumus_Periodik'],
                'max_Teliti_Unsur_Kimia' => $highestValues['Teliti_Unsur_Kimia'],
            ]);

            $nilaiMaxTiapAlternatifBenefit->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        $nilaimaxbenefit = DB::table('nilai_max_tiap_alternatif_benefit')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();


        //Mengambil Nilai Min Cost
        try {
            // Inisialisasi array kosong untuk menyimpan nilai terkecil per kolom
            $lowestValues = [];

            // Tentukan daftar kolom yang ingin diambil
            $kolomYangDiambil = [
                'Riwayat_Sanksi',
                'Umur',
                'Sering_Terlambat',
                'Jumlah_Alpha',
                'Presentasi_Kekalahan'
            ];

            // Looping untuk mengambil nilai terkecil per kolom
            foreach ($perhitunganKriteriaPerAlternatif as $data) {
                foreach ($kolomYangDiambil as $kolom) {
                    $value = $data->$kolom;

                    if (!isset($lowestValues[$kolom]) || $value < $lowestValues[$kolom]) {
                        // Mengupdate nilai terkecil per kolom
                        $lowestValues[$kolom] = $value;
                    }
                }
            }

            // Menyimpan nilai terkecil ke dalam tabel "nilai_min_tiap_alternatif"
            $nilaiMinTiapAlternatifCost = new NilaiMinTiapAlternatifCost([
                'id_perhitungan' => $perhitunganID, // Ganti dengan nilai ID perhitungan yang sesuai
                'min_Riwayat_Sanksi' => $lowestValues['Riwayat_Sanksi'],
                'min_Umur' => $lowestValues['Umur'],
                'min_Sering_Terlambat' => $lowestValues['Sering_Terlambat'],
                'min_Jumlah_Alpha' => $lowestValues['Jumlah_Alpha'],
                'min_Presentasi_Kekalahan' => $lowestValues['Presentasi_Kekalahan'],
            ]);

            $nilaiMinTiapAlternatifCost->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        $nilaimincost = DB::table('nilai_min_tiap_alternatif_cost')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();

        //Membuat Hasil Normalisasi dengan membagi Nilai Max dan Min Tiap Kriteria Per Alternatif
        //Untuk Kriteria Benefit, Nilai Kriteria Per Alternatif dibagi Nilai Max
        //Untuk Kriteria Cost, Nilai Min dibagi Nilai Kriteria Per Alternatif

        $entropies = [];

        $maxValues = $nilaimaxbenefit->max();
        $minValues = $nilaimincost->min();

        foreach ($perhitunganKriteriaPerAlternatif as $data) {
            $entropies[] = [
                'id_perhitungan' => $request->perhitungan_id,
                'nilai_normalisasi_Ranking_Kelas' => $data->Ranking_Kelas / $maxValues->max_Ranking_Kelas,
                'nilai_normalisasi_Disiplin' => $data->Disiplin / $maxValues->max_Disiplin,
                'nilai_normalisasi_Kemampuan_Bahasa_Asing' => $data->Kemampuan_Bahasa_Asing / $maxValues->max_Kemampuan_Bahasa_Asing,
                'nilai_normalisasi_Hafalan_Rumus_Periodik' => $data->Hafalan_Rumus_Periodik / $maxValues->max_Hafalan_Rumus_Periodik,
                'nilai_normalisasi_Teliti_Unsur_Kimia' => $data->Teliti_Unsur_Kimia / $maxValues->max_Teliti_Unsur_Kimia,
                'nilai_normalisasi_Riwayat_Sanksi' =>  $minValues->min_Riwayat_Sanksi / $data->Riwayat_Sanksi,
                'nilai_normalisasi_Umur' =>  $minValues->min_Umur / $data->Umur,
                'nilai_normalisasi_Sering_Terlambat' => $minValues->min_Sering_Terlambat / $data->Sering_Terlambat,
                'nilai_normalisasi_Jumlah_Alpha' => $minValues->min_Jumlah_Alpha / $data->Jumlah_Alpha,
                'nilai_normalisasi_Presentasi_Kekalahan' => $minValues->min_Presentasi_Kekalahan / $data->Presentasi_Kekalahan,
            ];
        }

        // Simpan nilai entropy normalisasi ke dalam tabel "hasil_normalisasi_entropy"
        try {
            DB::table('hasil_normalisasi_entropy')->insert($entropies);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.']);
        }

        // Mengambil data nilai entropy normalisasi
        $nilaiEntropyNormalisasi = DB::table('hasil_normalisasi_entropy')
            ->where('id_perhitungan', $request->perhitungan_id)
            ->get();

        //Membuat Jumlah Akhir Nilai Hasil Normalisasi Entropy dengan Menjumlahkan Nilai Seluruh Kolom
        $jumlahNormalisasi = [
            'id_perhitungan' => $request->perhitungan_id,
            'jumlah_normalisasi_Ranking_Kelas' => 0,
            'jumlah_normalisasi_Disiplin' => 0,
            'jumlah_normalisasi_Kemampuan_Bahasa_Asing' => 0,
            'jumlah_normalisasi_Hafalan_Rumus_Periodik' => 0,
            'jumlah_normalisasi_Teliti_Unsur_Kimia' => 0,
            'jumlah_normalisasi_Riwayat_Sanksi' => 0,
            'jumlah_normalisasi_Umur' => 0,
            'jumlah_normalisasi_Sering_Terlambat' => 0,
            'jumlah_normalisasi_Jumlah_Alpha' => 0,
            'jumlah_normalisasi_Presentasi_Kekalahan' => 0,
        ];

        foreach ($entropies as $data) {
            $jumlahNormalisasi['jumlah_normalisasi_Ranking_Kelas'] += $data['nilai_normalisasi_Ranking_Kelas'];
            $jumlahNormalisasi['jumlah_normalisasi_Disiplin'] += $data['nilai_normalisasi_Disiplin'];
            $jumlahNormalisasi['jumlah_normalisasi_Kemampuan_Bahasa_Asing'] += $data['nilai_normalisasi_Kemampuan_Bahasa_Asing'];
            $jumlahNormalisasi['jumlah_normalisasi_Hafalan_Rumus_Periodik'] += $data['nilai_normalisasi_Hafalan_Rumus_Periodik'];
            $jumlahNormalisasi['jumlah_normalisasi_Teliti_Unsur_Kimia'] += $data['nilai_normalisasi_Teliti_Unsur_Kimia'];
            $jumlahNormalisasi['jumlah_normalisasi_Riwayat_Sanksi'] += $data['nilai_normalisasi_Riwayat_Sanksi'];
            $jumlahNormalisasi['jumlah_normalisasi_Umur'] += $data['nilai_normalisasi_Umur'];
            $jumlahNormalisasi['jumlah_normalisasi_Sering_Terlambat'] += $data['nilai_normalisasi_Sering_Terlambat'];
            $jumlahNormalisasi['jumlah_normalisasi_Jumlah_Alpha'] += $data['nilai_normalisasi_Jumlah_Alpha'];
            $jumlahNormalisasi['jumlah_normalisasi_Presentasi_Kekalahan'] += $data['nilai_normalisasi_Presentasi_Kekalahan'];
        }

       // Simpan nilai jumlah entropy normalisasi ke dalam tabel "jumlah_normalisasi_entropies"
        try {
            DB::table('jumlah_normalisasi_entropies')->insert([$jumlahNormalisasi]);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat menyimpan data
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }

        $perhitunganJumlahNormalisasiEntropy = DB::table('jumlah_normalisasi_entropies')
        ->where('id_perhitungan', $request->perhitungan_id)
        ->get();


        // Perhitungan Pencarian Nilai Entropy
        // Menghitung Nilai ln dengan Membagi Jumlah Alternatif
        $jumlahAlternatif = $perhitunganKriteriaPerAlternatif->count();

        $hasilLn = log($jumlahAlternatif);

        // Mencari Nilai K
        $hasilNilaiK = 1 / $hasilLn;

        // Perhitungan Pencarian Nilai Entropy Tiap Kriteria
        $nilaiEntropi = [];

        $nilaiTotal = [
            'nilaiTotal_Ranking_Kelas' => 0,
            'nilaiTotal_Disiplin' => 0,
            'nilaiTotal_Kemampuan_Bahasa_Asing' => 0,
            'nilaiTotal_Hafalan_Rumus_Periodik' => 0,
            'nilaiTotal_Teliti_Unsur_Kimia' => 0,
            'nilaiTotal_Riwayat_Sanksi' => 0,
            'nilaiTotal_Umur' => 0,
            'nilaiTotal_Sering_Terlambat' => 0,
            'nilaiTotal_Jumlah_Alpha' => 0,
            'nilaiTotal_Presentasi_Kekalahan' => 0,
        ];

        foreach ($nilaiEntropyNormalisasi as $data) {
            $nilai_e_kriteria_Ranking_Kelas = ($data->nilai_normalisasi_Ranking_Kelas / $jumlahNormalisasi['jumlah_normalisasi_Ranking_Kelas']) * log($data->nilai_normalisasi_Ranking_Kelas / $jumlahNormalisasi['jumlah_normalisasi_Ranking_Kelas']);
            $nilai_e_kriteria_Disiplin = ($data->nilai_normalisasi_Disiplin / $jumlahNormalisasi['jumlah_normalisasi_Disiplin']) * log($data->nilai_normalisasi_Disiplin / $jumlahNormalisasi['jumlah_normalisasi_Disiplin']);
            $nilai_e_kriteria_Kemampuan_Bahasa_Asing = ($data->nilai_normalisasi_Kemampuan_Bahasa_Asing / $jumlahNormalisasi['jumlah_normalisasi_Kemampuan_Bahasa_Asing']) * log($data->nilai_normalisasi_Kemampuan_Bahasa_Asing / $jumlahNormalisasi['jumlah_normalisasi_Kemampuan_Bahasa_Asing']);
            $nilai_e_kriteria_Hafalan_Rumus_Periodik = ($data->nilai_normalisasi_Hafalan_Rumus_Periodik / $jumlahNormalisasi['jumlah_normalisasi_Hafalan_Rumus_Periodik']) * log($data->nilai_normalisasi_Hafalan_Rumus_Periodik / $jumlahNormalisasi['jumlah_normalisasi_Hafalan_Rumus_Periodik']);
            $nilai_e_kriteria_Teliti_Unsur_Kimia = ($data->nilai_normalisasi_Teliti_Unsur_Kimia / $jumlahNormalisasi['jumlah_normalisasi_Teliti_Unsur_Kimia']) * log($data->nilai_normalisasi_Teliti_Unsur_Kimia / $jumlahNormalisasi['jumlah_normalisasi_Teliti_Unsur_Kimia']);
            $nilai_e_kriteria_Riwayat_Sanksi = ($data->nilai_normalisasi_Riwayat_Sanksi / $jumlahNormalisasi['jumlah_normalisasi_Riwayat_Sanksi']) * log($data->nilai_normalisasi_Riwayat_Sanksi / $jumlahNormalisasi['jumlah_normalisasi_Riwayat_Sanksi']);
            $nilai_e_kriteria_Umur = ($data->nilai_normalisasi_Umur / $jumlahNormalisasi['jumlah_normalisasi_Umur']) * log($data->nilai_normalisasi_Umur / $jumlahNormalisasi['jumlah_normalisasi_Umur']);
            $nilai_e_kriteria_Sering_Terlambat = ($data->nilai_normalisasi_Sering_Terlambat / $jumlahNormalisasi['jumlah_normalisasi_Sering_Terlambat']) * log($data->nilai_normalisasi_Sering_Terlambat / $jumlahNormalisasi['jumlah_normalisasi_Sering_Terlambat']);
            $nilai_e_kriteria_Jumlah_Alpha = ($data->nilai_normalisasi_Jumlah_Alpha / $jumlahNormalisasi['jumlah_normalisasi_Jumlah_Alpha']) * log($data->nilai_normalisasi_Jumlah_Alpha / $jumlahNormalisasi['jumlah_normalisasi_Jumlah_Alpha']);
            $nilai_e_kriteria_Presentasi_Kekalahan = ($data->nilai_normalisasi_Presentasi_Kekalahan / $jumlahNormalisasi['jumlah_normalisasi_Presentasi_Kekalahan']) * log($data->nilai_normalisasi_Presentasi_Kekalahan / $jumlahNormalisasi['jumlah_normalisasi_Presentasi_Kekalahan']);

            $nilaiTotal['nilaiTotal_Ranking_Kelas'] += $nilai_e_kriteria_Ranking_Kelas;
            $nilaiTotal['nilaiTotal_Disiplin'] += $nilai_e_kriteria_Disiplin;
            $nilaiTotal['nilaiTotal_Kemampuan_Bahasa_Asing'] += $nilai_e_kriteria_Kemampuan_Bahasa_Asing;
            $nilaiTotal['nilaiTotal_Hafalan_Rumus_Periodik'] += $nilai_e_kriteria_Hafalan_Rumus_Periodik;
            $nilaiTotal['nilaiTotal_Teliti_Unsur_Kimia'] += $nilai_e_kriteria_Teliti_Unsur_Kimia;
            $nilaiTotal['nilaiTotal_Riwayat_Sanksi'] += $nilai_e_kriteria_Riwayat_Sanksi;
            $nilaiTotal['nilaiTotal_Umur'] += $nilai_e_kriteria_Umur;
            $nilaiTotal['nilaiTotal_Sering_Terlambat'] += $nilai_e_kriteria_Sering_Terlambat;
            $nilaiTotal['nilaiTotal_Jumlah_Alpha'] += $nilai_e_kriteria_Jumlah_Alpha;
            $nilaiTotal['nilaiTotal_Presentasi_Kekalahan'] += $nilai_e_kriteria_Presentasi_Kekalahan;

        }
        // Tambahkan total nilai dan dikali dengan hasilNilaiK ke dalam array $nilaiEntropi
        $nilaiEntropi[] = [
            'id_perhitungan' => $request->perhitungan_id,
            'nilai_e_kriteria_Ranking_Kelas' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Ranking_Kelas'],
            'nilai_e_kriteria_Disiplin' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Disiplin'],
            'nilai_e_kriteria_Kemampuan_Bahasa_Asing' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Kemampuan_Bahasa_Asing'],
            'nilai_e_kriteria_Hafalan_Rumus_Periodik' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Hafalan_Rumus_Periodik'],
            'nilai_e_kriteria_Teliti_Unsur_Kimia' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Teliti_Unsur_Kimia'],
            'nilai_e_kriteria_Riwayat_Sanksi' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Riwayat_Sanksi'],
            'nilai_e_kriteria_Umur' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Umur'],
            'nilai_e_kriteria_Sering_Terlambat' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Sering_Terlambat'],
            'nilai_e_kriteria_Jumlah_Alpha' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Jumlah_Alpha'],
            'nilai_e_kriteria_Presentasi_Kekalahan' => -$hasilNilaiK * $nilaiTotal['nilaiTotal_Presentasi_Kekalahan'],
        ];

        try {
            DB::table('tabel_nilai_entropies')->insert($nilaiEntropi);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }

        $perhitunganNilaiEntropy = DB::table('tabel_nilai_entropies')
        ->where('id_perhitungan', $request->perhitungan_id)
        ->get();

        $total = DB::table('tabel_nilai_entropies')
        ->where('id_perhitungan', $request->perhitungan_id)
        ->selectRaw('SUM(
            nilai_e_kriteria_Ranking_Kelas +
            nilai_e_kriteria_Disiplin +
            nilai_e_kriteria_Kemampuan_Bahasa_Asing +
            nilai_e_kriteria_Hafalan_Rumus_Periodik +
            nilai_e_kriteria_Teliti_Unsur_Kimia +
            nilai_e_kriteria_Riwayat_Sanksi +
            nilai_e_kriteria_Umur +
            nilai_e_kriteria_Sering_Terlambat +
            nilai_e_kriteria_Jumlah_Alpha +
            nilai_e_kriteria_Presentasi_Kekalahan
        ) as total')
        ->value('total');

    TabelTotalNilaiEntropy::updateOrCreate(
        ['hitung_id' => $request->perhitungan_id],
        ['total_nilai_e_entropy' => $total]
    );

    $TabelTotalNilaiEntropy = DB::table('tabel_total_nilai_entropies')
        ->select('total_nilai_e_entropy')
        ->where('hitung_id', $request->perhitungan_id)
        ->get();




        $totalNilaiEntropy = $TabelTotalNilaiEntropy->first()->total_nilai_e_entropy;
        $nilai_e_kriteria_Ranking_Kelas_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Ranking_Kelas;
        $nilai_e_kriteria_Disiplin_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Disiplin;
        $nilai_e_kriteria_Kemampuan_Bahasa_Asing_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Kemampuan_Bahasa_Asing;
        $nilai_e_kriteria_Hafalan_Rumus_Periodik_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Hafalan_Rumus_Periodik;
        $nilai_e_kriteria_Teliti_Unsur_Kimia_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Teliti_Unsur_Kimia;
        $nilai_e_kriteria_Riwayat_Sanksi_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Riwayat_Sanksi;
        $nilai_e_kriteria_Umur_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Umur;
        $nilai_e_kriteria_Sering_Terlambat_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Sering_Terlambat;
        $nilai_e_kriteria_Jumlah_Alpha_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Jumlah_Alpha;
        $nilai_e_kriteria_Presentasi_Kekalahan_final = $perhitunganNilaiEntropy->first()->nilai_e_kriteria_Presentasi_Kekalahan;

// dd(1/(10 - $totalNilaiEntropy));
// dd((1-$nilai_e_kriteria_Ranking_Kelas));
        // Perhitungan Jumlah Total Nilai Entropy
    $tabelBobot = New TabelBobotEntropy([
    'hitung_id' => $perhitunganID,
    'bobot_entropy_Ranking_Kelas' => ((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Ranking_Kelas_final)),
    'bobot_entropy_Disiplin'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Disiplin_final)),
    'bobot_entropy_Kemampuan_Bahasa_Asing'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Kemampuan_Bahasa_Asing_final)),
    'bobot_entropy_Hafalan_Rumus_Periodik'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Hafalan_Rumus_Periodik_final)),
    'bobot_entropy_Teliti_Unsur_Kimia'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Teliti_Unsur_Kimia_final)),
    'bobot_entropy_Riwayat_Sanksi'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Riwayat_Sanksi_final)),
    'bobot_entropy_Umur'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Umur_final)),
    'bobot_entropy_Sering_Terlambat'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Sering_Terlambat_final)),
    'bobot_entropy_Jumlah_Alpha'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Jumlah_Alpha_final)),
    'bobot_entropy_Presentasi_Kekalahan'=>((1/(10 - $totalNilaiEntropy))*(1-$nilai_e_kriteria_Presentasi_Kekalahan_final)),

    ]);

    $tabelBobot->save();
    $TabelTotalBobotEntropy = DB::table('tabel_bobot_entropies')
        ->where('hitung_id', $request->perhitungan_id)
        ->get();

        // Perhitungan Bobot Nilai Entropy Per Kriteria


        $response = [
            'perhitungans' => $perhitungans,
            'perhitunganKriteriaPerAlternatif' => $perhitunganKriteriaPerAlternatif,
            'nilaimaxbenefit' => $nilaimaxbenefit,
            'nilaimincost' => $nilaimincost,
            'nilaiEntropyNormalisasi' => $nilaiEntropyNormalisasi,
            'jumlahNilaiNormalisasi' => $perhitunganJumlahNormalisasiEntropy,
            'nilaiEntropy' => $perhitunganNilaiEntropy,
            'TabelTotalNilaiEntropy' => $TabelTotalNilaiEntropy,
            'TabelTotalBobotEntropy' => $TabelTotalBobotEntropy,
        ];

        return response()->json($response);
    }
}