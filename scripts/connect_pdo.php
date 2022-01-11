<?php

$servername = '127.0.0.1';
$username = 'root';
$password = '';

try {
    $connection = new PDO("mysql:host=$servername", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'CREATE DATABASE svlsite';
    $connection->exec($query);
    echo 'Database created with PDO';    
} catch(PDOException $error) {
    echo 'PDO exception: ' . $error->getMessage();
}
$connection = null;
