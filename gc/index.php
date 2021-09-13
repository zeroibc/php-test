<?php


$a = "string" . time();
xdebug_debug_zval('a');

function test($x, $y)
{
    xdebug_debug_zval('x');
    xdebug_debug_zval('y');
}

for ($i = 0; $i < 10; $i++) {
    test($a, $a);
    xdebug_debug_zval('i');
    xdebug_debug_zval('a');
}

test($a, $a);

xdebug_debug_zval('a');

$cc = [
    $a,
];

$cc1 = [
    1,2,$a
];


xdebug_debug_zval('cc');
xdebug_debug_zval('cc1');
