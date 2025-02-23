let NhanVien = {
    ho_ten: "",
    ngay_sinh: "",
    so_dien_thoai: "",
    email: "",
    gender: "",
    address: ""
};

document.getElementById("form").addEventListener("submit", function(event) {
    event.preventDefault(); // Ngăn chặn gửi form nếu có lỗi
    let isValid = true;

    // Lấy giá trị input
    let hoTen = document.getElementById("ho_ten").value.trim();
    let ngaySinh = document.getElementById("ngay_sinh").value;
    let sdt = document.getElementById("sdt").value.trim();
    let email = document.getElementById("email").value.trim();
    let gender = document.getElementById("gender").value;
    let address = document.getElementById("address").value.trim();

    // Reset thông báo lỗi
    document.querySelectorAll(".error").forEach(e => e.remove());

    // Validate họ tên
    if (hoTen.length < 2) {
        showError("ho_ten", "Họ tên phải có ít nhất 2 ký tự.");
        isValid = false;
    }

    // Validate ngày sinh (không được lớn hơn ngày hiện tại)
    if (!ngaySinh || new Date(ngaySinh) >= new Date()) {
        showError("ngay_sinh", "Ngày sinh không hợp lệ.");
        isValid = false;
    }

    // Validate số điện thoại (10 chữ số)
    let phoneRegex = /^[0-9]{10}$/;
    if (sdt && !phoneRegex.test(sdt)) {
        showError("sdt", "Số điện thoại phải có 10 chữ số.");
        isValid = false;
    }

    // Validate email
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email && !emailRegex.test(email)) {
        showError("email", "Email không hợp lệ.");
        isValid = false;
    }

    // Validate giới tính (không được bỏ trống)
    if (!gender) {
        showError("gender", "Vui lòng chọn giới tính.");
        isValid = false;
    }

    // Validate địa chỉ
    if (address.length < 5) {
        showError("address", "Địa chỉ phải có ít nhất 5 ký tự.");
        isValid = false;
    }

    // Nếu hợp lệ, lưu vào đối tượng NhanVien
    if (isValid) {
        NhanVien.ho_ten = hoTen;
        NhanVien.ngay_sinh = ngaySinh;
        NhanVien.so_dien_thoai = sdt;
        NhanVien.email = email;
        NhanVien.gender = gender;
        NhanVien.address = address;

        console.log("Dữ liệu nhân viên đã lưu:", NhanVien);
        alert("Dữ liệu hợp lệ, đã lưu thành công!");
    }
});

// Hàm hiển thị lỗi
function showError(inputId, message) {
    let inputElement = document.getElementById(inputId);
    let errorElement = document.createElement("div");
    errorElement.className = "error text-danger";
    errorElement.innerText = message;
    inputElement.parentNode.appendChild(errorElement);
}
