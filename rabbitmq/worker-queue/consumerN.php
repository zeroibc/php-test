<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
// 创建连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'zero', 'zero');
// 创建信道
$channel = $connection->channel();

// 定义并指定队列
$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

// 监听队列消息
$channel->basic_consume('hello', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}