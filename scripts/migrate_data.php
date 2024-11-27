<?php

require_once 'query.php';

if (file_exists('../storage/users.txt')) {
    $userFile = fopen('../storage/users.txt', 'r');
    while (!feof($userFile)) {
        $users[] = explode('|', trim(fgets($userFile)));
    }
    array_shift($users);

    $processed = 0;
    $insertValues = '';
    foreach ($users as $user) {
        $user[] = createId(6);
        $processed++;
        $imploded = "('" . implode("', '", $user) . "')" . ($processed < count($users) ? ", " : ";");
        $insertValues .= $imploded;
    }
}

createQuery($insertValues);

function createQuery($values) {
    $insert = "INSERT IGNORE INTO users (email, name, password, id) VALUES " . $values;
    qpdo($insert);
}

function createId($length)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $character = substr($characters, rand(0, strlen($characters) - 1), 1);
        $randomString .= $character;
    }
    return $randomString;
}
