<?php

use Classes\Request;

require 'vendor/autoload.php';

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
