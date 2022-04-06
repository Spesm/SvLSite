<?php

use Models\Product;

function showWebshopContent($render = true)
{
    $products = Product::getProducts();

    if ($render) : ?>
        <div class="content">
            <h1 class="content-header">Offers you can't refuse</h1>
            <div class="product-index">
                <?php foreach ($products as $product) {
                    showProductCard($product);
                } ?>
            </div>
        </div>
    <?php endif;
}

function showProductCard($product)
{
    if ($product['id']) : ?>
        <a class="product-card" href="<?php echo HOME . '/product/' . $product['id']; ?>">
            <h1 class="product-name"><?php echo $product['name']; ?></h1>
            <img src="<?php echo HOME . '/storage/images/products/' . $product['image']; ?>">
            <span class="price-tag">
                <h2 class="euros"><?php echo formatEuros($product['price']); ?></h2>
                <h4 class="cents"><?php echo formatCents($product['price']); ?></h4>
            </span>
            <div class="product-action">
                <button class="add-product-button" id="<?php echo $product['id']; ?>">Buy</button>
            </div>
        </a>
    <?php endif;
}
