<?php

class Book {
    // Thuộc tính protected cho phép các lớp con truy cập trực tiếp
    protected $title;
    protected $author;
    protected $price;

    // Hàm khởi tạo gán giá trị cho các thuộc tính của sách thông thường
    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }
}

// Định nghĩa giao diện bắt buộc cho các thực thể có thể tải xuống
interface Downloadable {
    public function download(); // Khai báo phương thức trừu tượng download
}

// Lớp Ebook kế thừa từ lớp Book và triển khai giao diện Downloadable
class Ebook extends Book implements Downloadable {
    private $fileSize; // Thuộc tính đặc trưng riêng của Ebook

    // Hàm khởi tạo của lớp con nhận cả thuộc tính của lớp cha và lớp con
    public function __construct($title, $author, $price, $fileSize) {
        parent::__construct($title, $author, $price); // Gọi hàm khởi tạo của lớp cha Book
        $this->fileSize = $fileSize; // Gán giá trị cho thuộc tính fileSize của riêng Ebook
    }

    // Hiện thực hóa phương thức download bắt buộc từ interface Downloadable
    public function download() {
        return "Downloading ebook: " . $this->title . " (" . $this->fileSize . "MB)";
    }
}

// Khởi tạo một đối tượng Ebook cụ thể
$myEbook = new Ebook("Clean Code", "Robert C. Martin", 150000, 4.5);
echo $myEbook->download(); // Gọi phương thức download để kiểm tra kết quả