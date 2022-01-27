<?php

require_once '../classes/DB.php';

class User extends DB
{
    public static function getUsedIds()
    {
        $statement = self::query("SELECT id FROM users");
        print_r($statement);
        while ($row = $statement->fetch()) {
            echo nl2br($row['id'] . "\n");
        }
    }
}
