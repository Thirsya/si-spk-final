import React from "react";
import { useNavigate } from "react-router-dom";

export const Navigation = (props) => {
  const navigate = useNavigate()
  return (
    <nav id="menu" className="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div className="container px-5 ml-3">
        <a className="navbar-brand" href="#features">
          <h2 className="m-0">SISPK</h2>
        </a>
        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="navbar-text " id="navbarNav">
          <ul className="navbar-nav ml-auto">
            <li className="nav-item mx-3">
              <button className="nav-link fs-6" onClick={() => navigate('/hitung')}>HITUNG</button>
            </li>
            <li className="nav-item  mx-3">
              <a className="nav-link fs-6" href="#features">FITUR</a>
            </li>
            <li className="nav-item  mx-3">
              <a className="nav-link fs-6" href="#services">METODE</a>
            </li>
            <li className="nav-item  mx-3">
              <a className="nav-link fs-6" href="#about">TENTANG KAMI</a>
            </li>
            <li className="nav-item  mx-3">
              <a className="nav-link fs-6" href="#team">TEAM</a>
            </li>
            <li className="nav-item  mx-3">
              <a className="nav-link fs-6" href="#contact">CONTACT</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};
