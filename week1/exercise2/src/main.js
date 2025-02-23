// Khi nhấn nút "Đổi ảnh đại diện"
function changeAvatar() {
    document.getElementById('avatarInput').click();
}

// Cập nhật ảnh đại diện khi người dùng chọn ảnh mới
function updateAvatar(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imageUrl = e.target.result;
            
            // Hiển thị ảnh mới
            document.querySelector('.avatar').src = imageUrl;

            // Lưu vào LocalStorage
            localStorage.setItem('avatarImage', imageUrl);
        };
        reader.readAsDataURL(file);
    }
}

// Kiểm tra và tải ảnh đại diện từ LocalStorage khi mở lại trang
document.addEventListener("DOMContentLoaded", function () {
    const savedAvatar = localStorage.getItem('avatarImage');
    if (savedAvatar) {
        document.querySelector('.avatar').src = savedAvatar;
    }
});

// Name
// Khi nhấn nút "Đổi tên", hiện hộp thoại để nhập tên mới
function editName() {
    const nameBox = document.getElementById('nameBox');
    const nameInput = document.getElementById('nameInput');

    nameBox.style.display = 'block'; 
    nameInput.value = document.getElementById('displayName').innerText; // Gán tên hiện tại vào input
    nameInput.focus(); // Đặt con trỏ vào ô input
}

// Lưu tên mới và cập nhật lại
function saveName() {
    const nameInput = document.getElementById('nameInput');
    const nameDisplay = document.getElementById('displayName');
    
    // Kiểm tra nếu người dùng nhập tên
    if (nameInput.value.trim() !== '') {
        nameDisplay.innerText = nameInput.value; // Cập nhật tên hiển thị
        localStorage.setItem('userName', nameInput.value); // Lưu tên mới vào localStorage
    }

    // Ẩn hộp thoại sau khi lưu tên
    document.getElementById('nameBox').style.display = 'none';
}

function cancelEdit() {
    document.getElementById('nameBox').style.display = 'none';
    document.getElementById('hobbiesBox').style.display = 'none';
}

// Hiển thị tên người dùng từ localStorage
window.onload = function() {
    const savedName = localStorage.getItem('userName');
    if (savedName) {
        document.getElementById('displayName').innerText = savedName;
    }
};

//hobbies
// function editHobbies() {
//     const hobbiesBox = document.getElementById('hobbiesBox');
//     // const nameInput = document.getElementById('nameInput');

//     hobbiesBox.style.display = 'block'; // Hiện hộp thoại
//     // nameInput.value = document.getElementById('displayHobbies').innerText; // Gán tên hiện tại vào input
//     // nameInput.focus(); // Đặt con trỏ vào ô input
//     hobbyList.innerHTML = ""; // Xóa danh sách cũ trước khi thêm mới
//     for (const key in hobbies) {
//         if (hobbies.hasOwnProperty(key)) {
//             const li = document.createElement("li");
//             li.textContent = hobbies[key];
//             hobbyList.appendChild(li);
//         }
//     }
//     document.getElementById("hobbyBox").classList.remove("hidden");

// }

const hobbies = {
    "1": "Hát",
    "2": "Đi du lịch",
    "3": "Chơi cầu lông"
}

// Lấy thẻ ul để thêm danh sách sở thích
const hobbyList = document.getElementById("hobbyList");

// Duyệt qua danh sách và thêm vào HTML
for (const key in hobbies) {
    if (hobbies.hasOwnProperty(key)) {
        const li = document.createElement("li");
        li.textContent = hobbies[key];
        hobbyList.appendChild(li);
    }
}
// Lấy danh sách sở thích từ localStorage 
let arrayHobby = JSON.parse(localStorage.getItem("arrayHobby")) || [
    "Hát",
    "Đi du lịch",
    "Chơi cầu lông"
];

// Hiển thị danh sách sở thích
function displayHobbies() {
    const hobbyList = document.getElementById("hobbyList");
    hobbyList.innerHTML = ""; // Xóa danh sách cũ

    arrayHobby.forEach((hobby) => {
        const li = document.createElement("li");
        li.textContent = hobby;
        hobbyList.appendChild(li);
    });
}

function editHobbies() {
    const hobbiesBox = document.getElementById("hobbiesBox");
    hobbiesBox.style.display = "block";

    const hobbyInputs = document.getElementById("hobbyInputs");
    hobbyInputs.innerHTML = ""; // Xóa danh sách cũ

    arrayHobby.forEach((hobby, index) => {
        const div = document.createElement("div");

        // Ô nhập sở thích
        const input = document.createElement("input");
        input.type = "text";
        input.value = hobby;
        input.dataset.index = index; // Đánh dấu vị trí

        // Nút xóa
        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Xóa";
        deleteButton.onclick = () => deleteHobby(index);

        div.appendChild(input);
        div.appendChild(deleteButton);
        hobbyInputs.appendChild(div);
    });
}

// Thêm ô nhập sở thích 
function addHobbyInput() {
    const hobbyInputs = document.getElementById("hobbyInputs"); //lấy ra ptu ô nhập sở thích
    const div = document.createElement("div"); //tạo 1 thẻ div mới 
    //thêm html vào thẻ div mới tạo
    div.innerHTML = ` 
        <input type="text" placeholder="Nhập sở thích mới">
        <button class="deleteHobby">Xóa</button>
    `;

    hobbyInputs.appendChild(div); //thêm nó vào div "hobbiesInputs"
}
// Lắng nghe sự kiện click cho tất cả nút xóa
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("deleteHobby")) {
        event.target.parentElement.remove();
    }
});


// Lưu sở thích vào localStorage
function saveHobbies() {
    const hobbyInputs = document.querySelectorAll("#hobbyInputs input");
    arrayHobby = Array.from(hobbyInputs)
        .map(input => input.value.trim())
        .filter(hobby => hobby !== ""); // Lọc bỏ ô trống

    localStorage.setItem("arrayHobby", JSON.stringify(arrayHobby)); // Lưu vào localStorage
    document.getElementById("hobbiesBox").style.display = "none";
    displayHobbies(); // Cập nhật danh sách
}

function deleteHobby(index) {
    arrayHobby.splice(index, 1);
    editHobbies();
    saveHobbies();
}

function cancelEdit() {
    document.getElementById("hobbiesBox").style.display = "none";
}

displayHobbies();
