<?php

require_once ROOT . '/models/Product.php';
require_once ROOT . '/scripts/price_formatting.php';

function showCartContent($render = true)
{
    $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    if ($render) : ?>
        <div class="content">
            <p>Cart contents:</p>
            <?php foreach ($cartItems as $item) {
                showCartItem($item);
            } ?>
        </div>
    <?php endif;
}

function showCartItem($item)
{
    $product = Product::getProductBy($item['id']);

    if ($item) : ?>
        <div class="cart-item">
            <img src="<?php echo HOME . '/storage/images/products/' . $product['image'] ?>">
            <h3><?php echo $product['name'] . ' - ' . formatEuros($product['price']) . formatCents($product['price']) ?></h3>
        </div>
    <?php endif;
}
