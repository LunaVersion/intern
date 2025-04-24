import React from "react";
// import {Link} from 'react-router-dom';

function TextareaInput({name, value, handleChange}) {
    // const [text, setText] = React.useState("");
    // const handleChange = (e) => {
    //     setText(e.target.value);
    // };
    // const handleSubmit = () => {
    //     alert("Nội dung bạn đã nhập: " + text);
    //   };
    return (
        <div className="textarea-input container">
            {/* <h1>Textarea Input</h1> */}
            <p>Mô tả về kinh nghiệm làm việc của bạn:</p>
            <textarea rows="4" cols="50" placeholder="Nhập nội dung vào đây..."
            name={name}
            value={value}
            onChange = {handleChange}
            className="form-control"
            ></textarea>
            <br />
            {/* <button hidden onClick={handleSubmit}>Gửi</button> */}
            {/* <p>Nội dung đã nhập: {text}</p> */}
            {/* <input type="submit" value="Submit" /> */}
            {/* <div style={{ marginTop: "20px" }}>
                <Link to="/">Quay về trang chủ</Link>
                <br />
                <Link to="/inputtext">Input text</Link>
                <br />
                <Link to="/checkbox">Input checkbox</Link>
                <br />
                <Link to="/radiobutton">Input radio</Link>
                <br />
                <Link to="/datepicker">Input datepicker</Link>
                <br />
                <Link to="/multiple">Input multiple select</Link>
            </div> */}
        </div>
    );
}
export default TextareaInput;