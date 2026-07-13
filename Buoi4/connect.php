<?php
$dsn = "mysql:host=localhost;dbname=labdb;charset=utf8";
$usrname = "root";
$password = "";

try {
    $conn = new PDO($dsn, $usrname, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Ket noi thanh cong!";
} catch (PDOException $e) {
    echo "Ket noi that bai: ". $e->getMessage();
}
?>