<?php

$page = handleRequest();
// echo $page;
session_start();
// $_SESSION['username'] = 'Sem';
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

function getFromUrl($default = 'home')
{
    $request = str_replace('/SvLSite/', '', $_SERVER['REQUEST_URI']);
    $urlParams = explode('/', $request);
    if (in_array($urlParams[0], indexPages())) {
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

function renderPage($page)
{
    startHtml();
    setHead();
    renderBody($page);
    endHtml();
}

function startHtml($render = true)
{
    if ($render) : ?>
        <!DOCTYPE html>
        <html>
    <?php endif;
}

function setHead($render = true)
{
    if ($render) : ?>

        <head>
            <title>SvLSite</title>
            <link rel="stylesheet" href="./assets/stylesheet.css">
            <meta name="viewport" content="device-width, initial-scale=1.0">
        </head>
    <?php endif;
}

function renderBody($page)
{
    startBody();
    showHeader($page);
    showMenu();
    showContent($page);
    showFooter();
    endBody();
}

function startBody($render = true)
{
    if ($render) : ?>
    <body>
        <div class="page">
    <?php endif;
}

function showHeader($page, $render = true)
{
    if ($render) : ?>
        <div class="header">
            <h1>SvLSite - <?php echo ucfirst($page) ?></h1>
            <?php echo empty($_SESSION) ? 'Not logged in' : 'Welcome ' . $_SESSION['username']; ?>
        </div>
    <?php endif;
}

function showMenu($render = true)
{
    if ($render) : ?>
        <div class="menu">
            <div class="navigation">
                <ul>
                    <li><a href="./home">Home</a></li>
                    <li><a href="./about">About</a></li>
                    <li><a href="./contact">Contact</a></li>
                </ul>
            </div>
            <div class="session">
                <ul>
                    <?php if (empty($_SESSION)) : ?>
                        <li><a href="./login">Login</a></li>
                        <li><a href="./register">Register</a></li>
                    <?php else : ?>
                        <li><a href="./logout">Logout</a></li>
                        <li><div><?php echo $_SESSION['username']; ?></div></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php endif;
}

function showContent($page)
{
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
        case 'register':
            require 'register_content.php';
            showRegisterContent();
            break;
        case 'login':
            require 'login_content.php';
            showLoginContent();
            break;
        case 'logout':
            require 'logout_content.php';
            showLogoutContent();
            break;
        default:
            require('home_content.php');
            showHomeContent();
    }
}

function showFooter($render = true)
{
    if ($render) : ?>
        <div class="footer">
            <footer>
                <p>&copy <?php echo date('Y'); ?> SvL</p>
            </footer>
        </div>
    <?php endif;
}

function endBody($render = true)
{
    if ($render) : ?>
        </body>
    </div>
    <?php endif;
}

function endHtml($render = true)
{
    if ($render) : ?>
    </html>
    <?php endif;
}
