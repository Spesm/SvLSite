<?php

use Classes\RequestHandler;

require 'vendor/autoload.php';

if (empty($_SESSION)) {
    session_start();   
}

RequestHandler::handle();

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
