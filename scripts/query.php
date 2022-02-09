<?php

require_once '../config.php';

function qpdo($query)
{
    $host = DBHOST;
    $username = 'root';
    $password = '';
    $dbname = DBNAME;

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec($query);
        echo 'Query executed successfully with PDO';
    } catch (PDOException $error) {
        echo 'PDO exception: ' . $error->getMessage();
    }

    $pdo = null;
}

function createDatabase() {

    $query = "CREATE DATABASE svlsite";

    qpdo($query);
}

function createUserTable() {

    $query = "CREATE TABLE users (
        `nr` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `id` CHAR(6) UNIQUE NOT NULL,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) UNIQUE NOT NULL,
        `reg` TINYINT(1) UNSIGNED DEFAULT 0 NOT NULL,
        `password` VARCHAR(255),
        `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    qpdo($query);
}

function createProductTable()
{
    $query = "CREATE TABLE products (
        `nr` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `id` CHAR(6) UNIQUE NOT NULL,
        `name` VARCHAR(255) UNIQUE NOT NULL,
        `description` VARCHAR(255),
        `price` FLOAT(10, 2) UNSIGNED,
        `stock` SMALLINT DEFAULT 0 NOT NULL,
        `image` VARCHAR(255),
        `show` TINYINT(1) UNSIGNED DEFAULT 1 NOT NULL,
        `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    qpdo($query);
}

createProductTable();
