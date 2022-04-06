<?php

use Models\Product;

function showProductContent($render = true)
{
    $productId = explode('/', str_replace('/SvLSite/', '', $_SERVER['REQUEST_URI']))[1];
    $product = Product::getProductBy($productId);

    if ($render) : ?>
        <div class="content">
            <h1 class="content-header">One of our favourites!</h1>
            <div class="product-page">
                <h1 class="product-page-header"><?php echo $product['name']; ?></h1>
                <div class="image-row">
                    <img src="<?php echo HOME . '/storage/images/products/' . $product['image']; ?>">
                    <div class="description">
                        <h1>Description</h1>
                        <p><?php echo $product['description'] ?></p>
                    </div>                    
                </div>
                <p>Welcome! This is the product page.</p>
                <?php echo $productId; ?>
            </div>
        </div>
    <?php endif;
}
