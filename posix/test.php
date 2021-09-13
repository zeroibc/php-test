<?php

echo posix_ctermid() . PHP_EOL;
echo posix_getcwd() . PHP_EOL;
echo posix_getppid() . PHP_EOL;
echo posix_getpid() . PHP_EOL;
echo posix_getegid() . PHP_EOL;
echo posix_geteuid() . PHP_EOL;
echo posix_getgid() . PHP_EOL;
//echo posix_getgrgid() . PHP_EOL;
var_dump(posix_getgrnam('root'));
var_dump(posix_getgroups());
echo posix_getlogin() . PHP_EOL;
//echo posix_getpgid() . PHP_EOL;
echo posix_getpgrp() . PHP_EOL;
echo posix_getpid() . PHP_EOL;
var_dump(posix_getpwnam('root'));
var_dump(posix_getpwuid('1000'));
var_dump(posix_getrlimit());
var_dump(posix_getsid(posix_getpid()));
var_dump(posix_getuid());
var_dump(posix_uname());
var_dump(posix_ttyname(STDIN));
