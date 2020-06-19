<?php

namespace RioRizkyRainey\PubsubRedis;

use Predis\Client;
use RioRizkyRainey\PubsubRedis\SubscribeAdapterInterface;

class RedisSubscribeAdapter implements SubscribeAdapterInterface
{

    /**
     * @var Client channel
     */
    protected $client;

    /**
     * @var string channel
     */
    protected $channel;

    /**
     *
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get channel
     *
     * @return  Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set channel
     * @param string $channel
     */
    public function setChannel(string $channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Get channel
     *
     * @return  string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param callable $handler
     */
    public function subscribe(callable $handler)
    {
        $pubSubLoop = $this->client->pubSubLoop();

        $pubSubLoop->subscribe($this->channel);

        foreach ($pubSubLoop as $message) {
            if ($message->kind === 'message') {
                call_user_func($handler, $message->payload);
            }
        }

        unset($pubSubLoop);
    }
}
