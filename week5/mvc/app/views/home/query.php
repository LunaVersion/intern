<?php 
$staffList = $data['staffList'] ?? [];
$staffWithDepartment = $data['staffWithDepartment'] ?? [];
$totalSalary = $data['totalSalary'] ?? "0";
$month = $_POST['month'] ?? null; 
$year = $_POST['year'] ?? null; 

?>
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
        .btn {
          /* background-color:white; */
        }
  </style>
</head>
<body>
    <div class="container col-md-7 my-5 py-3 px-4 border">
        <div class="select-query my-5">
            <!-- không nhất thiết dùng form, có thể dùng js điều hướng hoặc fetch api -->
            <form id="queryForm" action="http://localhost:8000/Staff/test">
                <h5>Các truy vấn</h5>
                <select class="form-select " id="select" name = "select" onchange='handleChange()'>
                <option selected>Chọn truy vấn</option>
                <option value="1">Lấy danh sách nhân viên và phòng ban của họ</option>
                <option value="2">Lấy danh sách các nhân viên trong mỗi phòng ban</option>
                </select>
            </form>
        </div>
            <div class="show-query-1 my-5" style="display: none;" id='1'>
                    <table class='table border'>
                        <thead>
                            <tr>
                                <th>ID nhân viên</th>
                                <th>Họ tên</th>
                                <th>Id phòng ban</th>
                                <th>Tên phòng ban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($staffList as $staff) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($staff['id_nhan_vien']); ?></td>
                                    <td><?php echo htmlspecialchars($staff['ho_ten']); ?></td>
                                    <td><?php echo htmlspecialchars($staff['id_phong_ban']); ?></td>
                                    <td><?php echo htmlspecialchars($staff['ten_phong_ban']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>            
            </div>
            <div class="show-query-2 my-5" style="display: none;" id='2'>
                <h4>Lấy danh sách các nhân viên trong mỗi phòng ban</h4>
                <table class='table border'>
                    <thead>
                        <tr>
                            <th>Id phòng ban</th>
                            <th>Tên phòng ban</th>
                            <th>ID nhân viên</th>
                            <th>Họ tên</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staffWithDepartment as $staff) : ?>
                                <tr>
                                <td><?php echo $staff['id_phong_ban']; ?></td>
                                <td><?php echo $staff['ten_phong_ban']; ?></td>
                                    <td><?php echo $staff['id_nhan_vien']; ?></td>
                                    <td><?php echo $staff['ho_ten']; ?></td>
                                </tr>
                            <?php endforeach;
                         ?>
                    </tbody>
                </table>
            </div>
    </div>
    <div class="container col-md-7 my-5 py-3 px-4 border">
            <form id="salaryForm" method="POST" action="http://localhost:8000/Staff/test">
                <h5>Tổng lương của nhân viên trong 1 tháng</h5>
                <div class="date">
                    <label for="month" class="form-label">Nhập tháng</label>
                    <input type="number" class="form-control" id="month" name="month" required min="1" max="12">
                    
                    <label for="year" class="form-label">Nhập năm</label>
                    <input type="number" class="form-control" id="year" name="year" required min="2000">
                </div>

                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </form>
            <div id="resultTotalSalary" class="mt-3">
                <?php if ($month && $year): ?>
                    <p>Tổng lương tháng <?php echo htmlspecialchars($month); ?> /
                    <?php echo htmlspecialchars($year); ?> là: 
                    <?php echo number_format($totalSalary); ?> VNĐ</p>
                <?php endif; ?>
            </div>
        </div>
    <div class="container col-md-4">
        <a href="../../home/index" class="btn btn-primary">Quay lại thêm thông tin nhân viên</a>
    </div>
</body>
<script>
    function handleChange() {
        let query = document.getElementById("select");
        let result1 = document.getElementById("1");
        let result2 = document.getElementById("2");
        switch (query.value) {
            case "1":
                result1.style.display = "block";
                result2.style.display = "none";
                //form.submit(); 
                break;
            case "2":
                result2.style.display = "block";
                result1.style.display = "none";
                //form.submit(); 
                break;
            default:
                result1.style.display = "none";
                result2.style.display = "none";
                break;
        }
    }
    
</script>
</html>