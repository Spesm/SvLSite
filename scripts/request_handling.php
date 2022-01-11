<?php
function handleRequest()
{
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    switch ($requestMethod) {
        case 'GET':
            $requestedPage = getFromUrl();
            break;
        case 'POST':
            $requestedPage = getFromPost();
            break;
        default:
            $requestedPage = getFromUrl();
    }
    return $requestedPage;
}

function getFromUrl($default = 'home')
{
    $request = str_replace('/SvLSite/', '', $_SERVER['REQUEST_URI']);
    $urlParams = explode('/', $request);
    if (in_array($urlParams[0], indexPages())) {
        return $urlParams[0];
    } else {
        return $default;
    }
}

function getFromPost($key = 'form', $default = 'home')
{
    if (null !== filter_input(INPUT_POST, $key)) {
        return filter_input(INPUT_POST, $key);
    } else {
        return $default;
    }
}
