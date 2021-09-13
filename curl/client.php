<?php

// var_dump(curl_version());

// $ch = curl_init();


// echo curl_escape($ch, "http://localhost:80/test/index.html?aaa=b&ccc=d/a=faa&") . PHP_EOL;
// echo curl_unescape($ch, "%2D") . PHP_EOL;

// $postField['files'] = curl_file_create('index.php');

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_URL, 'http://localhost:8585/server.php');


// $csh = curl_share_init();
// curl_share_setopt($csh, CURLSHOPT_SHARE, CURL_LOCK_DATA_COOKIE);

// curl_setopt_array($ch, [
//     CURLOPT_SHARE => $csh,
//     CURLOPT_HEADER => true,
//     CURLOPT_HTTPHEADER => [
//         "Content-Type" => "multipart/form-data"
//     ],
//     CURLOPT_POST => true,
//     CURLOPT_POSTFIELDS => $postField
// ]);


$mh = curl_multi_init();

$allHanders = [];

for ($i = 0; $i < 10; $i++) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8585/server.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $allHanders[] = $ch;

    curl_multi_add_handle($mh, $ch);
}

// curl_reset($ch);

// $ch1 = curl_copy_handle($ch);


// $result = curl_exec($ch);
// var_dump($result);
// echo '-----------' . PHP_EOL;

// echo curl_errno($ch) . PHP_EOL;
// echo '-----------' . PHP_EOL;

// echo curl_error($ch) . PHP_EOL;
// echo '-----------' . PHP_EOL;

// echo curl_strerror(64) . PHP_EOL;
// echo '-----------' . PHP_EOL;

// var_dump(curl_getinfo($ch));

$active = null;

do {
    curl_multi_exec($mh, $active);
} while ($active);


// while ($active && $mrc == CURLM_OK) {
//     if (curl_multi_select($mh) == -1) {
//         usleep(100);
//     }
//     do {
//         $mrc = curl_multi_exec($mh, $active);
//     } while ($mrc == CURLM_CALL_MULTI_PERFORM);
// }


foreach ($allHanders as $ch) {
    $result = curl_multi_getcontent($ch);

    var_dump($result);

    curl_multi_remove_handle($mh, $ch);
}

// curl_close($ch);
// curl_close($csh);
curl_multi_close($mh);
