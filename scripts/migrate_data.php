<?php

require_once './query_pdo.php';

if (file_exists('../storage/users.txt')) {
    $userFile = fopen('../storage/users.txt', 'r');
    while (!feof($userFile)) {
        $users[] = explode('|', fgets($userFile));        
    }
    array_shift($users);

    foreach ($users as $user) {
        print_r($user);
    }
}
