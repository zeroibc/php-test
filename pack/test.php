<?php

// $string = pack('N@6Xx2',"255");
$string = pack('H*', 0x12);
var_dump($string);

for ($i = 0; $i < strlen($string); $i++) {
    // echo ord($string[$i]) . PHP_EOL;
    // printf('%x', $string);
}

// $int = unpack('N*', $string);
// var_dump($int);

// 255
// 0 0 0 255 大端序
// 255 0 0 0 小端序