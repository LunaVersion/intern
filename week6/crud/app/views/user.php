<?php $users = $data['users'] ?? []; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .button {
            background-color: none;
            border: none;
        }
        .bx {
            transform: scale(1.25);
        }
        #form {
            display: none;
            position: fixed;
            top: 50%;
            left:55%;
            background-color: white;
            transform: translate(-50%, -50%);
            background: white;
            z-index: 1001;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
        }
        .edit {
            position: fixed;
            top: 50%;
            left:55%;
            background-color: white;
            transform: translate(-50%, -50%);
            background: white;
            z-index: 1001;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
        }
        .delete {
            position: fixed;
            top: 50%;
            left:55%;
            background-color: white;
            transform: translate(-50%, -50%);
            background: white;
            z-index: 1001;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
        }
    
        .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        }
        /* Hiện form khi bấm vào nút */
        #form:target {
            display: block;
        }

        /* Hiện overlay khi form mở */
        #form:target ~ #overlay {
            display: block;
        }
        .table {
            overflow-y: scroll;
            max-height: 500px;
        }
    </style>
</head>
<body>
    <div class="container col-lg-8 mt-5 pt-5">
        <h3>Danh sách người dùng</h3>
        <a href="#form" id="showForm" class="btn btn-primary my-3">Thêm Người Dùng</a>
        <div class="table">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="px-4">ID</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="px-4"><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                            <button class="btn btn-warning btn-edit"
                                    data-id="<?= $user['id'] ?>"
                                    data-name="<?= $user['name'] ?>"
                                    data-email="<?= $user['email'] ?>">
                                Sửa
                            </button>
                            <button class="btn btn-warning btn-delete"
                                    data-id="<?= $user['id'] ?>"
                                    data-name="<?= $user['name'] ?>"
                                    data-email="<?= $user['email'] ?>">
                                Xóa
                            </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- <a href="../../link" class="btn btn-primary">Chuyển</a> -->
    </div>

    <div class="container form col-5 px-5 py-5 border" id="form">
        <form action="http://localhost:8000/store" method="POST">
            <h4 class="text-center">Nhập thông tin người dùng mới</h4>
            <br>
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="name" name="name" autocomplete="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name='email' autocomplete="email">
            </div>
            <a href="#" class="btn btn-secondary">Close</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="container edit col-5 px-5 py-5 border d-none" id="edit-form">
        <form action="http://localhost:8000/update" method="POST">
            <h4 class="text-center">Sửa thông tin người dùng</h4>
            <input type="hidden" id="edit-id" name="id">

            <div class="mb-3">
                <label for="edit-name" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="edit-name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="edit-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="edit-email" name="email" required>
            </div>

            <a href="#" class="btn btn-secondary btn-edit-close">Đóng</a>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

    <div id="delete-form" class="container edit col-5 px-5 py-5 border d-none">
        <p>Bạn có chắc chắn muốn xóa người dùng "<span id="delete-name"></span>" không?</p>
        <form action="http://localhost:8000/delete" method="POST">
            <input type="hidden" name="id" id="delete-id">
            <button type="button" class="btn btn-secondary btn-delete-close">Hủy</button>
            <button type="submit" class="btn btn-danger">Xóa</button>
        </form>
    </div>

    <div id="overlay" class="overlay"></div>

</body>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const editForm = document.getElementById("edit-form");
    const editId = document.getElementById("edit-id");
    const editName = document.getElementById("edit-name");
    const editEmail = document.getElementById("edit-email");
    const closeBtn = document.querySelector(".btn-edit-close");

    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", function () {
            // Lấy dữ liệu từ nút "Sửa"
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");
            const email = this.getAttribute("data-email");

            // Gán dữ liệu vào form
            editId.value = id;
            editName.value = name;
            editEmail.value = email;

            // Hiển thị form sửa
            editForm.classList.remove("d-none");
        });
    });

    // Ẩn form khi nhấn "Close"
    closeBtn.addEventListener("click", function () {
        editForm.classList.add("d-none");
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const deleteForm = document.getElementById("delete-form");
    const deleteId = document.getElementById("delete-id");
    const deleteName = document.getElementById("delete-name");
    const deleteCloseBtn = document.querySelector(".btn-delete-close");

    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function () {
            // Lấy dữ liệu từ nút "Xóa"
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");

            // Gán dữ liệu vào form xóa
            deleteId.value = id;
            deleteName.textContent = name;

            // Hiển thị form xác nhận xóa
            deleteForm.classList.remove("d-none");
        });
    });

    // Ẩn form khi nhấn "Close"
    deleteCloseBtn.addEventListener("click", function () {
        deleteForm.classList.add("d-none");
    });
});

</script>

</html>