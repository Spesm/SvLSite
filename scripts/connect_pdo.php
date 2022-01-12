<?php

require_once '../config.php';

$servername = DBHOST;
$username = DBUSER;
$password = DBPWD;
$dbname = DBNAME;

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "CREATE TABLE users (
        nr INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id CHAR(6) UNIQUE NOT NULL,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        reg TINYINT(1) UNSIGNED DEFAULT 0 NOT NULL,
        pass VARCHAR(255),
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $connection->exec($query);
    echo 'Database created with PDO';    
} catch(PDOException $error) {
    echo 'PDO exception: ' . $error->getMessage();
}
$connection = null;
