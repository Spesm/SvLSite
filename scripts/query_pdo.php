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
