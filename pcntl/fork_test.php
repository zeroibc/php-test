<?php

$pid = pcntl_fork();

if ($pid === 0) {
    echo 'this is a child process' . PHP_EOL;
    posix_kill(posix_getpid(), SIGTERM);

    exit(0);
} elseif ($pid === -1) {
    echo pcntl_strerror(pcntl_get_last_error()) . PHP_EOL;

    exit(1);
}

echo 'this is a master process' . PHP_EOL;

pcntl_wait($status);


var_dump(pcntl_wexitstatus($status));
var_dump(pcntl_wifexited($status));
var_dump(pcntl_wifsignaled($status));
var_dump(pcntl_wifstopped($status));
var_dump(pcntl_wstopsig($status));
var_dump(pcntl_wtermsig($status));
