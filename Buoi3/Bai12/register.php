<?php
// Báo cho trình duyệt biết dữ liệu trả về luôn có định dạng JSON và dùng font UTF-8 tiếng Việt
header('Content-Type: application/json; charset=utf-8');

// Cấu hình kết nối MySQL của Laragon
$host = '127.0.0.1';
$db   = 'user_management'; // Tên cơ sở dữ liệu ông tạo trong HeidiSQL
$user = 'root';            // User mặc định của Laragon
$pass = '';                // Mật khẩu mặc định của Laragon để trống
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Tự động quăng lỗi nếu câu lệnh SQL sai
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Trả dữ liệu mảng dạng key => value dễ đọc
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Tăng cường bảo mật chống lỗi SQL Injection
];

try {
    // Khởi tạo kết nối dữ liệu thông qua thư viện PDO xịn sò của PHP
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Nếu kết nối database thất bại, in thông báo lỗi ra màn hình luôn
    echo json_encode(["success" => false, "message" => "Kết nối cơ sở dữ liệu thất bại!"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Đọc gói dữ liệu JSON ngầm được gửi từ hàm fetch bên JavaScript sang
$data = json_decode(file_get_contents('php://input'), true);
$username = trim($data['username'] ?? '');
$password = trim($data['password'] ?? '');

// Lớp phòng thủ Backend: Kiểm tra lại độ dài ký tự đề phòng hacker bypass qua lớp JavaScript Frontend
if (strlen($username) < 5 || strlen($password) < 6) {
    echo json_encode(["success" => false, "message" => "Dữ liệu đầu vào không hợp lệ!"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Kiểm tra xem tên đăng nhập này đã có ai sử dụng trong bảng users chưa
$stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
$stmt->execute([$username]);
if ($stmt->fetch()) {
    // Nếu tìm thấy tài khoản trùng tên, bắn lỗi về và dừng chương trình
    echo json_encode(["success" => false, "message" => "Tên đăng nhập này đã tồn tại trong hệ thống!"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Mã hóa một chiều mật khẩu bằng thuật toán BCRYPT cực mạnh, không lưu mật khẩu thuần để bảo mật dữ liệu
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Chuẩn bị câu lệnh SQL chèn tài khoản mới vào bảng dữ liệu bảo mật bằng tham số ảo dấu chấm hỏi `?`
$stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');

// Thực thi câu lệnh chèn dữ liệu thật vào database
if ($stmt->execute([$username, $hashedPassword])) {
    // Trả về kết quả thành công cho giao diện Frontend
    echo json_encode(["success" => true, "message" => "Đăng ký tài khoản thành công!"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["success" => false, "message" => "Đã có lỗi xảy ra trong quá trình lưu trữ!"], JSON_UNESCAPED_UNICODE);
}