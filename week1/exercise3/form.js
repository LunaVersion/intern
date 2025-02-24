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

    // Validate ngày sinh 
    if (!ngaySinh || new Date(ngaySinh) >= new Date()) {
        showError("ngay_sinh", "Ngày sinh không hợp lệ.");
        isValid = false;
    }

    // Validate số điện thoại 
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

    // Validate giới tính
    if (!gender) {
        showError("gender", "Vui lòng chọn giới tính.");
        isValid = false;
    }

    // Validate địa chỉ
    if (address.length < 5) {
        showError("address", "Địa chỉ phải có ít nhất 5 ký tự.");
        isValid = false;
    }

    if (isValid) {
        NhanVien.ho_ten = hoTen;
        NhanVien.ngay_sinh = ngaySinh;
        NhanVien.so_dien_thoai = sdt;
        NhanVien.email = email;
        NhanVien.gender = gender;
        NhanVien.address = address;

        console.log("Dữ liệu nhân viên đã lưu:", NhanVien);
        alert("Gửi form thành công!");
    }
});

//keyup
document.getElementById("form").addEventListener("keyup", function(event) {
    if (event.target.tagName === "INPUT" || event.target.tagName === "SELECT") {
        let input = event.target.name;
        NhanVien[input] = event.target.value.trim();
        console.log(NhanVien); // kiểm tra
    }
});

// nếu ng dùng thay đổi giới tính thì vẫn cập nhật
document.getElementById("gender").addEventListener("change", function() {
    NhanVien.gender = this.value;
    console.log(NhanVien);
});

// document.querySelectorAll("input").forEach(input => {
//     input.addEventListener("keyup", function () {
//         validateInput(this.id);
//     });
// });

// Hàm hiển thị lỗi
function showError(inputId, message) {
    let inputElement = document.getElementById(inputId);
    let errorElement = document.createElement("div");
    errorElement.className = "error text-danger";
    errorElement.innerText = message;
    inputElement.parentNode.appendChild(errorElement);
}
