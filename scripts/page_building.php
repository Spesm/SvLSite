<?php

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
            <p><?php echo empty($_SESSION) ? 'Not logged in' : 'Welcome ' . $_SESSION['username']; ?></p>
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
                        <li><div><?php echo explode(" ", $_SESSION['username'])[0]; ?></div></li>
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
            require 'views/home_content.php';
            showHomeContent();
            break;
        case 'about':
            require 'views/about_content.php';
            showAboutContent();
            break;
        case 'contact':
            require 'views/contact_content.php';
            showContactContent();
            break;
        case 'register':
            require 'views/register_content.php';
            showRegisterContent();
            break;
        case 'login':
            require 'views/login_content.php';
            showLoginContent();
            break;
        case 'logout':
            require 'views/logout_content.php';
            showLogoutContent();
            break;
        default:
            require 'views/home_content.php';
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
