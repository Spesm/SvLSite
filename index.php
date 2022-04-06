<?php

use Classes\Request;

require 'vendor/autoload.php';

if (empty($_SESSION)) {
    session_start();   
}

Request::handle();

function indexPages()
{
    $pages = [
        'about',
        'cart',
        'contact',
        'home',
        'login',
        'logout',
        'product',
        'register',
        'webshop',
    ];
    return $pages;
}
