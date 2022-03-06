<?php

require_once ROOT . '/models/product.php';

function showWebshopContent($render = true)
{
    $products = Product::getProducts();

    if ($render) : ?>
        <div class="content">
            <h1 class="product-header">Offers you can't refuse</h1>
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
        <div class="product-card">
            <h1 class="product-name"><?php echo $product['name'] ?></h1>
            <img src="<?php echo HOME . '/storage/images/products/' . $product['image'] ?>">
            <span class="price-tag">
                <h2 class="euros"><?php echo formatEuros($product['price']) ?></h2>
                <h4 class="cents"><?php echo formatCents($product['price']) ?></h4>
            </span>
            <div class="product-action">
                <button class="add-product-button">Buy</button>
            </div>
        </div>
    <?php endif;
}

function formatEuros($price)
{
    $euros = strpos($price, '.') ? substr($price, 0, strpos($price, '.')) : $price;

    if (strlen($euros) > 3) {
        $n = 0;
        $figure = '';
        $digits = str_split(strrev($euros));
        foreach ($digits as $digit) {
            $figure .= $n % 3 === 0 ? '.' . $digit : $digit;
            $n++;
        }
        $euros = substr(strrev($figure), 0, strlen($figure) - 1);
    }

    return '&euro; ' . $euros . ',';
}

function formatCents($price)
{
    $cents = strpos($price, '.') ? substr($price, strpos($price, '.') + 1, 2) : '00';
    if (strlen($cents) < 2) {
        $cents .= '0';
    }

    return $cents;
}
