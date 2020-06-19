<?php

namespace RioRizkyRainey\PubsubRedis;

interface SubscribeAdapterInterface
{

    /**
     * Set channel
     * @param string $channel
     */
    public function setChannel(string $channel);

    /**
     * Set channel
     * @return string
     */
    public function getChannel();

    /**
     * @param callable $handler
     */
    public function subscribe(callable $handler);
}
