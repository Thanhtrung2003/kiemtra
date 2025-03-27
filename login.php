<?php
session_start();
$conn = new mysqli("localhost", "root", "", "QL_NhanSu");
$conn->set_charset("utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM nguoidung WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $nguoidung = $result->fetch_assoc();
        $_SESSION['username'] = $nguoidung['username'];
        $_SESSION['role'] = $nguoidung['role'];
        header("Location: " . ($nguoidung['role'] == 'admin' ? 'admin.php' : 'user.php'));
    } else {
        echo "<script>alert('Sai tài khoản hoặc mật khẩu!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
</head>
<body>
    <h2>Đăng Nhập</h2>
    <form method="post">
        <label>Tài khoản:</label> <input type="text" name="username" required><br>
        <label>Mật khẩu:</label> <input type="password" name="password" required><br>
        <button type="submit">Đăng Nhập</button>
    </form>
</body>
</html>
