<?php

require_once ROOT . '/classes/DB.php';
require_once ROOT . '/classes/ID.php';

class Product extends DB
{
    public static function getProducts()
    {
        $query = self::query("SELECT `id`, `name`, `price`, `image` FROM products WHERE `show` = 1");
        $result = [];

        while ($row = $query->fetch()) {
            $result[] = $row;
        }

        return $result;
    }
}
