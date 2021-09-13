<?php

// 遍历目录 打印目录树 输出文件大小

$tmpStr = '';


function scan_dir($dir, $level = 0)
{
    if (!is_dir($dir)) {
        return;
    }

    $dir = realpath($dir) . '/';

    if ($dh = dir($dir)) {

        $str = '├─';
        echo $str . $dh->path . PHP_EOL;

        while (($file = $dh->read()) !== false) {
            if ($file !== '.' && $file !== '..') {
                if (is_dir($dir . $file)) {

                    echo $dir . $file . PHP_EOL;

                    scan_dir($dir . $file . '/', $level + 1);
                } else {

                    echo $dir . $file . ' ' . round(filesize($dir . $file)  / 1024 / 1024, 2) . 'MB' . PHP_EOL;

                }
            }
        }

        $dh->close();
    }
}
// var_dump($argv,$argc);
scan_dir($argv[1] ?? './');

// ├──
// │
// └──