<?php

// Cơ chế tự động tìm và nạp file dựa trên Namespace
spl_autoload_register(function ($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

// Thử nghiệm khởi tạo không cần dùng include/require thủ công
use App\Students\Student;

$student = new Student("Nguyen Quang Bao Tam", 21, "HUIT2026");
echo $student->getInfo();