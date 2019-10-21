<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


$connection = new AMQPStreamConnection(
    '172.16.238.2',
    5672,
    'guest',
    'guest');

$channel = $connection->channel();

$channel->queue_declare(
    'hello',
    false,
    false,
    false,
    false
    );

$message = new AMQPMessage('Hello RabbitMQ, A message for you!');

$channel->basic_publish($message, '', 'hello');

$channel->close();
$connection->close();
