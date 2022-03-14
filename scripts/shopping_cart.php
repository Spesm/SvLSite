<?php

function addToCart($productId)
{
    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'] = [[
            'id' => $productId,
            'qty' => 1,
        ]];
    } elseif (!in_array($productId, array_column($_SESSION['cart'], 'id'))) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'qty' => 1,
        ];
    } else {
        $_SESSION['cart'][array_search($productId, array_column($_SESSION['cart'], 'id'))]['qty']++;
    }
}

function countProductsInCart()
{
    $productCount = $_SESSION['cart'] ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
    
    return $productCount;
}
