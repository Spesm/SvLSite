<?php

include 'scripts/request_handling.php';
include 'scripts/page_building.php';

define('ROOT', __DIR__);
define('HOME', 'http://localhost/SvLSite');

$page = handleRequest();
session_start();
renderPage($page);

function indexPages()
{
    $pages = [
        'home',
        'about',
        'contact',
        'register',
        'login',
        'logout',
    ];
    return $pages;
}
