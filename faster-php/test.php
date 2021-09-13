<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: 付俊杰
 * Date: 2020/8/28
 * Time: 14:01
 * E-mail: zeroibc@qq.com
 */

// require vender autoload
require_once('vendor/autoload.php');

// add namespace at the top
use Performance\Config;
use Performance\Performance;

//Performance::point('test1',true);
//
//Performance::point('1');
//$a = 1;
//Performance::finish();
//
//Performance::point('2');
//$a = $a++;
//Performance::finish();
//
//Performance::results();

/*
 * Set config item
 */
Config::setConsoleLive(true);

/*
 * One simply performance check
 */
Performance::point();

// Run task A
for($x = 0; $x < 100; $x++)
{
    echo ".";
}

// Finish all tasks and show test results
Performance::results();