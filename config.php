<?php
$servername = "localhost";
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL (để trống nếu mặc định)
$dbname = "ql_nhansu"; // Tên cơ sở dữ liệu

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>