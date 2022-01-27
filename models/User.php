<?php

require_once '../classes/DB.php';

class User extends DB
{
    public function getUsedIds()
    {
        $statement = $this->query("SELECT id FROM users");
        print_r($statement);
        while ($row = $statement->fetch()) {
            echo nl2br($row['id'] . "\n");
        }
    }
}
