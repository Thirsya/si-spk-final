import { Navback } from "../components/navback"
import React from 'react'
import { useNavigate } from "react-router-dom";
import { useLocation } from 'react-router-dom';


export const Langkah = () => {
    const navigate = useNavigate()
    const location = useLocation();
    const jsonData = location.state.data;

    console.log(jsonData);

    return (
        <>
            <Navback></Navback>
            <div className="container py-5">
                <h1 className="mb-5 ">Halaman Langkah-Langkah Pengerjaan</h1>
                <h3 className="mb-3">Data Awal</h3>
                <h5>1. Matrix Keputusan X</h5>
                <table className="table table-bordered mb-5 table-striped" style={{ width: '75%' }}>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
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
                        <tr>
                            <td>1</td>
                            <td>Ahmad Rafif Alaudin</td>
                            <td>0,2</td>
                            <td>0,4</td>
                            <td>0,5</td>
                            <td>0,2</td>
                            <td>0,4</td>
                            <td>0,4</td>
                            <td>0,2</td>
                            <td>0,5</td>
                            <td>0,3</td>
                            <td>0,2</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Raka Bagas Fitriansyah</td>
                            <td>0,4</td>
                            <td>0,2</td>
                            <td>0,4</td>
                            <td>0,5</td>
                            <td>0,3</td>
                            <td>0,4</td>
                            <td>0,5</td>
                            <td>0,2</td>
                            <td>0,2</td>
                            <td>0,2</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Thirsya Widya Sulaiman</td>
                            <td>0,4</td>
                            <td>0,3</td>
                            <td>0,2</td>
                            <td>0,4</td>
                            <td>0,2</td>
                            <td>0,5</td>
                            <td>0,2</td>
                            <td>0,2</td>
                            <td>0,4</td>
                            <td>0,5</td>
                        </tr>
                    </tbody>
                </table>

                <div className="container pb-5">

                    <h3 className="mt-3 mb-3">Perhutungan Bobot Menggunakan Metode Entropy</h3>

                    <div className="container ps-3">
                        <h5>1. Normalisasi Matrix dengan rumus : </h5>
                        <div className="container ps-3">
                            <img src={'img/rumus/entropi normalisasi.jpeg'} alt="rumus normalisasi" style={{ height: '150px' }} className="ms-3 mb-3" />
                            <p>- Perhitungan manual :</p>
                            <div className="ms-3">
                                <p>r<sub>11</sub> = 0,2 / 0,5 = 0,4 (Benefit)</p>
                                <p>r<sub>16</sub> = 0,1 / 0,4 = 4 (Cost)</p>
                            </div>

                            <p>- Tabel Hasil Normalisasi : </p>
                            <table className="table table-bordered my-3 mb-5 ms-3 table-striped" style={{ width: '75%' }}>
                                <thead className="table-primary text-center align-middle">
                                    <tr>
                                        <th rowSpan="2">No</th>
                                        <th rowSpan="2">Nama Siswa</th>
                                        <th colSpan="5">Benefit</th>
                                        <th colSpan="5">Cost</th>
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
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Rafif Alaudin</td>
                                        <td>0,2</td>
                                        <td>0,4</td>
                                        <td>0,5</td>
                                        <td>0,2</td>
                                        <td>0,4</td>
                                        <td>0,4</td>
                                        <td>0,2</td>
                                        <td>0,5</td>
                                        <td>0,3</td>
                                        <td>0,2</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Raka Bagas Fitriansyah</td>
                                        <td>0,4</td>
                                        <td>0,2</td>
                                        <td>0,4</td>
                                        <td>0,5</td>
                                        <td>0,3</td>
                                        <td>0,4</td>
                                        <td>0,5</td>
                                        <td>0,2</td>
                                        <td>0,2</td>
                                        <td>0,2</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Thirsya Widya Sulaiman</td>
                                        <td>0,4</td>
                                        <td>0,3</td>
                                        <td>0,2</td>
                                        <td>0,4</td>
                                        <td>0,2</td>
                                        <td>0,5</td>
                                        <td>0,2</td>
                                        <td>0,2</td>
                                        <td>0,4</td>
                                        <td>0,5</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5>2. Nilai e max, dengan jumlah alternatif 20, maka e max = ln(20), e max = 2,9957</h5>
                        <h5>3. Nilai K, yaitu K x (1/e max), K = 1/2,9957, K = 0,3338</h5>
                        <h5>4. Mencari Nilai Entropy masing-masing kriteria dengan rumus</h5>
                        <img src={'img/rumus/entropi 3.png'} alt="rumus 3" className="mb-3 ms-3" />
                        <div className="container ms-5">
                            <p>- Peritungan Manual : </p>
                            <p className="ps-3">e(C1) = - 0,3338 x ((0,8/0,4) x ln(0,8/0,4)) + ((0,8/0,4) x ln(0,8/0,4)) . . . + ((0,8/0,4) x ln(0,8/0,4)) = 0,995329</p>
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
                                    <tr>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                        <td>0,995329</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>- Total Nilai Entropy (E) = 4,911586</p>
                        </div>
                        <h5>5. Mencari Bobot Entropy Setiap Kriteria dengan Rumus :</h5>
                        <img src={'img/rumus/entropi 4.png'} alt="rumus entropy 4" style={{ height: '50px' }} className="ms-3 mb-3" />
                        <div className="container ms-5">
                            <p>- Peritungan Manual : </p>
                            <p className="ps-3">&#955;C1 = 1 / (10 - 4,911586) [1 - 0,995329] = 0,052834</p>
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
                                <tr>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                    <td>0,995329</td>
                                </tr>
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
                            <p className="ms-3 mb-3">X<sub>11</sub><sup>*</sup> = 0,4 / &radic; <span className=" border-top border-black">(0,4)<sup>2</sup> + (0,4)<sup>2</sup> + (0,4)<sup>2</sup> + (0,4)<sup>2</sup> + (0,4)<sup>2</sup> + (0,4)<sup>2</sup> + (0,4)<sup>2</sup> + (0,4)<sup>2</sup> + (0,4)<sup>2</sup></span>  = 0,222222</p>

                            <p>- Tabel Hasil Normalisasi : </p>
                            <table className="table table-bordered my-3 table-striped ms-3" style={{ width: '80%' }}>
                                <thead className="text-center table-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
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
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Rafif Alaudin</td>
                                        <td>0,2222</td>
                                        <td>0,4323</td>
                                        <td>0,5544</td>
                                        <td>0,2534</td>
                                        <td>0,4545</td>
                                        <td>0,4755</td>
                                        <td>0,2343</td>
                                        <td>0,5453</td>
                                        <td>0,3543</td>
                                        <td>0,2343</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Raka Bagas Fitriansyah</td>
                                        <td>0,4323</td>
                                        <td>0,4545</td>
                                        <td>0,5544</td>
                                        <td>0,2222</td>
                                        <td>0,4755</td>
                                        <td>0,2534</td>
                                        <td>0,2343</td>
                                        <td>0,2343</td>
                                        <td>0,3543</td>
                                        <td>0,5453</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Thirsya Widya Sulaiman</td>
                                        <td>0,5544</td>
                                        <td>0,2222</td>
                                        <td>0,4755</td>
                                        <td>0,2534</td>
                                        <td>0,5453</td>
                                        <td>0,4545</td>
                                        <td>0,4323</td>
                                        <td>0,2343</td>
                                        <td>0,2343</td>
                                        <td>0,3543</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5>2. Optimasi Kriteria dengan rumus : </h5>
                        <div className="ps-3">
                            <div className="container ms-3 mb-3">
                                <p>- Untuk Kriteria Benefit</p>
                                <p className="ms-3">yi = X<sub>ij</sub><sup>*</sup> x W</p>
                                <p>- Untuk Kriteria Cost</p>
                                <p className="ms-3">yi = X<sub>ij</sub><sup>*</sup> x W x ( - 1 )</p>
                            </div>

                            <p>- Tabel Hasil Optimasi : </p>
                            <table className="table table-bordered my-3 table-striped ms-3" style={{ width: '80%' }}>
                                <thead className="text-center table-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
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
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Rafif Alaudin</td>
                                        <td>0,2222</td>
                                        <td>0,4323</td>
                                        <td>0,5544</td>
                                        <td>0,2534</td>
                                        <td>0,4545</td>
                                        <td>0,4755</td>
                                        <td>0,2343</td>
                                        <td>0,5453</td>
                                        <td>0,3543</td>
                                        <td>0,2343</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Raka Bagas Fitriansyah</td>
                                        <td>0,4323</td>
                                        <td>0,4545</td>
                                        <td>0,5544</td>
                                        <td>0,2222</td>
                                        <td>0,4755</td>
                                        <td>0,2534</td>
                                        <td>0,2343</td>
                                        <td>0,2343</td>
                                        <td>0,3543</td>
                                        <td>0,5453</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Thirsya Widya Sulaiman</td>
                                        <td>0,5544</td>
                                        <td>0,2222</td>
                                        <td>0,4755</td>
                                        <td>0,2534</td>
                                        <td>0,5453</td>
                                        <td>0,4545</td>
                                        <td>0,4323</td>
                                        <td>0,2343</td>
                                        <td>0,2343</td>
                                        <td>0,3543</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5>3. Perankingan Hasil Akhir </h5>
                        <div className="ps-3">
                            <p>-Perhitungan Manual : </p>
                            <p className="ms-3 mb-3"> Ahmad Rafif Alaudin  = 0,4432 + 0,4432 + 0,4432 + 0,4432 + 0,4432 + 0,4432 + 0,4432 + 0,4432 + 0,4432 + 0,4432  =  15,2322</p>

                            <p>- Tabel Hasil Perankingan : </p>
                            <table className="table table-bordered my-3 table-striped ms-3" style={{ width: '90%' }}>
                                <thead className="text-center table-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
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
                                        <th>Total</th>
                                        <th>Rank</th>
                                    </tr>
                                </thead>
                                <tbody className="text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Rafif Alaudin</td>
                                        <td>0,2222</td>
                                        <td>0,4323</td>
                                        <td>0,5544</td>
                                        <td>0,2534</td>
                                        <td>0,4545</td>
                                        <td>0,4755</td>
                                        <td>0,2343</td>
                                        <td>0,5453</td>
                                        <td>0,3543</td>
                                        <td>0,2343</td>
                                        <td>15,493</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Raka Bagas Fitriansyah</td>
                                        <td>0,4323</td>
                                        <td>0,4545</td>
                                        <td>0,5544</td>
                                        <td>0,2222</td>
                                        <td>0,4755</td>
                                        <td>0,2534</td>
                                        <td>0,2343</td>
                                        <td>0,2343</td>
                                        <td>0,3543</td>
                                        <td>0,5453</td>
                                        <td>13,4231</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Thirsya Widya Sulaiman</td>
                                        <td>0,5544</td>
                                        <td>0,2222</td>
                                        <td>0,4755</td>
                                        <td>0,2534</td>
                                        <td>0,5453</td>
                                        <td>0,4545</td>
                                        <td>0,4323</td>
                                        <td>0,2343</td>
                                        <td>0,2343</td>
                                        <td>0,3543</td>
                                        <td>11,289</td>
                                        <td>3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <button type="button" className="btn btn-success btn-lg text-white m-3" onClick={() => navigate('/history')} >History</button>


            </div>


        </>
    );
}

export default Langkah;