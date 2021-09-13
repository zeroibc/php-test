<?php

function echoError($sock)
{
    echo socket_strerror(socket_last_error($sock)) . PHP_EOL;
}

// function String2Hex($string)
// {
//     $hex = '';
//     for ($i = 0; $i < strlen($string); $i++) {
//         $hex .= dechex(ord($string[$i]));
//     }
//     return $hex;
// }

function String2Hex($string)
{
    // http://ascii.911cha.com/
    $hex = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $hex .= str_pad(dechex(ord($string[$i])), 2, '0', STR_PAD_LEFT) . ' ';
    }
    return strtoupper($hex);
}

// 创建socket
if (!is_resource($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP))) {
    echoError($sock);

    exit - 1;
}

// 绑定ip 和 port
if (!socket_bind($sock, '0.0.0.0', 9696)) {
    echoError($sock);

    exit - 1;
}

// 开启监听socket
if (!socket_listen($sock, 1)) {
    echoError($sock);

    exit - 1;
}

// 设置为非阻塞模式
if (!socket_set_nonblock($sock)) {
    echoError($sock);

    exit - 1;
}

$clients = [];
while (true) {
    if (($newSock = socket_accept($sock)) !== false) {
        echo "Client $newSock has connected\n";
        $clients[] = $newSock;
    }

    foreach ($clients as $key => $cSock) {
        $buf = '';
        $len = socket_recv($cSock, $buf, 20, 0);
        // $buf = socket_read($cSock, 1024);
        if ($len === false) {
            // if ($buf === false) {
            // echoError($cSock);
            continue;
        } elseif ($len === 0) {
            socket_close($cSock);
            unset($clients[$key]);
            break;
        } else {
            echo  $len . PHP_EOL;
            echo  $buf . PHP_EOL;
            echo  String2Hex($buf) . PHP_EOL;
        }
    }

    sleep(1);
    echo '.....' . PHP_EOL;
}
