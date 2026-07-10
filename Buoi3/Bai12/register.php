<?php
header('Content-Type: application/json; charset=utf-8');

// Khai báo các thông số cấu hình kết nối tới cơ sở dữ liệu MySQL của Laragon
$host = '127.0.0.1';
$db   = 'user_management'; // Tên database đã tạo ở bước chuẩn bị
$user = 'root';            // Tài khoản mặc định của Laragon là root
$pass = '';                // Mật khẩu mặc định của Laragon là để trống rỗng
$charset = 'utf8mb4';      // Hỗ trợ lưu trữ tiếng Việt có dấu đầy đủ

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Bật chế độ tự động quăng lỗi ra nếu câu lệnh SQL chạy bậy
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Trả kết quả truy vấn về dạng mảng dữ liệu dễ đọc
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Tắt chế độ giả lập câu lệnh để phòng chống lỗi bảo mật SQL Injection
];

try {
    // Khởi tạo một đối tượng kết nối cơ sở dữ liệu qua công cụ kết nối PDO xịn sò của PHP
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Nếu kết nối lỗi (Sai tên DB, sai mật khẩu...), dừng app và trả thông báo lỗi về cho Client
    echo json_encode(["success" => false, "message" => "Kết nối cơ sở dữ liệu thất bại!"]);
    exit;
}

// Đọc gói dữ liệu JSON mà hàm fetch của JavaScript vừa bắn lên
$data = json_decode(file_get_contents('php://input'), true);
$username = trim($data['username'] ?? '');
$password = trim($data['password'] ?? '');

// Lớp phòng thủ backend: Kiểm tra lại một lần nữa xem độ dài dữ liệu có đúng yêu cầu không (Phòng trường hợp hacker cố tình bỏ qua bước kiểm tra JS của Frontend)
if (strlen($username) < 5 || strlen($password) < 6) {
    echo json_encode(["success" => false, "message" => "Dữ liệu đầu vào không hợp lệ!"]);
    exit;
}

// Kiểm tra xem tên đăng nhập này đã có ai đăng ký trước đó chưa
$stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
$stmt->execute([$username]);
if ($stmt->fetch()) {
    // Nếu tìm thấy một dòng bản ghi trùng tên, trả về lỗi báo tài khoản đã tồn tại
    echo json_encode(["success" => false, "message" => "Tên đăng nhập này đã tồn tại trong hệ thống!"]);
    exit;
}

// Cơ chế bảo mật: Mã hóa một chiều mật khẩu bằng thuật toán BCRYPT cực mạnh, tuyệt đối không bao giờ lưu mật khẩu thuần của người dùng vào DB
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Chuẩn bị câu lệnh SQL chèn tài khoản mới vào cơ sở dữ liệu bảo mật bằng cách dùng dấu chấm hỏi `?` làm tham số ảo
$stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');

// Truyền dữ liệu thật vào thực thi câu lệnh chèn vào database
if ($stmt->execute([$username, $hashedPassword])) {
    echo json_encode(["success" => true, "message" => "Đăng ký tài khoản thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Đã có lỗi xảy ra trong quá trình lưu trữ!"]);
}