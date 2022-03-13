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

    public static function getUsedEmails()
    {
        $query = self::query("SELECT email FROM users");
        $result = [];

        while ($row = $query->fetch()) {
            $result[] = $row['email'];
        }

        return $result;
    }

    public static function setId()
    {
        $usedIds = self::getUsedIds();

        $id = 0;
        do {
            $id = ID::create();
        } while (in_array($id, $usedIds));

        return $id;
    }

    public static function create($user)
    {
        self::prepare("INSERT INTO users (id, name, email, password) VALUES (:id, :name, :email, :password)");

        $userData = [
            'id'        => self::setId(),
            'name'  => $user['username'],
            'email'     => $user['email'],
            'password'      => $user['password']
        ];
        
        self::execute($userData);
        self::destruct();
    }

    public static function getUserBy($email)
    {
        self::prepare("SELECT * FROM users WHERE email = :email");

        self::execute(['email' => $email]);
        $user = self::fetch();
        self::destruct();

        return $user;
    }
}
