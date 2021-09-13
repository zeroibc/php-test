<?php

include_once __DIR__ . "/xhprof_lib/utils/xhprof_lib.php";
include_once __DIR__ . "/xhprof_lib/utils/xhprof_runs.php";

xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);


$a = [];

for ($i = 0; $i < 1000; $i++) {
    $a[$i] = str_pad('', $i, ' ');
}

sort($a);

asort($a);


register_shutdown_function(function () {
    $xhprof_data = xhprof_disable();

    $xhprof_runs = new XHProfRuns_Default();

    //save the run under a namespace "xhprof_foo"
    $run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");
});
