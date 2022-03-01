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
            <div class="cart">
                <a class="circle" href="./webshop"><i class="fa-solid fa-cart-shopping"></i></a>
                <div class="count">88</div>
            </div>
            <div class="session">
                <?php if (empty($_SESSION)) : ?>
                    <a href="./login">Login</a>
                    <a href="./register">Register</a>
                <?php else : ?>
                    <a href="./logout">Logout</a>
                    <div><?php echo explode(" ", $_SESSION['username'])[0]; ?></div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif;
}
