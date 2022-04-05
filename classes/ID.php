<?php

namespace Classes;

class ID
{
    public static function create($length = 6)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $character = substr($characters, rand(0, strlen($characters) - 1), 1);
            $randomString .= $character;
        }
        
        return $randomString;
    }
}
