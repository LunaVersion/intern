<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
  <style>
        .form-select {
          border: 1px solid #dbdbdb;
          padding: 10px;
          width: 100%;
        }
        .query {
          background-color:white;
          border: none;
        }
  </style>
</head>

<body>
  <div class="container col-md-5 my-5 py-3 px-4 border">
      <form action="http://localhost:8000/Staff/store" method="POST">
        <div id="nhan-vien" style="display: block;">
          <h4 class="text-center">Nhập thông tin nhân viên</h4>
          <br>
          <div class="mb-3">
            <label for="ho-ten" class="form-label">Họ tên</label>
            <input type="text" class="form-control" id="ho-ten" name="ho-ten">
          </div>
          <div class="mb-3">
            <label for="ngay-sinh" class="form-label">Ngày sinh</label>
            <input type="date" class="form-control" id="ngay-sinh" name='ngay-sinh'>
          </div>
          <div class="mb-3">
            <label for="gioi-tinh" class="form-label">Giới tính</label>
            <input type="text" class="form-control" id="gioi-tinh" name='gioi-tinh'>
          </div>
          <div class="mb-3">
            <label for="so-dien-thoai" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="so-dien-thoai" name="so-dien-thoai">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name = "email">
          </div>
          <div class="mb-3">
            <label for="dia-chi" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="dia-chi" name = "dia-chi">
          </div>
          <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label> <br>
            <input type="file" class="file-input" id="avatar" name = "avatar">
          </div>
          <button type="button" class="btn btn-primary" onclick="next1()">Tiếp</button>
        </div>
        <div id="phong-ban" style="display: none;">
          <h4 class="text-center my-3">Nhập thông tin phòng ban</h4>
          <div class="mb-3">
            <label for="ten-phong-ban" class="form-label">Tên phòng ban</label> <br>
            <select class="form-select form-select-lg mb-3" id="ten-phong-ban" name = "id-phong-ban">
              <option selected>Chọn tên phòng ban</option>
              <option value="1">IT 1</option>
              <option value="2">IT 2</option>
              <option value="3">Kế toán</option>
            </select>
          </div>
          <button type="button" class="btn btn-primary" onclick="back2()">Quay lại</button>
          <button type="button" class="btn btn-primary" onclick="next2()">Tiếp</button>
        </div>
        <div id="luong"  style="display: none;">
          <h4 class="text-center my-3">Nhập thông tin lương</h4>
          <div class="mb-3">
            <label for="so-tien-luong" class="form-label">Số tiền lương</label>
            <input type="text" class="form-control" id="so-tien-luong" name = "so-tien-luong">
          </div>
          <div class="mb-3">
            <label for="thang-nhan-luong" class="form-label">Tháng nhận lương</label>
            <input type="date" class="form-control" id="thang-nhan-luong" name = "thang-nhan-luong">
          </div>
          <button type="button" class="btn btn-primary" onclick="back3()">Quay lại</button>
          <button type="button" class="btn btn-primary" onclick="next3()">Tiếp</button>
        </div>
        <div id="nhan-vien-phong-ban" style="display: none;">
          <h4 class="text-center my-3">Nhập thông tin nhân viên phòng ban</h4>
          <div class="mb-3">
            <label for="chuc-vu" class="form-label">Chức vụ</label>
            <input type="text" class="form-control" id="chuc-vu" name = "chuc-vu">
          </div>
          <button type="button" class="btn btn-primary" onclick="back4()">Quay lại</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <div class="container col-md-4">
    <!-- <button type="button" class='query'>
      <a href="http://localhost:8000/home/query">Chuyển sang trang truy vấn</a>
    </button> -->
    <a href="../../home/query" class="btn btn-primary">Chuyển sang trang truy vấn</a>
  </div>
</body>
<script>
  function next1() {
      let div1 = document.getElementById("nhan-vien");
      let div2 = document.getElementById("phong-ban");
      if(div1.style.display === "block"){
        div1.style.display = "none";
        div2.style.display = "block";
      }
  }
  function next2() {
      let div2 = document.getElementById("phong-ban");
      let div3 = document.getElementById("luong");
      if(div2.style.display === "block") {
        div2.style.display = "none";
        div3.style.display = "block";
      }
  }
  function next3() {
      let div3 = document.getElementById("luong");
      let div4 = document.getElementById("nhan-vien-phong-ban");
      if(div3.style.display === "block") {
        div3.style.display = "none";
        div4.style.display = "block";
      }
  }
  function back2() {
      let div1 = document.getElementById("nhan-vien");
      let div2 = document.getElementById("phong-ban");
      if(div2.style.display === "block"){
        div2.style.display = "none";
        div1.style.display = "block";
      }
  }
  function back3() {
      let div2 = document.getElementById("phong-ban");
      let div3 = document.getElementById("luong");
      if(div3.style.display === "block") {
        div3.style.display = "none";
        div2.style.display = "block";
      }
  }
  function back4() {
      let div3 = document.getElementById("luong");
      let div4 = document.getElementById("nhan-vien-phong-ban");
      if(div4.style.display === "block") {
        div4.style.display = "none";
        div3.style.display = "block";
      }
  }
</script>
</html>