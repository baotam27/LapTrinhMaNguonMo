<?php
// Khai báo cấu hình Header báo cho trình duyệt biết đây là dữ liệu định dạng JSON dùng font UTF-8
header('Content-Type: application/json; charset=utf-8');

// Khởi tạo một mảng dữ liệu giả lập (Mock Data) cấu trúc của một API tỷ giá thực tế
$mockData = [
    "last_updated" => date("H:i:s d/m/Y"), // Hàm date lấy thời gian hiện tại chính xác đến từng giây của server
    "rates" => [
        "USD" => 25450,
        "EUR" => 27200,
        "JPY" => 165,
        "GBP" => 32100,
        "AUD" => 16800
    ]
];

// Chuyển đổi mảng PHP trên thành chuỗi định dạng JSON và in ra màn hình để Client lấy về sử dụng
echo json_encode($mockData, JSON_UNESCAPED_UNICODE);