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
            <link rel="stylesheet" href="<?php echo HOME . './assets/stylesheet.css'; ?>">
            <script src="https://kit.fontawesome.com/63de4c0f08.js" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="<?php echo HOME . '/javascripts/jquery_functions.js' ?>"></script>
            <meta name="viewport" content="device-width, initial-scale=1.0">
            <meta charset="UTF-8">
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
            <h1>SvLSite - <?php echo ucfirst($page); ?></h1>
            <p><?php echo empty($_SESSION['username']) ? 'Not logged in' : 'Welcome ' . $_SESSION['username']; ?></p>
            <?php echo ROOT . '/assets/stylesheet'; ?>
        </div>
    <?php endif;
}

function showMenu()
{
    require 'views/menu_content.php';
    showMenuContent();
}

function showContent($page)
{
    switch ($page) {
        case 'about':
            require 'views/about_content.php';
            showAboutContent();
            break;
        case 'cart':
            require 'views/cart_content.php';
            showCartContent();
            break;
        case 'contact':
            require 'views/contact_content.php';
            showContactContent();
            break;
        case 'home':
            require 'views/home_content.php';
            showHomeContent();
            break;
        case 'login':
            require 'views/login_content.php';
            showLoginContent();
            break;
        case 'logout':
            require 'views/logout_content.php';
            showLogoutContent();
            break;
        case 'product':
            require 'views/product_content.php';
            showProductContent();
            break;
        case 'register':
            require 'views/register_content.php';
            showRegisterContent();
            break;
        case 'webshop':
            require 'views/webshop_content.php';
            showWebshopContent();
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
