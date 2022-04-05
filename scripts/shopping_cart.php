<?php

require_once 'C://xampp/htdocs/SvLSite/scripts/price_formatting.php';
require_once 'C://xampp/htdocs/SvLSite/models/Product.php';

function addToCart($productId)
{
    if (empty($_SESSION['cart'])) {
        createCart($productId);
    } elseif (!in_array($productId, array_column($_SESSION['cart'], 'id'))) {
        addProduct($productId);
    } elseif (isset($_POST['delete'])) {
        removeProduct($productId);
    } else {
        $quantity = filter_input(INPUT_POST, 'quantity') ?? $_SESSION['cart'][array_search($productId, array_column($_SESSION['cart'], 'id'))]['qty'] += 1;
        changeQuantity($productId, $quantity);
    }
}

function getUnitPrice($productId)
{
    $product = Product::getProductBy($productId);

    return $product['price'];
}

function setProduct($productId)
{
    $cartItem = [
        'id' => $productId,
        'qty' => 1,
        'price' => getUnitPrice($productId),
    ];

    return $cartItem;
}

function createCart($productId)
{
    $_SESSION['cart'] = [setProduct($productId)];
}

function addProduct($productId)
{
    $_SESSION['cart'][] = setProduct($productId);
}

function changeQuantity($productId, $quantity)
{
    $unitPrice = getUnitPrice($productId);
    $productSubtotal = $quantity * $unitPrice;

    $_SESSION['cart'][array_search($productId, array_column($_SESSION['cart'], 'id'))]['qty'] = $quantity;
    $_SESSION['cart'][array_search($productId, array_column($_SESSION['cart'], 'id'))]['price'] = $productSubtotal;

    $return = json_encode([
        'product-subtotal' => formatPrice($productSubtotal),
        'cart-total' => calculateCartTotal(),
    ]);

    echo html_entity_decode($return);
}

function removeProduct($productId)
{
    $key = array_search($productId, array_column($_SESSION['cart'], 'id'));
    unset($_SESSION['cart'][$key]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    echo html_entity_decode(calculateCartTotal());
}

function countProductsInCart()
{
    $productCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;

    return $productCount;
}

function calculateCartTotal()
{
    $totalAmount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'price')) : 0;

    return formatPrice($totalAmount);
}
