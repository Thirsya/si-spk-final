import { Navback } from "../components/navback"
import React from 'react'
import { useNavigate } from "react-router-dom";
import { useLocation } from 'react-router-dom';
import { useState } from 'react';
import moment from 'moment';



export const Langkah = () => {
    const navigate = useNavigate()
    const location = useLocation();
    const datas = location.state.data;

    const namaResto = [];

    // data perhitungan
    const originalDateTime = datas.perhitungan.waktu_perhitungan;
    const convertedDateTime = moment(originalDateTime).format("DD-MM-YYYY | HH.mm");

    // langkah Normalisasi Entropy
    let EN11 = 0;
    let EN13 = 0;
    const maxEN11 = datas.perhitungan_total.original.nilaimaxbenefit[0].max_aksesbilitas;
    const minEN13 = datas.perhitungan_total.original.nilaimincost[0].min_jarak_dengan_pusat_kota;
    let x11 = 0;
    let x13 = 0;

    // emax
    const emax = Math.log(datas.perhitungan_kriteria_per_alternatif.length);
    console.log(datas);

    // Nilai Entropy
    const sumNNEC1 = datas.perhitungan_total.original.jumlahNilaiNormalisasi[0].jumlah_normalisasi_aksesbilitas;

    // ranking sort
    const compareFunction = (a, b) => {
        return a.ranking - b.ranking;
    };

    let sortedRanking = datas.perhitungan_total.original.NilairankingFinals;
    sortedRanking = sortedRanking.sort(compareFunction);

    const restoFirst = datas.perhitungan_total.original.NilaiOptimasiMoora.filter((namaRestoo) => namaRestoo.nama_restoran == sortedRanking[0].nama_restoran);
    console.log(restoFirst);


    // console.log(jsonData);

    return (
        <>
            <Navback></Navback>
            <div className="container py-5">
                <h1 className="mb-5 ">Halaman Langkah-Langkah Pengerjaan</h1>
                <h4><b>Judul Perhitungan</b>  : {datas.perhitungan.judul_perhitungan}</h4>
                <h4><b>Tanggal Perhitungan</b> : {convertedDateTime}</h4>

                <h3 className="mb-3 mt-5">Data Awal</h3>
                <h5>1. Matrix Keputusan X</h5>
                <table className="table table-bordered mb-5 table-striped" style={{ width: '75%' }}>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Restoran</th>
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                            <th>C6</th>
                            <th>C7</th>
                            <th>C8</th>
                            <th>C9</th>
                            <th>C10</th>
                        </tr>
                    </thead>
                    <tbody>
                        {datas.perhitungan_kriteria_per_alternatif.map((d, index) => {
                            namaResto.push(d.nama_restoran)
                            x11 = Object.values(d)[2];
                            x13 = Object.values(d)[10];
                            // const test = Object.values(d)[10];
                            // console.log(test)
                            return (
                                <tr key={index}>
                                    <td>{index + 1}</td>
                                    <td>{d.nama_restoran}</td>
                                    <td>{d.aksesbilitas}</td>
                                    <td>{d.keamanan}</td>
                                    <td>{d.jarak_dengan_pusat_kota}</td>
                                    <td>{d.harga}</td>
                                    <td>{d.kenyamanan}</td>
                                    <td>{d.luas_bangunan}</td>
                                    <td>{d.luas_parkir}</td>
                                    <td>{d.keramaian}</td>
                                    <td>{d.kebersihan}</td>
                                    <td>{d.fasilitas}</td>
                                </tr>
                            )
                        })}
                    </tbody>
                </table>

                <div className="container pb-5">

                    <h3 className="mt-3 mb-3">Perhutungan Bobot Menggunakan Metode Entropy</h3>

                    <div className="container ps-3">
                        <h5>1. Normalisasi Matrix dengan rumus : </h5>
                        <div className="container ps-3">
                            <img src={'img/rumus/entropi normalisasi.jpeg'} alt="rumus normalisasi" style={{ height: '150px' }} className="ms-3 mb-3" />

                            <p>- Tabel Hasil Normalisasi : </p>
                            <table className="table table-bordered my-3 mb-5 ms-3 table-striped" style={{ width: '75%' }}>
                                <thead className="table-primary text-center align-middle">
                                    <tr>
                                        <th rowSpan="2">No</th>
                                        <th rowSpan="2">Nama Restoran</th>
                                        <th colSpan="2">Benefit</th>
                                        <th colSpan="2">Cost</th>
                                        <th colSpan="6">Benefit</th>
                                    </tr>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>C7</th>
                                        <th>C8</th>
                                        <th>C9</th>
                                        <th>C10</th>
                                    </tr>
                                </thead>
                                <tbody className="text-center">
                                    {datas.perhitungan_total.original.nilaiEntropyNormalisasi.map((d, index) => {

                                        EN11 = Object.values(d)[2];
                                        EN13 = Object.values(d)[10];
                                        return (
                                            <tr key={index}>
                                                <td>{index + 1}</td>
                                                <td>{namaResto[index]}</td>
                                                <td>{d.nilai_normalisasi_aksesbilitas.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_keamanan.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_jarak_dengan_pusat_kota.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_harga.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_kenyamanan.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_luas_bangunan.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_luas_parkir.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_keramaian.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_kebersihan.toFixed(2)}</td>
                                                <td>{d.nilai_normalisasi_fasilitas.toFixed(2)}</td>
                                            </tr>
                                        )
                                    })}
                                    {datas.perhitungan_total.original.jumlahNilaiNormalisasi.map((d, index) => {
                                        return (
                                            <tr key={index} className="fw-bold">
                                                <td colSpan="2" ><b>Jumlah Nilai Normalisasi</b></td>
                                                <td>{d.jumlah_normalisasi_aksesbilitas.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_keamanan.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_jarak_dengan_pusat_kota.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_harga.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_kenyamanan.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_luas_bangunan.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_luas_parkir.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_keramaian.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_kebersihan.toFixed(2)}</td>
                                                <td>{d.jumlah_normalisasi_fasilitas.toFixed(2)}</td>
                                            </tr>
                                        )
                                    })}
                                </tbody>
                            </table>
                            <p>- Perhitungan manual :</p>
                            <div className="ms-3">
                                <p>r<sub>11</sub> = {x11} / {maxEN11} = {EN11} (Benefit)</p>
                                <p>r<sub>16</sub> = {minEN13} / {x13} = {EN13} (Cost)</p>
                            </div>
                        </div>

                        <h5>2. Nilai e max, dengan jumlah alternatif {datas.perhitungan_kriteria_per_alternatif.length}, maka e max = ln({datas.perhitungan_kriteria_per_alternatif.length}), e max = {emax.toFixed(4)}</h5>
                        <h5>3. Nilai K, yaitu K x (1/e max), K = 1/{emax.toFixed(4)}, K = {(1 / emax).toFixed(4)}</h5>
                        <h5>4. Mencari Nilai Entropy masing-masing kriteria dengan rumus</h5>
                        <img src={'img/rumus/entropi 3.png'} alt="rumus 3" className="mb-3 ms-3" />
                        <div className="container ms-5">
                            <p>- Peritungan Manual : </p>
                            <p className="ps-3">e(C1) = − {emax.toFixed(4)} x {datas.perhitungan_total.original.nilaiEntropyNormalisasi.map((d, index) =>
                                (<span key={index}>(({d.nilai_normalisasi_aksesbilitas} / {sumNNEC1}) x ln({d.nilai_normalisasi_aksesbilitas} / {sumNNEC1})) + </span>)
                            )}  = {datas.perhitungan_total.original.nilaiEntropy[0].nilai_e_kriteria_aksesbilitas.toFixed(6)}</p>
                            <p>- Tabel Hasil Perhitungan nilai Entropy tiap Kriteria</p>
                            <table className="table table-bordered my-3" style={{ width: '75%' }}>
                                <thead className="table-primary text-center">
                                    <tr>
                                        <th>e(C1)</th>
                                        <th>e(C2)</th>
                                        <th>e(C3)</th>
                                        <th>e(C4)</th>
                                        <th>e(C5)</th>
                                        <th>e(C6)</th>
                                        <th>e(C7)</th>
                                        <th>e(C8)</th>
                                        <th>e(C9)</th>
                                        <th>e(C10)</th>
                                    </tr>
                                </thead>
                                <tbody className="text-center">
                                    {datas.perhitungan_total.original.nilaiEntropy.map((d, index) => {
                                        return (
                                            <tr key={index}>
                                                <td>{d.nilai_e_kriteria_aksesbilitas.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_keamanan.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_jarak_dengan_pusat_kota.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_harga.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_kenyamanan.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_luas_bangunan.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_luas_parkir.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_keramaian.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_kebersihan.toFixed(6)}</td>
                                                <td>{d.nilai_e_kriteria_fasilitas.toFixed(6)}</td>
                                            </tr>
                                        )
                                    })}
                                </tbody>
                            </table>
                            <p>- Total Nilai Entropy (E) = {datas.perhitungan_total.original.TabelTotalNilaiEntropy[0].total_nilai_e_entropy.toFixed(6)}</p>
                        </div>
                        <h5>5. Mencari Bobot Entropy Setiap Kriteria dengan Rumus :</h5>
                        <img src={'img/rumus/entropi 4.png'} alt="rumus entropy 4" style={{ height: '50px' }} className="ms-3 mb-3" />
                        <div className="container ms-5">
                            <p>- Peritungan Manual : </p>
                            <p className="ps-3">&#955;C1 = 1 / (10 - {datas.perhitungan_total.original.nilaiEntropy[0].nilai_e_kriteria_aksesbilitas.toFixed(6)}) [1 - {datas.perhitungan_total.original.TabelTotalNilaiEntropy[0].total_nilai_e_entropy.toFixed(6)}] = {datas.perhitungan_total.original.TabelTotalBobotEntropy[0].bobot_entropy_aksesbilitas.toFixed(6)}</p>
                        </div>
                        <h5>6. Tabel Hasil Bobot Entropy tiap Kriteria</h5>
                        <table className="table table-bordered my-3 ms-5" style={{ width: '75%' }}>
                            <thead className="table-dark text-center">
                                <tr>
                                    <th>&#955;<sub>C1</sub></th>
                                    <th>&#955;<sub>C2</sub></th>
                                    <th>&#955;<sub>C3</sub></th>
                                    <th>&#955;<sub>C4</sub></th>
                                    <th>&#955;<sub>C5</sub></th>
                                    <th>&#955;<sub>C6</sub></th>
                                    <th>&#955;<sub>C7</sub></th>
                                    <th>&#955;<sub>C8</sub></th>
                                    <th>&#955;<sub>C9</sub></th>
                                    <th>&#955;<sub>C10</sub></th>
                                </tr>
                            </thead>
                            <tbody className="text-center">
                                {datas.perhitungan_total.original.TabelTotalBobotEntropy.map((d, index) => {
                                    return (
                                        <tr key={index}>
                                            <td>{d.bobot_entropy_aksesbilitas.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_keamanan.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_jarak_dengan_pusat_kota.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_harga.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_kenyamanan.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_luas_bangunan.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_luas_parkir.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_keramaian.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_kebersihan.toFixed(6)}</td>
                                            <td>{d.bobot_entropy_fasilitas.toFixed(6)}</td>
                                        </tr>
                                    )
                                })}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div className="container">
                    <h3>Perhitungan Perankingan dengan Metode Moora</h3>
                    <div className="container ps-3">
                        <h5>1. Normalisasi Matrix Keputusan X dengan rumus : </h5>
                        <img src={'img/rumus/moora 1.png'} alt="rumus moora Normalisasi" style={{ height: '50px' }} className="ms-3 mb-3" />
                        <div className="ps-3">
                            <p>-Perhitungan Manual : </p>
                            <p className="ms-3 mb-3">X<sub>11</sub><sup>*</sup> = {datas.perhitungan_kriteria_per_alternatif[0].aksesbilitas} / &radic; <span className=" border-top border-black">{datas.perhitungan_kriteria_per_alternatif.map((d, index) => (
                                <span key={index}> {d.aksesbilitas}<sup>2</sup> + </span>
                            ))}</span>  = {datas.perhitungan_total.original.NilaiNormalisasiMoora[0].nilai_normalisasi_moora_aksesbilitas.toFixed(5)}</p>

                            <p>- Tabel Hasil Normalisasi : </p>
                            <table className="table table-bordered my-3 table-striped ms-3" style={{ width: '85%' }}>
                                <thead className="text-center table-success align-middle">
                                    <tr>
                                        <th rowSpan="2">No</th>
                                        <th rowSpan="2">Nama Restoran</th>
                                        <th colSpan="2">Benefit</th>
                                        <th colSpan="2">Cost</th>
                                        <th colSpan="6">Benefit</th>
                                    </tr>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>C7</th>
                                        <th>C8</th>
                                        <th>C9</th>
                                        <th>C10</th>
                                    </tr>
                                </thead>
                                <tbody className="text-center">
                                    {datas.perhitungan_total.original.NilaiNormalisasiMoora.map((d, index) => {
                                        return (
                                            <tr key={index}>
                                                <td>{index + 1}</td>
                                                <td>{namaResto[index]}</td>
                                                <td>{d.nilai_normalisasi_moora_aksesbilitas.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_keamanan.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_jarak_dengan_pusat_kota.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_harga.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_kenyamanan.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_luas_bangunan.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_luas_parkir.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_keramaian.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_kebersihan.toFixed(5)}</td>
                                                <td>{d.nilai_normalisasi_moora_fasilitas.toFixed(5)}</td>
                                            </tr>
                                        )
                                    })}
                                </tbody>
                            </table>
                        </div>

                        <h5>2. Optimasi Kriteria dengan rumus : </h5>
                        <div className="ps-3">
                            <div className="container ms-3 mb-3">
                                <p className="ms-3">yi = X<sub>ij</sub><sup>*</sup> x W</p>
                                <p>- Contoh Perhitungan Manual : </p>
                                <p className="ms-3">yi <sub>11</sub> = {datas.perhitungan_total.original.NilaiNormalisasiMoora[0].nilai_normalisasi_moora_aksesbilitas.toFixed(5)} * {datas.perhitungan_total.original.TabelTotalBobotEntropy[0].bobot_entropy_aksesbilitas.toFixed(6)} = {datas.perhitungan_total.original.NilaiOptimasiMoora[0].nilai_optimasi_moora_aksesbilitas.toFixed(5)} </p>

                                <p>- Tabel Bobot Entropy Kriteria : </p>
                                <table className="table table-bordered my-3 ms-5" style={{ width: '75%' }}>
                                    <thead className="table-success text-center">
                                        <tr>
                                            <th>&#955;<sub>C1</sub></th>
                                            <th>&#955;<sub>C2</sub></th>
                                            <th>&#955;<sub>C3</sub></th>
                                            <th>&#955;<sub>C4</sub></th>
                                            <th>&#955;<sub>C5</sub></th>
                                            <th>&#955;<sub>C6</sub></th>
                                            <th>&#955;<sub>C7</sub></th>
                                            <th>&#955;<sub>C8</sub></th>
                                            <th>&#955;<sub>C9</sub></th>
                                            <th>&#955;<sub>C10</sub></th>
                                        </tr>
                                    </thead>
                                    <tbody className="text-center">
                                        {datas.perhitungan_total.original.TabelTotalBobotEntropy.map((d, index) => {
                                            return (
                                                <tr key={index}>
                                                    <td>{d.bobot_entropy_aksesbilitas.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_keamanan.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_jarak_dengan_pusat_kota.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_harga.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_kenyamanan.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_luas_bangunan.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_luas_parkir.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_keramaian.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_kebersihan.toFixed(6)}</td>
                                                    <td>{d.bobot_entropy_fasilitas.toFixed(6)}</td>
                                                </tr>
                                            )
                                        })}
                                    </tbody>
                                </table>
                            </div>

                            <p>- Tabel Hasil Optimasi : </p>
                            <table className="table table-bordered my-3 table-striped ms-3" style={{ width: '85%' }}>
                                <thead className="text-center table-success align-middle">
                                    <tr>
                                        <th rowSpan="2">No</th>
                                        <th rowSpan="2">Nama Restoran</th>
                                        <th colSpan="2">Benefit</th>
                                        <th colSpan="2">Cost</th>
                                        <th colSpan="6">Benefit</th>
                                    </tr>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>C7</th>
                                        <th>C8</th>
                                        <th>C9</th>
                                        <th>C10</th>
                                    </tr>
                                </thead>
                                <tbody className="text-center">
                                    {datas.perhitungan_total.original.NilaiOptimasiMoora.map((d, index) => (
                                        <tr key={index}>
                                            <td>{index + 1}</td>
                                            <td>{namaResto[index]}</td>
                                            <td>{d.nilai_optimasi_moora_aksesbilitas.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_keamanan.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_jarak_dengan_pusat_kota.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_harga.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_kenyamanan.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_luas_bangunan.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_luas_parkir.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_keramaian.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_kebersihan.toFixed(5)}</td>
                                            <td>{d.nilai_optimasi_moora_fasilitas.toFixed(5)}</td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>

                        <h5>3. Perankingan Hasil Akhir </h5>
                        <div className="ps-3">
                            <p>-Perhitungan Manual : </p>
                            <p className="ms-3"> MAX = &#931; optimasi BENEFIT</p>
                            <p className="ms-3"> MIN = &#931; optimasi COST</p>
                            <p className="ms-3 mb-3"> Total  = MAX - MIN</p>




                            <p className="ms-3 mb-3"> {sortedRanking[0].nama_restoran}</p>
                            <p className="ms-5"> MAX = {restoFirst[0].nilai_optimasi_moora_aksesbilitas.toFixed(5)} + {restoFirst[0].nilai_optimasi_moora_keamanan.toFixed(5)} + {restoFirst[0].nilai_optimasi_moora_kenyamanan.toFixed(5)} + {restoFirst[0].nilai_optimasi_moora_luas_bangunan.toFixed(5)} + {restoFirst[0].nilai_optimasi_moora_luas_parkir.toFixed(5)} + {restoFirst[0].nilai_optimasi_moora_keramaian.toFixed(5)} + {restoFirst[0].nilai_optimasi_moora_kebersihan.toFixed(5)} + {restoFirst[0].nilai_optimasi_moora_fasilitas.toFixed(5)} = {datas.perhitungan_total.original.NilairankingFinals[0].max_optimasi.toFixed(5)}</p>
                            <p className="ms-5"> MIN = {restoFirst[0].nilai_optimasi_moora_jarak_dengan_pusat_kota.toFixed(5)} + {restoFirst[0].nilai_optimasi_moora_harga.toFixed(5)} = {datas.perhitungan_total.original.NilairankingFinals[0].min_optimasi.toFixed(5)}</p>
                            <p className="ms-5 mb-3"> Total  = {datas.perhitungan_total.original.NilairankingFinals[0].max_optimasi.toFixed(5)} - {datas.perhitungan_total.original.NilairankingFinals[0].min_optimasi.toFixed(5)} = {datas.perhitungan_total.original.NilairankingFinals[0].pengurangan_maxmin.toFixed(5)}</p>

                            <p>- Tabel Hasil Perankingan : </p>
                            <table className="table table-bordered my-3 table-striped ms-3" style={{ width: '70%' }}>
                                <thead className="text-center table-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Restoran</th>
                                        <th>MAX</th>
                                        <th>MIN</th>
                                        <th>Total</th>
                                        <th>Rank</th>
                                    </tr>
                                </thead>
                                <tbody className="text-center">
                                    {datas.perhitungan_total.original.NilairankingFinals.map((d, index) => (
                                        <tr key={index}>
                                            <td>{index + 1}</td>
                                            <td>{d.nama_restoran}</td>
                                            <td>{d.max_optimasi.toFixed(5)}</td>
                                            <td>{d.min_optimasi.toFixed(5)}</td>
                                            <td>{d.pengurangan_maxmin.toFixed(5)}</td>
                                            <td>{d.ranking}</td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

                <h3 className="mt-5">Kesimpulan</h3>

                <h5 className="ms-3 lh-base">Dari hasil perankingan tabel di atas, dapat disimpulkan bahwa restoran rekomendasi peringkat pertama adalah restoran <b>{datas.perhitungan_total.original.NilairankingFinals[0].nama_restoran}</b>  dengan skor perhitungan <b>{datas.perhitungan_total.original.NilairankingFinals[0].pengurangan_maxmin.toFixed(5)}</b>  </h5>


                <button type="button" className="btn btn-success btn-lg text-white m-3" onClick={() => navigate('/history')} >History</button>


            </div>


        </>
    );
}


export default Langkah;