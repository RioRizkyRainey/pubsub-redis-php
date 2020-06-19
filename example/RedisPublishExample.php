<?php

include __DIR__ . '/../vendor/autoload.php';

$client = new Predis\Client([
    'scheme' => 'tcp',
    'host' => 'redis',
    'port' => 6379,
    'database' => 0,
    'read_write_timeout' => 0,
]);

$redisPublishAdapter = new \RioRizkyRainey\PubsubRedis\RedisPublishAdapter();
$redisPublishAdapter->setClient($client)
    ->setChannel('channel');

$redisPublishAdapter->publishMessage('Hi, How do you do?');
$redisPublishAdapter->publishBulkMessage(['Nice to meet you', 'Where are you going?']);
$redisPublishAdapter->publishMessage('I don\'t feel good mr stark');
