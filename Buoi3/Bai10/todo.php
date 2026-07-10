<?php
$file = 'todo.json'; // Định nghĩa tên tệp tin dùng để lưu trữ dữ liệu

// Nếu file dữ liệu chưa tồn tại trên ổ cứng, tự động tạo mới một file chứa mảng rỗng []
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

// Đọc toàn bộ nội dung file json lên, chuyển chuỗi json đó thành mảng dữ liệu PHP để xử lý logic
$tasks = json_decode(file_get_contents($file), true);

// Kiểm tra xem có phải Client đang gửi dữ liệu lên bằng phương thức POST hay không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Đọc luồng dữ liệu thô (raw data) được gửi từ hàm fetch của JS và chuyển thành mảng trong PHP
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? ''; // Lấy ra hành động cần xử lý (add, toggle, hoặc delete)

    if ($action === 'add') {
        // Thêm một phần tử công việc mới vào cuối mảng dữ liệu hiện tại
        $tasks[] = ['text' => $data['text'], 'completed' => false];
    } elseif ($action === 'toggle') {
        $index = $data['index']; // Lấy vị trí của phần tử cần sửa
        if (isset($tasks[$index])) {
            // Đảo ngược trạng thái: nếu đang true thì thành false, nếu đang false thì thành true
            $tasks[$index]['completed'] = !$tasks[$index]['completed'];
        }
    } elseif ($action === 'delete') {
        $index = $data['index']; // Lấy vị trí của phần tử cần xóa
        if (isset($tasks[$index])) {
            // Hàm cắt bỏ 1 phần tử tại vị trí index ra khỏi mảng dữ liệu
            array_splice($tasks, $index, 1);
        }
    }
    // Mã hóa mảng dữ liệu sau khi sửa đổi thành chuỗi JSON và ghi đè lại vào file todo.json
    file_put_contents($file, json_encode($tasks, JSON_UNESCAPED_UNICODE));
    exit; // Dừng chương trình sau khi xử lý xong yêu cầu POST
}

// Nếu là yêu cầu truy cập thông thường (GET), PHP chỉ đơn giản là in toàn bộ mảng dữ liệu JSON ra màn hình
echo json_encode($tasks, JSON_UNESCAPED_UNICODE);