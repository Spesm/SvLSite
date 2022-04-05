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
            <div class="cart-total">
                <h3>Total:</h3>
                <h3><?php echo countProductsInCart() . ' items'; ?></h3>
                <h3><?php echo calculateCartTotal(); ?></h3>
            </div>
        </div>
    <?php endif;
}

function showCartItem($item)
{
    $product = Product::getProductBy($item['id']);
    $productSubtotal = $item['qty'] * $product['price'];

    if ($item) : ?>
        <div class="cart-item" id="<?php echo 'div-' . $item['id'] ?>">
            <img src="<?php echo HOME . '/storage/images/products/' . $product['image']; ?>">
            <h3><?php echo $product['name'] . ' - ' . formatPrice($product['price']); ?></h3>
            <div class="item-amount">
                <button class="decrement" id="<?php echo 'dec-' . $item['id']; ?>"><i class="fa-solid fa-minus"></i></button>
                <input type="hidden" id="<?php echo 'name-' . $item['id']; ?>" value="<?php echo $product['name']; ?>">
                <input type="hidden" id="<?php echo 'ppu-' . $item['id']; ?>" value="<?php echo $product['price']; ?>">
                <input type="number" class="quantity" id="<?php echo 'num-' . $item['id']; ?>" value="<?php echo $item['qty']; ?>" min="0" max="999">
                <button class="increment" id="<?php echo 'inc-' . $item['id']; ?>"><i class="fa-solid fa-plus"></i></button>
            </div>
            <div class="subtotal">
                <h3 id="<?php echo 'sub-' .$item['id'] ?>"><?php echo formatPrice($productSubtotal); ?></h3>
            </div>
            <div class="item-delete">
                <i class="fa-solid fa-trash" id="<?php echo 'del-' . $item['id'] ?>"></i>
            </div>
        </div>
    <?php endif;
}
