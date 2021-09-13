<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// 创建连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'zero', 'zero');
// 创建信道
$channel = $connection->channel();

// 开启发布消息确认
$channel->confirm_select();
// 成功的消息回调
$channel->set_ack_handler(function(AMQPMessage $message){
    var_dump(123, $message);
});
// 失败的消息回调
$channel->set_nack_handler(function (AMQPMessage $message) {
});

// 定义或指定交换机（主题模式 路由到匹配的RouteKey）
$channel->exchange_declare('topic_logs', 'topic', false, true, false);
// // 定义或指定队列
// $channel->queue_declare('hello', false, false, false, false);

// 创建消息
$msg = new AMQPMessage('Hello World!');

// 发布消息 指定RouteKey
$channel->basic_publish($msg, 'topic_logs', ['q.q1', 'q.q2.qq1'][array_rand([0, 1])]);

echo " [x] Sent 'Hello World!'\n";

// 等待ACK
$channel->wait_for_pending_acks(5.000);

// 关闭信道
$channel->close();
// 关闭连接
$connection->close();
