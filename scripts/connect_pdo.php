<?php

require_once '../config.php';

function qpdo($query)
{
    $servername = DBHOST;
    $username = DBUSER;
    $password = DBPWD;
    $dbname = DBNAME;

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($query);
        echo 'Query executed successfully with PDO';
    } catch (PDOException $error) {
        echo 'PDO exception: ' . $error->getMessage();
    }

    $connection = null;
}
