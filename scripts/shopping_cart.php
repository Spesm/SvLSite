<?php

require_once 'C://xampp/htdocs/SvLSite/scripts/price_formatting.php';

function addToCart($productId)
{
    if (empty($_SESSION['cart'])) {
        createCart($productId);
    } elseif (!in_array($productId, array_column($_SESSION['cart'], 'id'))) {
        addProduct($productId);
    } else {
        $quantity = filter_input(INPUT_POST, 'quantity') ?? 1;
        changeQuantity($productId, $quantity);
    }
}

function createCart($productId)
{
    $_SESSION['cart'] = [[
        'id' => $productId,
        'qty' => 1,
    ]];
}

function addProduct($productId)
{
    $_SESSION['cart'][] = [
        'id' => $productId,
        'qty' => 1,
    ];
}

function changeQuantity($productId, $quantity)
{
    $_SESSION['cart'][array_search($productId, array_column($_SESSION['cart'], 'id'))]['qty'] = $quantity;

    $unitPrice = filter_input(INPUT_POST, 'unitPrice') ?? 0;
    $productSubtotal = $quantity * $unitPrice;
    echo html_entity_decode(formatPrice($productSubtotal));
}

function countProductsInCart()
{
    $productCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;

    return $productCount;
}
