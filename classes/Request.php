<?php

require_once 'index.php';
require_once 'scripts/page_building.php';
require_once 'scripts/shopping_cart.php';

class Request
{
    public static function handle()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'GET':
                self::handleGetRequest();
                break;
            case 'POST':
                self::handlePostRequest();
                break;
            default:
                echo 'Request type could not be resolved.';
        }
    }

    public static function handleGetRequest($default = 'home')
    {
        $request = str_replace('/SvLSite/', '', $_SERVER['REQUEST_URI']);
        $urlParams = explode('/', $request);

        if (in_array($urlParams[0], indexPages())) {
            renderPage($urlParams[0]);
        } elseif (empty($urlParams[0])) {
            renderPage($default);
        } else {
            echo 'Requested page unknown.';
        }
    }

    public static function handlePostRequest()
    {
        if (isset($_POST['form'])) {
            $form = filter_input(INPUT_POST, 'form');
            renderPage($form);
        } elseif (isset($_POST['product'])) {
            $product = filter_input(INPUT_POST, 'product');
            addToCart($product);
        }
    }
}
