<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "QL_NhanSu");
$conn->set_charset("utf8");

$sql = "SELECT NV.*, PB.Ten_Phong FROM nhanvien NV JOIN phongban PB ON NV.Ma_Phong = PB.Ma_Phong";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Nhân Viên</title>
</head>
<body>
    <h2>Xin chào, <?= $_SESSION['username'] ?> (User)</h2>
    <table border="1">
        <tr>
            <th>Mã NV</th><th>Tên</th><th>Giới Tính</th><th>Nơi Sinh</th><th>Phòng</th><th>Lương</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['Ma_NV'] ?></td>
            <td><?= $row['Ten_NV'] ?></td>
            <td><img src="<?= $row['Phai'] == 'NU' ? 'woman.jpg' : 'man.jpg' ?>" width="30"></td>
            <td><?= $row['Noi_Sinh'] ?></td>
            <td><?= $row['Ten_Phong'] ?></td>
            <td><?= $row['Luong'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="logout.php">Đăng Xuất</a>
</body>
</html>
