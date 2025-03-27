<?php
$conn = new mysqli("localhost", "root", "", "QL_NhanSu");
$conn->set_charset("utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
            VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', '$luong')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Nhân Viên</title>
</head>
<body>
    <h2>Thêm Nhân Viên</h2>
    <form method="post">
        Mã NV: <input type="text" name="ma_nv" required><br>
        Tên NV: <input type="text" name="ten_nv" required><br>
        Giới tính: 
        <select name="phai">
            <option value="NAM">Nam</option>
            <option value="NU">Nữ</option>
        </select><br>
        Nơi Sinh: <input type="text" name="noi_sinh" required><br>
        Mã Phòng: <input type="text" name="ma_phong" required><br>
        Lương: <input type="number" name="luong" required><br>
        <button type="submit">Thêm</button>
    </form>
</body>
</html>
