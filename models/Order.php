<?php

namespace Models;

use Classes\DB;
use Classes\ID;
use Models\User;

class Order extends DB
{
    public static function getUsedIds()
    {
        $query = self::query("SELECT id FROM orders");
        $result = [];

        while ($row = $query->fetch()) {
            $result[] = $row['id'];
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

    public static function create()
    {
        $orderData = [
            'id'        => self::setId(),
            'order'     => json_encode($_SESSION['cart']),
            'value'     => array_sum(array_column($_SESSION['cart'], 'cost')),
            'user'      => User::getUserBy($_SESSION['email'], 'email')['id'],
        ];

        self::prepare("INSERT INTO orders (`id`, `order`, `value`, `user`) VALUES (:id, :order, :value, :user)");        
        self::execute($orderData);
        self::destruct();

        echo 'Thank you! Your order was successfully placed';
    }
}
