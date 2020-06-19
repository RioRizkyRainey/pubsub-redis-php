<?php

namespace RioRizkyRainey\PubsubRedis;

use Predis\Client;
use RioRizkyRainey\PubsubRedis\PublishAdapterInterface;

class RedisPublishAdapter implements PublishAdapterInterface
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
     * Get client
     * @return Client
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
     * Set channel
     * @return string $channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string $message
     */
    public function publishMessage(string $message)
    {
        $this->client->publish($this->channel, $message);
    }

    /**
     * @param array $messages
     */
    public function publishBulkMessage(array $messages)
    {
        foreach ($messages as $message) {
            $this->publishMessage($message);
        }
    }
}
