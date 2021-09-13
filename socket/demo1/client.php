<?php

function String2Hex($string)
{
    $hex = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $hex .= str_pad(dechex(ord($string[$i])), 2, '0', STR_PAD_LEFT) . ' ';
    }
    return strtoupper($hex);
}

echo String2Hex("a \r \n");
// 1101 1010