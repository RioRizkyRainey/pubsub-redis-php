<?php

namespace Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use Predis\Client;
use RioRizkyRainey\PubsubRedis\RedisSubscribeAdapter;

class RedisSubscribeAdapterTest extends TestCase
{
    /**
     * @covers \RioRizkyRainey\PubsubRedis\RedisSubscribeAdapter::setClient
     * @covers \RioRizkyRainey\PubsubRedis\RedisSubscribeAdapter::getClient
     */
    public function testGetClient()
    {
        $client = Mockery::mock(Client::class);
        $adapter = new RedisSubscribeAdapter();
        $adapter->setClient($client);
        $this->assertSame($client, $adapter->getClient());
    }

    /**
     * @covers \RioRizkyRainey\PubsubRedis\RedisSubscribeAdapter::setChannel
     * @covers \RioRizkyRainey\PubsubRedis\RedisSubscribeAdapter::getChannel
     */
    public function testGetChannel()
    {
        $adapter = new RedisSubscribeAdapter();
        $adapter->setChannel('channel');
        $this->assertSame('channel', $adapter->getChannel());
    }

    /**
     * @covers \RioRizkyRainey\PubsubRedis\RedisSubscribeAdapter::subscribe
     */
    public function testSubscribe()
    {
        $mockRedisPubSubLoop = Mockery::mock('\Tests\MockRedisPubSubLoop[subscribe]');
        $mockRedisPubSubLoop->shouldReceive('subscribe')
            ->once();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('pubSubLoop')
            ->once()
            ->andReturn($mockRedisPubSubLoop);

        $adapter = new RedisSubscribeAdapter();

        $handler = Mockery::mock(\stdClass::class);
        $handler->shouldReceive('handle')
            ->with('{ "test": "mock" }')
            ->once();

        $adapter->setClient($client)
            ->setChannel('channel')
            ->subscribe([$handler, 'handle']);

        $this->assertTrue(true);
    }
}
