<?php

require_once 'C://xampp/htdocs/SvLSite/config.php';

class DB
{
    public static $pdo;
    public static $stmt;

    public static function connect()
    {
        $host = DBHOST;
        $dbname = DBNAME;
        $user = DBUSER;
        $password = DBPWD;
        $charset = DBCHARS;

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            self::$pdo = new PDO($dsn, $user, $password, $options);
            // echo nl2br("PDO instance created successfully \n");
        } catch (PDOException $error) {
            // echo nl2br("PDO exception: " . $error->getMessage() . "\n");
            exit;
        }
    }

    public static function query($sql)
    {
        self::connect();
        $result = self::$pdo->query($sql);
        self::destruct();

        return $result;
    }

    public static function prepare($statement)
    {
        self::connect();
        return self::$stmt = self::$pdo->prepare($statement);
    }

    public static function execute($queryVars)
    {
        self::$stmt->execute($queryVars);
    }

    public static function fetch()
    {
        return self::$stmt->fetch();
    }

    public static function destruct()
    {
        self::$pdo = null;
        // echo nl2br("PDO instance destroyed successfully \n");
    }
}
