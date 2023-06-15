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

    const handleDetail = async (id, event) => {
        event.preventDefault();

        try {
            const response = await api.get('/history/' + id);
            const data = response.data; // Periksa properti data pada respons

            if (data) {
                navigate('/langkah', { state: { data } });
                // console.log(data);
            } else {
                throw new Error('Invalid response data');
            }
        } catch (error) {
            console.error(error);
        }

        // api.get('/history/' + id)
        //     .then(data => {
        //         navigate('/langkah', { state: { data } });
        //         // console.log(data);
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });
    };



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
                        {data.map((d, index) => (
                            <tr key={index}>
                                <td>{index + 1}</td>
                                <td>{d.judul_perhitungan}</td>
                                <td>{d.waktu_perhitungan}</td>
                                <td>
                                    <button className="btn btn-sm btn-info text-white" type="button" onClick={event => handleDetail(d.id_perhitungan, event)}>Detail</button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </>
    );
}

export default History