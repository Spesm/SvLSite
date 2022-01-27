<?php

require_once '../config.php';

class DB
{
    public static $pdo;

    public function __construct()
    {
        $host = DBHOST;
        $dbname = DBNAME;
        $user = 'root';
        $password = '';
        $charset = DBCHARS;

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            self::$pdo = new PDO($dsn, $user, $password, $options);
            echo nl2br("PDO instance created successfully \n");
        } catch (PDOException $error) {
            throw new PDOException($error->getMessage());
        }
    }

    public static function query($sql)
    {
        return self::$pdo->query($sql);
    }

    public function __destruct()
    {
        self::$pdo = null;
        echo nl2br("PDO instance destroyed successfully \n");
    }
}
