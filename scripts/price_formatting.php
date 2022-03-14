<?php

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
