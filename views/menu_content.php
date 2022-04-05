<?php

function showMenuContent($render = true)
{
    if ($render) : ?>
        <div class="menu">
            <div class="navigation">
                <a href="./home">Home</a>
                <a href="./about">About</a>
                <a href="./contact">Contact</a>
                <a href="./webshop">Webshop</a>
            </div>
            <div class="shopping">
                <a class="cart-circle" href="./cart"><i class="fa-solid fa-cart-shopping"></i></a>
                <div id="product-count"><?php echo countProductsInCart() ?></div>
            </div>
            <div class="account">
                <?php if (empty($_SESSION['username'])) : ?>
                    <a href="./login">Login</a>
                    <a href="./register">Register</a>
                <?php else : ?>
                    <a href="./logout">Logout</a>
                    <div class="username"><?php echo explode(" ", $_SESSION['username'])[0]; ?></div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif;
}
