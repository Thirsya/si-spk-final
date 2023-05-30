import { Navback } from "../components/navback"
import React from 'react'


export const Hitung = () => {
    return (
        <>

            <Navback></Navback>

            <div className="container pb-6">
                <h1 className="pt-5">Halaman Perhitungan</h1>
                <div className="py-4">
                    <h2 className="p-4">Tabel Kriteria</h2>
                    <table className="table table-bordered" style={{ width: '50%' }}>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kriteria</th>
                                <th>Jenis Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ranking Kelas</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Disiplin</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kemampuan Bahasa Inggris</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Hafalan Rumus Periodik</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Teliti Unsur Kimia</td>
                                <td>Benefit</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Riwayat Sanksi</td>
                                <td>Cost</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>umur</td>
                                <td>Cost</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>sering terlambat</td>
                                <td>Cost</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Jumlah Alpha</td>
                                <td>Cost</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>presentasi kekalahan</td>
                                <td>Cost</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div className="pb-4">
                    <h2 className="p-4">Tabel Pernyataan Kriteria</h2>
                    <table className="table table-bordered" style={{ width: '50%' }}>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kriteria</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>Sangat Baik</td>
                                <td>0,5</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Baik</td>
                                <td>0,4</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Cukup Baik</td>
                                <td>0,3</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Buruk</td>
                                <td>0,2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div className="border border-2 p-3 mb-5">
                    <h2 className="mb-4">Form Input Data</h2>
                    <form action="">
                        <div className="ps-5" style={{ width: '50%' }}>
                            <div className="mb-5">
                                <label htmlFor="judul" className="form-label">Judul Perhitungan</label>
                                <input type="text" className="form-control" id="judul" required />
                            </div>
                            <p className="m-0">Contoh Inputan Excel</p>
                            <img src="img/contoh.png" alt="" className="p-3" />
                            <div className="mb-5">
                                <label htmlFor="excel" className="form-label">Input Data Kiteria per alternatif</label>
                                <input type="file" className="form-control" id="excel" required />
                            </div>
                            <div className="d-flex flex-row-reverse" style={{ width: '200%' }}>
                                <button type="submit" className="btn btn-success btn-lg text-white m-3" >Hitung</button>
                                <button type="reset" className="btn btn-danger btn-lg text-white m-3" >Reset</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </>
    );
}

export default Hitung;