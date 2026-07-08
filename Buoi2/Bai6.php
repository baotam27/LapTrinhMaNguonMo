<?php

class BankAccount {
    // Khai báo các thuộc tính bảo mật của tài khoản
    private $accountNumber;
    private $accountHolder;
    private $balance;

    // Hàm khởi tạo để thiết lập thông tin ban đầu khi tạo đối tượng
    public function __construct($accountNumber, $accountHolder, $balance) {
        $this->accountNumber = $accountNumber;
        $this->accountHolder = $accountHolder;
        $this->balance = $balance;
    }

    // Phương thức xử lý logic nạp tiền vào tài khoản
    public function deposit($amount) {
        // Kiểm tra điều kiện số tiền nạp vào phải lớn hơn 0
        if ($amount > 0) {
            $this->balance += $amount; // Cộng tiền vào số dư hiện tại
        }
    }

    // Phương thức xử lý logic rút tiền kèm kiểm tra số dư
    public function withdraw($amount) {
        // Điều kiện kép: Số tiền rút phải lớn hơn 0 và không vượt quá số dư hiện tại
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount; // Trừ tiền khỏi số dư hiện tại
            return true; // Trả về true báo hiệu rút tiền thành công
        }
        return false; // Trả về false nếu không thỏa mãn điều kiện
    }

    // Phương thức định dạng chuỗi để hiển thị thông tin số dư
    public function displayBalance() {
        return "Account: " . $this->accountNumber . " | Holder: " . $this->accountHolder . " | Balance: " . $this->balance;
    }
}

// Khởi tạo một tài khoản test với số dư ban đầu là 500,000
$account = new BankAccount("VCB123", "Nguyen Quang Bao Ta,", 500000);
$account->deposit(200000); // Thực hiện nạp thêm 200,000
$account->withdraw(100000); // Thực hiện rút ra 100,000
echo $account->displayBalance(); // In ra kết quả hiển thị thông tin tài khoản