import React from "react";

export const Team = (props) => {
  return (
    <div id="team" className="">
      <div className="container">
        <div className="section-title text-center">
          <h2>Meet the Team</h2>
          <p>
            Team Kami Terdiri dari 3 Mahasiswa Politeknik Negeri Malang.
          </p>
        </div>
        <div id="d-flex justify-content-center">
          <center>
            {props.data
              ? props.data.map((d, i) => (
                <div key={`${d.name}-${i}`} className="p-2 d-inline-block mx-3">
                  <img src={d.img} alt="..." className="team-img" />
                  <div className="caption">
                    <h4>{d.name}</h4>
                    <p>{d.job}</p>
                  </div>
                </div>
              ))
              : "loading"}
          </center>
        </div>
      </div>
    </div>
  );
};
