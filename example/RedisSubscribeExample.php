<?php

include __DIR__ . '/../vendor/autoload.php';

$client = new Predis\Client([
    'scheme' => 'tcp',
    'host' => 'redis',
    'port' => 6379,
    'database' => 0,
    'read_write_timeout' => 0,
]);

$redisPublishAdapter = new \RioRizkyRainey\PubsubRedis\RedisSubscribeAdapter();
$redisPublishAdapter->setClient($client)
    ->setChannel('channel')
    ->subscribe(function ($message) {
        printf($message . PHP_EOL);
    });
