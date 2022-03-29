<?php

require_once 'classes/Request.php';

define('ROOT', __DIR__);
define('HOME', 'http://localhost/SvLSite');
session_start();

Request::handle();

function indexPages()
{
    $pages = [
        'home',
        'about',
        'contact',
        'webshop',
        'cart',
        'register',
        'login',
        'logout',
    ];
    return $pages;
}
