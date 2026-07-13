<?php
require 'connect.php';

// Bài 09 & 10: Tiếp nhận từ khóa tìm kiếm an toàn từ biểu mẫu Frontend
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Bài 11: Tiếp nhận tham số sắp xếp cột dữ liệu và kiểu sắp xếp (Mặc định xếp theo ID tăng dần)
$sort_column = isset($_GET['sort']) && in_array($_GET['sort'], ['namesv', 'email']) ? $_GET['sort'] : 'id';
$sort_order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

// Thiết lập câu lệnh SQL dạng Prepared Statement với cấu trúc tham số ẩn định danh
$sql = "SELECT * FROM students WHERE namesv LIKE :search ORDER BY $sort_column $sort_order";

// Chuẩn bị câu lệnh thực thi tối ưu hóa trên MySQL Server
$stmt = $conn->prepare($sql);

// Ràng buộc tham số và thực thi truy vấn an toàn để ngăn chặn SQL Injection
$stmt->execute([':search' => '%' . $search . '%']);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mẹo logic: Đảo ngược trạng thái sắp xếp khi lập trình viên click lại vào tiêu đề cột
$next_order = $sort_order === 'ASC' ? 'desc' : 'asc';
?>

<form method="GET" action="list_students.php" style="margin-bottom: 15px;">
    <input type="text" name="search" placeholder="Nhập tên sinh viên cần tìm..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Tìm kiếm</button>
    <?php if ($search !== ''): ?>
        <a href="list_students.php"><button type="button">Hủy bộ lọc</button></a>
    <?php endif; ?>
</form>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th><a href="list_students.php?search=<?= urlencode($search) ?>&sort=namesv&order=<?= $next_order ?>">Họ tên <?= $sort_column === 'namesv' ? ($sort_order === 'ASC' ? '▲' : '▼') : '' ?></a></th>
        <th><a href="list_students.php?search=<?= urlencode($search) ?>&sort=email&order=<?= $next_order ?>">Email <?= $sort_column === 'email' ? ($sort_order === 'ASC' ? '▲' : '▼') : '' ?></a></th>
        <th>SĐT</th>
        <th>Ngày sinh</th> <th>Xóa</th>
        <th>Sửa</th>
    </tr>
    <?php if (count($students) > 0): ?>
        <?php foreach ($students as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['namesv']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= $row['birthday'] ? date('d/m/Y', strtotime($row['birthday'])) : 'Chưa cập nhật' ?></td>
                <td><a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a></td>
                <td><a href="edit_student.php?id=<?= $row['id'] ?>">Sửa</a></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" align="center">Không tìm thấy sinh viên nào phù hợp!</td>
        </tr>
    <?php endif; ?>
</table>