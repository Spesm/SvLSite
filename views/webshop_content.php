<?php

require_once ROOT . '/models/product.php';

function showWebshopContent($render = true)
{
    $products = Product::getProducts();
    print_r($products);

    if ($render) : ?>
        <div class="content">
            <h1 class="product_header">Offers you can't refuse</h1>
            <div class="product_index">
                <?php foreach ($products as $product) {
                    showProductCard($product);
                } ?>
            </div>
        </div>
    <?php endif;
}

function formatPrice($price) {
    echo strval($price);
    $cents = strpos($price, '.') ? substr($price, strpos($price, '.') + 1, 2) : '';
    echo nl2br("\n" . $cents);
    $euros = strpos($price, '.') ? substr($price, 0, strpos($price, '.')) : $price;
    echo nl2br("\n" . $euros);
}

function showProductCard($product)
{
    if ($product['id']) : ?>
        <div class="product_card">
            <h2 class="product_name"><?php echo $product['name'] ?></h2>
            <img src="<?php echo HOME . '/storage/images/products/' . $product['image'] ?>">
            <h2 class="product_price"><?php formatPrice($product['price']) ?></h2>
        </div>
    <?php endif;
}
