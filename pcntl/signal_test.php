<?php
//declare(strict_types=1, ticks=1);


//使用ticks需要PHP 4.3.0以上版本
declare(ticks=1);

//信号处理函数
function sig_handler($signo)
{

    switch ($signo) {
        case SIGTERM:
            echo "Caught SIGTERM...\n";
            exit;
            break;
        case SIGHUP:
            echo "Caught SIGHUP...\n";
            break;
        case SIGALRM:
            echo "Caught SIGALRM...\n";
            pcntl_alarm(6);
            break;
        case SIGUSR1:
            echo "Caught SIGUSR1...\n";
            break;
        default:
            // 处理所有其他信号
    }
}

echo "Installing signal handler...\n";

//安装信号处理器
pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGALRM, "sig_handler");
pcntl_signal(SIGHUP,  "sig_handler");
pcntl_signal(SIGUSR1, "sig_handler");

// 或者在PHP 4.3.0以上版本可以使用对象方法
// pcntl_signal(SIGUSR1, array($obj, "do_something");

echo "Generating signal SIGTERM to self...\n";

//向当前进程发送SIGUSR1信号
posix_kill(posix_getpid(), SIGUSR1);

//function tick_handler()
//{
//    echo "tick_handler() called\n";
//}
//
//register_tick_function('tick_handler');

pcntl_alarm(6);

while (true) {
    sleep(3);
    //    pcntl_signal_dispatch();
    echo "test\n";
}
echo "Done\n";
