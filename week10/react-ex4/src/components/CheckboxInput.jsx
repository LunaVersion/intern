import React from "react";
// import { Link } from 'react-router-dom';
function CheckboxInput({selectedCheckboxes,handleCheckboxChange}) {
    // khai báo state để lưu trữ các checkbox đã chọn
    // const [selectedCheckboxes, setSelectedCheckboxes] = React.useState([]);
    // // hàm xử lý sự kiện khi checkbox thay đổi
    // const handleCheckboxChange = (event) => {
    //     const { value, checked } = event.target;
    //     if (checked) {
    //         setSelectedCheckboxes(prev => [...prev, value]);
    //     } else {
    //         setSelectedCheckboxes(prev => prev.filter(item => item !== value));
    //     }
    // };

    // const handleSubmit = (event) => {
    //     event.preventDefault();
    //     alert("Sở thích của bạn là: " + selectedCheckboxes.join(", ") + "!");
    // };

    const options = [
        "bơi lội", "chơi cầu lông", "đá bóng", 
        "ca hát nhảy múa", "vẽ", "đi du lịch", "đi leo núi"
    ];
    return (
        <div className="checkbox-input">
            {/* <h1>Checkbox Input</h1> */}
            <p>Chọn các sở thích của bạn</p>
            <div style={{ display: 'flex', justifyContent: 'center', marginTop: '3px' }}>
                {/* <form onSubmit={handleSubmit}> */}
                    {/* <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'flex-start', gap: '8px' }}>
                        <div style={{ display: 'flex', alignItems: 'center' }}>
                            <input type="checkbox" id="checkbox1" name="checkbox" value="bơi lội" onChange={handleCheckboxChange} />
                            <label htmlFor="checkbox1" style={{ marginLeft: '8px' }}>Bơi lội</label>
                        </div>

                        <div style={{ display: 'flex', alignItems: 'center' }}>
                            <input type="checkbox" id="checkbox2" name="checkbox" value="chơi cầu lông" onChange={handleCheckboxChange} />
                            <label htmlFor="checkbox2" style={{ marginLeft: '8px' }}>Chơi cầu lông</label>
                        </div>

                        <div style={{ display: 'flex', alignItems: 'center' }}>
                            <input type="checkbox" id="checkbox3" name="checkbox" value="đá bóng" onChange={handleCheckboxChange} />
                            <label htmlFor="checkbox3" style={{ marginLeft: '8px' }}>Đá bóng</label>
                        </div>

                        <div style={{ display: 'flex', alignItems: 'center' }}>
                            <input type="checkbox" id="checkbox4" name="checkbox" value="ca hát nhảy múa" onChange={handleCheckboxChange} />
                            <label htmlFor="checkbox4" style={{ marginLeft: '8px' }}>Ca hát nhảy múa</label>
                        </div>

                        <div style={{ display: 'flex', alignItems: 'center' }}>
                            <input type="checkbox" id="checkbox5" name="checkbox" value="vẽ" onChange={handleCheckboxChange} />
                            <label htmlFor="checkbox5" style={{ marginLeft: '8px' }}>Vẽ</label>
                        </div>

                        <div style={{ display: 'flex', alignItems: 'center' }}>
                            <input type="checkbox" id="checkbox6" name="checkbox" value="đi du lịch" onChange={handleCheckboxChange} />
                            <label htmlFor="checkbox6" style={{ marginLeft: '8px' }}>Đi du lịch</label>
                        </div>

                        <div style={{ display: 'flex', alignItems: 'center' }}>
                            <input type="checkbox" id="checkbox7" name="checkbox" value="đi leo núi" onChange={handleCheckboxChange} />
                            <label htmlFor="checkbox7" style={{ marginLeft: '8px' }}>Đi leo núi</label>
                        </div>
                    </div> */}
                    {/* <button type="submit">Submit</button> */}
                {/* </form> */}
            </div>

            <div style={{ display: 'flex', justifyContent: 'center', marginTop: '3px' }}>
                <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'flex-start', gap: '8px' }}>
                    {options.map((option, index) => (
                        <div style={{ display: 'flex', alignItems: 'center' }} key={index}>
                            <input
                                type="checkbox"
                                id={`checkbox${index + 1}`}
                                name="checkbox"
                                value={option}
                                checked={selectedCheckboxes.includes(option)} // Kiểm tra xem checkbox này có được chọn không
                                onChange={handleCheckboxChange} // Hàm xử lý sự thay đổi checkbox
                            />
                            <label htmlFor={`checkbox${index + 1}`} style={{ marginLeft: '8px' }}>
                                {option}
                            </label>
                        </div>
                    ))}
                </div>
            </div>
            
            {/* <div style={{ marginTop: "20px" }}>
                <Link to="/">Quay về trang chủ</Link>
                <br />
                <Link to="/inputtext">Input text</Link>
                <br />
                <Link to="/radiobutton">Input radio</Link>
                <br />
                <Link to="/textarea">Input textarea</Link>
                <br />
                <Link to="/multiple">Input multiple select</Link>
                <br />
                <Link to="/datepiker">Input datepicker</Link>
            </div> */}
        </div>
    );
}
export default CheckboxInput;