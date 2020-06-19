<?php

namespace Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use Predis\Client;
use RioRizkyRainey\PubsubRedis\RedisPublishAdapter;

class RedisPublishAdapterTest extends TestCase
{
    /**
     * @covers \RioRizkyRainey\PubsubRedis\RedisPublishAdapter::setClient
     * @covers \RioRizkyRainey\PubsubRedis\RedisPublishAdapter::getClient
     */
    public function testGetClient()
    {
        $client = Mockery::mock(Client::class);
        $adapter = new RedisPublishAdapter();
        $adapter->setClient($client);
        $this->assertSame($client, $adapter->getClient());
    }

    /**
     * @covers \RioRizkyRainey\PubsubRedis\RedisPublishAdapter::setChannel
     * @covers \RioRizkyRainey\PubsubRedis\RedisPublishAdapter::getChannel
     */
    public function testGetChannel()
    {
        $adapter = new RedisPublishAdapter();
        $adapter->setChannel('channel');
        $this->assertSame('channel', $adapter->getChannel());
    }

    /**
     * @covers \RioRizkyRainey\PubsubRedis\RedisPublishAdapter::publishMessage
     */
    public function testPublishMessage()
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('publish')
            ->withArgs([
                'channel',
                '{"test":"mock"}',
            ])
            ->once();

        $adapter = new RedisPublishAdapter();
        $adapter->setClient($client)
            ->setChannel('channel')
            ->publishMessage('{"test":"mock"}');

        $this->assertTrue(true);
    }

    /**
     * @covers \RioRizkyRainey\PubsubRedis\RedisPublishAdapter::publishBulkMessage
     */
    public function testPublishBulkMessage()
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('publish')
            ->withArgs([
                'channel',
                'messageSubscribe',
            ])
            ->once();

        $client->shouldReceive('publish')
            ->withArgs([
                'channel',
                'message',
            ])
            ->once();

        $adapter = new RedisPublishAdapter();
        $messages = [
            'messageSubscribe',
            'message',
        ];

        $adapter->setClient($client)
            ->setChannel('channel')
            ->publishBulkMessage($messages);

        $this->assertTrue(true);
    }
}
