import { Navback } from "../components/navback"
import React, { useState, useEffect } from 'react'
import { useNavigate } from "react-router-dom";
import axios from 'axios';


export const History = () => {
    const navigate = useNavigate()
    const [data, setData] = useState([]);

    useEffect(() => {
        fetchData();
    }, []);

    const api = axios.create({
        baseURL: 'http://127.0.0.1:8000/api',
        headers: {
            'Accept': 'application/json',
        },
    });

    const fetchData = async () => {
        try {
            const response = await api.get('/history');
            setData(response.data);
        } catch (error) {
            console.error(error);
        }
    };
    console.log(response)

    return (
        <>
            <Navback></Navback>
            <div className="container py-5">
                <h1 className="mb-5 ">Halaman History Pengerjaan</h1>
                <table className="table table-bordered mb-5 table-striped text-center" style={{ width: '75%' }}>
                    <thead className="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Judul Perhitungan</th>
                            <th>Tanggal Perhitungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Perhitungan 1</td>
                            <td>01/06/2023</td>
                            <td>
                                <button className="btn btn-sm btn-info text-white" type="button" onClick={() => navigate('/langkah')}>Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Perhitungan 2</td>
                            <td>01/06/2023</td>
                            <td>
                                <button className="btn btn-sm btn-info text-white" type="button" onClick={() => navigate('/langkah')}>Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Perhitungan 3</td>
                            <td>01/06/2023</td>
                            <td>
                                <button className="btn btn-sm btn-info text-white" type="button" onClick={() => navigate('/langkah')}>Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </>
    );
}

export default History