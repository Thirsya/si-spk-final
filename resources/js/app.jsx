import React from "react";
import ReactDOM from "react-dom";

import "../css/app.css";
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import { Home } from "./Pages/Home.jsx";
import { Hitung } from "./Pages/Hitung.jsx"
import { createRoot } from 'react-dom';


export const App = () => {

  return (
    <Router>
      <Routes>
        <Route index element={<Home />} />
        <Route path="/hitung" element={<Hitung />} />
      </Routes>
    </Router>
  );
};

export default App;

if (document.getElementById('app')) {
  createRoot(document.getElementById('app')).render(<App />);
}
