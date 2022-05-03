<?php

namespace Models;

use Classes\DB;

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

    public static function getProductBy($value, $key = 'id')
    {
        self::prepare("SELECT * FROM products WHERE " . $key . " = :" . $key);

        self::execute([$key => $value]);
        $product = self::fetch();
        self::destruct();

        return $product;
    }
}
