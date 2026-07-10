-- 1. Tạo cơ sở dữ liệu mới nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS user_management
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- 2. Chỉ định hệ thống sử dụng cơ sở dữ liệu vừa tạo để làm việc
USE user_management;

-- 3. Tạo bảng users chứa thông tin tài khoản đăng ký
CREATE TABLE IF NOT EXISTS users (
    -- id làm khóa chính, tự động tăng tiến (1, 2, 3...) khi có tài khoản mới
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- tên đăng nhập giới hạn 50 ký tự, bắt buộc nhập và không được trùng lặp (UNIQUE)
    username VARCHAR(50) NOT NULL UNIQUE,
    
    -- mật khẩu mã hóa dạng chuỗi dài 255 ký tự để chứa vừa chuỗi hash BCRYPT
    password VARCHAR(255) NOT NULL,
    
    -- tự động lưu mốc thời gian lúc tài khoản được khởi tạo thành công
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;bai12user_managementusersuser_managementuser_managementusers