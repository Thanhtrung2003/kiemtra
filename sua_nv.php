<?php
$conn = new mysqli("localhost", "root", "", "QL_NhanSu");
$conn->set_charset("utf8");

if (isset($_GET['edit'])) {
    $ma_nv = $_GET['edit'];
    $result = $conn->query("SELECT * FROM nhanvien WHERE Ma_NV = '$ma_nv'");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    $sql = "UPDATE nhanvien SET 
            Ten_NV='$ten_nv', Phai='$phai', Noi_Sinh='$noi_sinh', Ma_Phong='$ma_phong', Luong='$luong' 
            WHERE Ma_NV='$ma_nv'";

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
    <title>Sửa Nhân Viên</title>
</head>
<body>
    <h2>Sửa Nhân Viên</h2>
    <form method="post">
        <input type="hidden" name="ma_nv" value="<?= $row['Ma_NV'] ?>">
        Tên NV: <input type="text" name="ten_nv" value="<?= $row['Ten_NV'] ?>" required><br>
        Giới tính: 
        <select name="phai">
            <option value="NAM" <?= $row['Phai'] == 'NAM' ? 'selected' : '' ?>>Nam</option>
            <option value="NU" <?= $row['Phai'] == 'NU' ? 'selected' : '' ?>>Nữ</option>
        </select><br>
        Nơi Sinh: <input type="text" name="noi_sinh" value="<?= $row['Noi_Sinh'] ?>" required><br>
        Mã Phòng: <input type="text" name="ma_phong" value="<?= $row['Ma_Phong'] ?>" required><br>
        Lương: <input type="number" name="luong" value="<?= $row['Luong'] ?>" required><br>
        <button type="submit">Cập Nhật</button>
    </form>
</body>
</html>
