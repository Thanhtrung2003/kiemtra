<?php
$conn = new mysqli("localhost", "root", "", "QL_NhanSu");
$conn->set_charset("utf8");

// Xóa nhân viên
if (isset($_GET['delete'])) {
    $ma_nv = $_GET['delete'];
    $conn->query("DELETE FROM nhanvien WHERE Ma_NV = '$ma_nv'");
    header("Location: index.php");
}

// Phân trang
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT NV.*, PB.Ten_Phong FROM nhanvien NV 
        JOIN phongban PB ON NV.Ma_Phong = PB.Ma_Phong 
        LIMIT $start, $limit";
$result = $conn->query($sql);

$total_records = $conn->query("SELECT COUNT(*) AS total FROM nhanvien")->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Nhân Viên</title>
    <style>
        table { width: 100%; border-collapse: collapse; text-align: center; }
        th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
        .avatar { width: 50px; height: 50px; }
        .pagination { text-align: center; margin-top: 10px; }
        .pagination a { padding: 5px 10px; border: 1px solid #ccc; margin: 2px; text-decoration: none; }
        .action-links a { margin: 0 5px; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">THÔNG TIN NHÂN VIÊN</h2>
    <a href="them_nv.php">Thêm Nhân Viên</a>
    <table>
        <tr>
            <th>Mã NV</th>
            <th>Tên Nhân Viên</th>
            <th>Giới Tính</th>
            <th>Nơi Sinh</th>
            <th>Phòng Ban</th>
            <th>Lương</th>
            <th>Hành Động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['Ma_NV'] ?></td>
            <td><?= $row['Ten_NV'] ?></td>
            <td><img class="avatar" src="<?= $row['Phai'] == 'NU' ? 'woman.jpg' : 'man.jpg' ?>" alt="Avatar"></td>
            <td><?= $row['Noi_Sinh'] ?></td>
            <td><?= $row['Ten_Phong'] ?></td>
            <td><?= $row['Luong'] ?></td>
            <td class="action-links">
                <a href="sua_nv.php?edit=<?= $row['Ma_NV'] ?>">Sửa</a> | 
                <a href="?delete=<?= $row['Ma_NV'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>
