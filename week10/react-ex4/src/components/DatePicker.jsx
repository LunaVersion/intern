import { useEffect, useRef, useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css";
import "bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js";
import $ from "jquery";
import "bootstrap-datepicker";
import React from "react";
// import { Link } from "react-router-dom";
// Datepicker đang dựa vào jquery để gắn datepicker chứ không phải input thuần
// => không hoạt động giống input text
// => chỉ truyền onchange cho cha
function DatePicker({handleDateChange}) {
    // tạo ref để tham chiếu đến input datepicker
    const dateInputRef = useRef(null);
    // state lưu ngày đã chọn
    const [selectedDate, setSelectedDate] = useState("");

    useEffect(() => {
    const $dateInputRefCurrent = $(dateInputRef.current);

        // jquery gắn datepicker vào input có ref dateInputRef
        $dateInputRefCurrent.datepicker({
            format: "dd/mm/yyyy",
            // không chọn ngày tương lai
            endDate: new Date(),
            autoclose: true,
            todayHighlight: true,
        }).on("changeDate", function (e) {
            const formattedDate = e.format(0, "dd/mm/yyyy");
            setSelectedDate(formattedDate);
            if (handleDateChange) handleDateChange(formattedDate); // gọi callback
        });
        return () => {
            // hủy gắn datepicker khi component unmount
            $dateInputRefCurrent.datepicker("destroy");
        }
        // handelDateChange là hàm truyền từ cha xuống (là một prop truyền vào)
        // phải thêm vào dependency array của useEffect để tránh cảnh báo eslint
        // đảm bảo mỗi lần handleDateChange thay đổi thì useEffect sẽ chạy lại
    }, [handleDateChange]);

    // ------------------------------------------
    // date range picker
    // state lưu giá trị đã chọn 
    // const startDateRef = useRef('');
    // const endDateRef = useRef('');
    // const [startDate, setStartDate] = useState('');
    // const [endDate, setEndDate] = useState('');

    // useEffect(() => {
    //     // gắn datepicker vào input có id startDate
    //     // sử dụng jQuery để khởi tạo datepicker
    //     $(startDateRef.current).datepicker({
    //         format: 'yyyy-mm-dd',
    //         startDate: new Date(), // Giới hạn: không chọn ngày quá khứ
    //         autoclose: true,
    //         todayHighlight: true,
    //     }).on('changeDate', (e) => {
    //         setStartDate(e.format());
    //     });

    //     // Khởi tạo datepicker cho end date
    //     $(endDateRef.current).datepicker({
    //         format: 'yyyy-mm-dd',
    //         startDate: new Date(), // Giới hạn: không chọn ngày quá khứ
    //         autoclose: true,
    //         todayHighlight: true,
    //     }).on('changeDate', (e) => {
    //         setEndDate(e.format());
    //     });
    // }, []);

    return (
        <div className="date-picker container mt-5">
            <p>Chọn ngày sinh của bạn</p>
            <input type="text" className="form-control"
                name="dateInputRef"
                placeholder="Chọn ngày sinh"
                ref={dateInputRef} />
            {/* nếu có ngày đã chọn thì mới alert */}
            {selectedDate && (
                <div className="alert">
                    Ngày sinh của bạn là: <strong>{selectedDate}</strong>
                </div>
            )}

            {/* ---------------------------- */}
            {/* <p className="mt-5">Chọn khoảng thời gian </p>
            <div className="form-group">
                <label></label>
                <input type="text" ref={startDateRef} className="form-control" placeholder="Chọn ngày bắt đầu" />
            </div>

            <div className="form-group">
                <label></label>
                <input type="text" ref={endDateRef} className="form-control" placeholder="Chọn ngày kết thúc" />
            </div>

            {startDate && endDate && (
                <div className="alert ">
                    Bạn đã chọn từ ngày <strong>{startDate}</strong> đến ngày <strong>{endDate}</strong>
                </div>
            )} */}

            {/* <div>
                <Link to="/inputtext">Input text</Link>
                <br />
                <Link to="/checkbox">Input checkbox</Link>
                <br />
                <Link to="/radiobutton">Input radio</Link>
                <br />
                <Link to="/textarea">Input textarea</Link>
                <br />
                <Link to="/multiple">Input multiple select</Link>
            </div> */}
        </div>
    );
}
export default DatePicker;