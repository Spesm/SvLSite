<?php

function showMenuContent($render = true)
{
    if ($render) : ?>
        <div class="menu">
            <div class="navigation">
                <a href="<?php echo HOME . '/home'; ?>">Home</a>
                <a href="<?php echo HOME . '/about'; ?>">About</a>
                <a href="<?php echo HOME . '/contact'; ?>">Contact</a>
                <a href="<?php echo HOME . '/webshop'; ?>">Webshop</a>
            </div>
            <div class="shopping">
                <a class="cart-circle" href="<?php echo HOME . '/cart'; ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                <div id="product-count"><?php echo countProductsInCart() ?></div>
            </div>
            <div class="account">
                <?php if (empty($_SESSION['username'])) : ?>
                    <a href="<?php echo HOME . '/login'; ?>">Login</a>
                    <a href="<?php echo HOME . '/register'; ?>">Register</a>
                <?php else : ?>
                    <a href="<?php echo HOME . '/logout'; ?>">Logout</a>
                    <div class="username"><?php echo explode(" ", $_SESSION['username'])[0]; ?></div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif;
}
