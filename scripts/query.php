<?php

use Classes\ID;

function qpdo($query)
{
    $host = '127.0.0.1';
    $username = 'root';
    $password = '';
    $dbname = 'svlsite';

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

function createDatabase()
{

    $query = "CREATE DATABASE svlsite";

    qpdo($query);
}

function createUserTable()
{
    $query = "CREATE TABLE users (
        `nr` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `id` CHAR(6) UNIQUE NOT NULL,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) UNIQUE NOT NULL,
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
        `price` DOUBLE UNSIGNED,
        `stock` SMALLINT UNSIGNED DEFAULT 0 NOT NULL,
        `image` VARCHAR(255),
        `show` TINYINT(1) UNSIGNED DEFAULT 1 NOT NULL,
        `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    qpdo($query);
}

function createOrderTable()
{
    $query = "CREATE TABLE orders (
        `nr` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `id` CHAR(6) UNIQUE NOT NULL,
        `order` VARCHAR(255),
        `value` DOUBLE UNSIGNED,
        `user_id` CHAR(6) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(`id`),
        `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    qpdo($query);
}

function feedProductTable()
{
    $query = "INSERT INTO products (`id`, `name`, `description`, `price`, `image`) VALUES
        ('" . ID::create() . "', 'Tennis Ball', 'Essential equipment for tennis players of all levels', 1.25, 'tennis_ball.jpg'),
        ('" . ID::create() . "', 'Felix', 'Furry, playful, cute and now available for a special discount price', 25.00, 'felix_cat.jpg'),
        ('" . ID::create() . "', 'Nuclear Fusion Reactor', 'Simply heat to 150 million degrees Celsius and collect enough energy to cook your eggs for a week', 21000000000.99, 'fusion_reactor.jpg'),
        ('" . ID::create() . "', 'Bottle of Wine', 'Enjoy the finer things in life', 7.50, 'wine_bottle.jpg'),
        ('" . ID::create() . "', 'T-shirt', 'Perfect for any casual occasion', 17.95, 't-shirt.jpg'),
        ('" . ID::create() . "', 'Villa Aurora', 'Buy a fresco with a dickpic and get this house for next to nothing', 471000000, 'villa_aurora.jpg')
    ";

    qpdo($query);
}

// createUserTable();
// createProductTable();
createOrderTable();
// feedProductTable();
