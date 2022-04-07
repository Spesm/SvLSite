<?php

use Models\Product;

function showProductContent($render = true)
{
    $productId = explode('/', str_replace('/SvLSite/', '', $_SERVER['REQUEST_URI']))[1];
    $product = Product::getProductBy($productId);
    $amount = $_SESSION['cart'][array_search($productId, array_column($_SESSION['cart'], 'id'))]['qty'] ?? 1;
    $cost = $amount * $product['price'];

    if ($render && !empty($product)) : ?>
        <div class="content">
            <h1 class="content-header">One of our favourites!</h1>
            <div class="product-page">
                <h1 class="product-page-header"><?php echo $product['name']; ?></h1>
                <div class="info-row">
                    <img src="<?php echo HOME . '/storage/images/products/' . $product['image']; ?>">
                    <div class="description">
                        <h1>Description</h1>
                        <p><?php echo $product['description'] ?></p>
                    </div>                    
                </div>
                <div class="action-row">
                    <div class="product-price-tag">
                        <h2 class="euros"><?php echo formatEuros($product['price']); ?></h2>
                        <h4 class="cents"><?php echo formatCents($product['price']); ?></h4>
                    </div>
                    <div class="item-amount">
                        <button class="product-dec" id="<?php echo 'pde-' . $productId; ?>"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" class="number" id="<?php echo 'pnr-' . $productId; ?>" value="<?php echo $amount; ?>" min="0" max="999">
                        <button class="product-inc" id="<?php echo 'pin-' . $productId; ?>"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div class="product-total">
                        <h3 id="<?php echo 'ptc-' . $productId ?>"><?php echo formatPrice($cost); ?></h3>
                    </div>
                    <button class="btn-square add-to-cart" id="<?php echo $productId; ?>">Add to Cart</button>
                </div>
            </div>
        </div>
    <?php elseif (empty($product)) : ?>
        <div class="content">
            <p>Sorry, we couldn't find the requested product</p>
        </div>
    <?php endif;
}
