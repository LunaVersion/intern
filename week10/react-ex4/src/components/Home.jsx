import React from "react";
import { Link } from 'react-router-dom';

function Home() {
  return (
        <div className="home">
            <h1>Trang chủ</h1>
            <p>Chọn để xem ví dụ component input</p>
            <br />
            <div>
                <Link to="/inputtext">Input text</Link>
                <br />
                <Link to="/checkbox">Input checkbox</Link>
                <br />
                <Link to="/radiobutton">Input radio</Link>
                <br />
                <Link to="/textarea">Input textarea</Link>
                <br />
                <Link to="/multiple">Input multiple select</Link>
                <br />
                <Link to="/datepicker">Input datepicker</Link>
            </div>
            
        </div>      
  );
}
export default Home;