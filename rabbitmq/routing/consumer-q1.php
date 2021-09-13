<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
// 创建连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'zero', 'zero');
// 创建信道
$channel = $connection->channel();
// 定义或指定交换机（扇形，广播）
$channel->exchange_declare('direct_logs', 'direct', false, false, false);

// 获取临时队列
list($queue_name,,) = $channel->queue_declare("", false, false, true, false);

// 队列绑定交换机 指定RouteKey
$channel->queue_bind($queue_name, 'direct_logs', 'q1');

echo " [*] Waiting for direct_logs. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] ', $msg->body, "\n";
};

// 监听队列消息
$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();
