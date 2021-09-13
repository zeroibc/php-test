<?php

echo ob_get_level() . PHP_EOL;

ob_start();

echo "ob1" . PHP_EOL;

ob_start();

echo "ob2" . PHP_EOL;

ob_clean();

echo "ob3" . PHP_EOL;

$str = (ob_get_contents());

// ob_end_clean();

echo "ob4" . PHP_EOL;

var_dump($str);

var_dump(ob_get_status());