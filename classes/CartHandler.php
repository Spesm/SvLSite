<?php

namespace Classes;

use Models\Product;

class CartHandler
{
    private static $product = [];
    private static $quantity = 0;
    private static $response = [];

    public static function respond()
    {
        self::$product = self::getProduct();
        self::$quantity = filter_input(INPUT_POST, 'quantity') ?? 1;

        if (filter_input(INPUT_POST, 'update_cart')) {
            self::updateCart();
        }
        if (filter_input(INPUT_POST, 'product_cost')) {
            self::calculateProductTotal();
        }
        if (filter_input(INPUT_POST, 'cart_count')) {
            self::countProductsInCart();
        }
        if (filter_input(INPUT_POST, 'cart_cost')) {
            self::calculateCartTotal();
        }
        if (!empty(self::$response)) {
            echo html_entity_decode(json_encode(self::$response));
        }
    }

    public static function getProduct()
    {
        $productId = filter_input(INPUT_POST, 'cart_product') ?? false;
        $product = $productId ? Product::getProductBy($productId) : false;

        if (!$product) {
            die("The server could not find the requested product");
        } else {
            return $product;
        }
    }

    public static function createCart()
    {
        $_SESSION['cart'] = [];
    }

    public static function addProductToCart()
    {
        $_SESSION['cart'][] = [
            'id' => self::$product['id'],
            'qty' => self::$quantity,
            'cost' => self::$product['price'] * self::$quantity,
        ];
    }

    public static function removeProductFromCart()
    {
        $key = array_search(self::$product['id'], array_column($_SESSION['cart'], 'id'));
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    public static function updateCart()
    {
        if (!isset($_SESSION['cart'])) {
            self::createCart();
        }
        if (!in_array(self::$product['id'], array_column($_SESSION['cart'], 'id'))) {
            self::addProductToCart();
        } elseif (filter_input(INPUT_POST, 'remove_product')) {
            self::removeProductFromCart();
        } elseif (filter_input(INPUT_POST, 'add_to_current')) {
            self::$quantity = $_SESSION['cart'][array_search(self::$product['id'], array_column($_SESSION['cart'], 'id'))]['qty'] += self::$quantity;
            self::updateProductCost();
        } else {
            $_SESSION['cart'][array_search(self::$product['id'], array_column($_SESSION['cart'], 'id'))]['qty'] = self::$quantity;
            self::updateProductCost();
        }
    }

    public static function updateProductCost()
    {
        $_SESSION['cart'][array_search(self::$product['id'], array_column($_SESSION['cart'], 'id'))]['cost'] = self::$product['price'] * self::$quantity;
    }

    public static function calculateProductTotal()
    {
        $productCost = self::$product['price'] * self::$quantity;
        self::$response['product_cost'] = formatPrice($productCost);
    }

    public static function countProductsInCart()
    {
        $cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
        self::$response['cart_count'] = $cartCount;

        return $cartCount;
    }

    public static function calculateCartTotal()
    {
        $cartCost = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'cost')) : 0;
        self::$response['cart_cost'] = formatPrice($cartCost);

        return formatPrice($cartCost);
    }
}
