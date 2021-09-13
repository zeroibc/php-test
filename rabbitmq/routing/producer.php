<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// 创建连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'zero', 'zero');
// 创建信道
$channel = $connection->channel();
// 定义或指定交换机（直接路由到RouteKey）
$channel->exchange_declare('direct_logs', 'direct', false, false, false);
// // 定义或指定队列
// $channel->queue_declare('hello', false, false, false, false);

// 创建消息
$msg = new AMQPMessage('Hello World!');

// 发布消息 指定RouteKey
$channel->basic_publish($msg, 'direct_logs', ['q1', 'q2'][array_rand([0, 1])]);

echo " [x] Sent 'Hello World!'\n";

// 关闭信道
$channel->close();
// 关闭连接
$connection->close();
