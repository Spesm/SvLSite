<?php

require_once ROOT . '/classes/DB.php';
require_once ROOT . '/classes/ID.php';

class User extends DB
{
    public static function getUsedIds()
    {
        $query = self::query("SELECT id FROM users");
        $result = [];

        while ($row = $query->fetch()) {
            $result[] = $row['id'];
        }

        return $result;
    }

    public static function setId()
    {
        $usedIds = self::getUsedIds();

        do {
            $id = ID::create();
        } while (in_array($id, $usedIds));

        return $id;
    }

    public static function create($user)
    {
        self::prepare("INSERT INTO users (id, username, email, pass) VALUES (:id, :username, :email, :pass)");

        $userData = [
            'id' => self::setId(),
            'username' => $user['username'],
            'email' => $user['email'],
            'pass' => $user['password']
        ];
        
        self::execute($userData);
        self::destruct();
    }
}
