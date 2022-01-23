<?php

require_once 'scripts/request_handling.php';
require_once 'scripts/page_building.php';
// require_once 'scripts/form_handling.php';

define('ROOT', __DIR__);
define('HOME', 'http://localhost/SvLSite');
session_start();

$page = handleRequest();
// print_r(openPost());
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
