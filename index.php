<?php

$page = handleRequest();
renderPage($page);

function handleRequest()
{
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    switch ($requestMethod) {
        case 'GET':
            $requestedPage = getFromUrl();
            break;
        case 'POST':
            $requestedPage = getFromPost();
            break;
        default:
            $requestedPage = getFromUrl();
    }
    return $requestedPage;
}

function listPages()
{
    $pages = [
        'home',
        'about',
        'contact',
    ];
    return $pages;
}

function getFromUrl($default = 'home')
{
    $request = str_replace('/SvLSite/', '', $_SERVER['REQUEST_URI']);
    $urlParams = explode('/', $request);
    if (in_array($urlParams[0], listPages())) {
        return $urlParams[0];
    } else {
        return $default;
    }
}

function getFromPost($key = 'form', $default = 'home')
{
    if (null !== filter_input(INPUT_POST, $key)) {
        return filter_input(INPUT_POST, $key);
    } else {
        return $default;
    }
}

function renderPage($page) {
    startHtml();
    setHead();
    renderBody($page);
    endHtml();
}

function startHtml($do = true) {
    if ($do) : ?>
        <!DOCTYPE html>
        <html>
    <?php endif;
}

function setHead($do = true) {
    if ($do) : ?>
        <head>
            <title>SvLSite</title>
            <link rel="stylesheet" href="./assets/stylesheet.css">
            <meta name="viewport" content="device-width, initial-scale=1.0">
        </head>
    <?php endif;
}

function renderBody($page) {
    startBody();
    showHeader($page);
    showMenu();
    showContent($page);
    showFooter();
    endBody();
}

function startBody($do = true) {
    if ($do) : ?>
        <body>
            <div class="page">
    <?php endif;
}

function showHeader($page, $do = true) {
    if ($do) : ?>
        <div class="header">
            <h1>SvLSite - <?php echo ucfirst($page) ?></h1>
        </div>
    <?php endif;    
}

function showMenu($do = true) {
    if ($do) : ?>
        <div class="menu">
            <ul>
                <li><a href="./home">Home</a></li>
                <li><a href="./about">About</a></li>
                <li><a href="./contact">Contact</a></li>
            </ul>
        </div>
    <?php endif;    
}

function showContent($page) {
    switch ($page) {
        case 'home':
            require 'home_content.php';
            showHomeContent();
            break;
        case 'about':
            require 'about_content.php';
            showAboutContent();
            break;
        case 'contact':
            require 'contact_content.php';
            showContactContent();
            break;
        default:
            require('home_content.php');
            showHomeContent();
   }
}

function showFooter($do = true) {
    if ($do) : ?>
        <div class="footer">
            <footer>
                <p>&copy <?php echo date('Y'); ?> SvL</p>
            </footer>
        </div>
    <?php endif;    
}

function endBody($do = true) {
    if ($do) : ?>
            </body>
        <div>
    <?php endif;
}
 
function endHtml($do = true) {
    if ($do) : ?>
        </html>
    <?php endif;
}
