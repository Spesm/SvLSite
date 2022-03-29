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
    $itemsSubtotal = $item['qty'] * $product['price'];

    if ($item) : ?>
        <div class="cart-item">
            <img src="<?php echo HOME . '/storage/images/products/' . $product['image'] ?>">
            <h3><?php echo $product['name'] . ' - ' . formatEuros($product['price']) . formatCents($product['price']) ?></h3>
            <div class="item-amount">
                <button class="decrement" id="<?php echo 'dec-' . $item['id'] ?>"><i class="fa-solid fa-minus"></i></button>
                <input type="number" class="quantity" id="<?php echo 'num-' . $item['id'] ?>" value="<?php echo $item['qty'] ?>" min="0" max="999">
                <button class="increment" id="<?php echo 'inc-' . $item['id'] ?>"><i class="fa-solid fa-plus"></i></button>
            </div>
            <div class="subtotal">
                <h3 id="<?php echo 'sub-' .$item['id'] ?>"><?php echo formatEuros($itemsSubtotal) . formatCents($itemsSubtotal) ?></h3>
            </div>
        </div>
    <?php endif;
}
