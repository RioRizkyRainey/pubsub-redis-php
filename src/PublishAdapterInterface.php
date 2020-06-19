<?php

namespace RioRizkyRainey\PubsubRedis;

interface PublishAdapterInterface
{

    /**
     * Set channel
     * @param string $channel
     */
    public function setChannel(string $channel);

    /**
     * Set channel
     * @return string $channel
     */
    public function getChannel();

    /**
     * @param string $message
     */
    public function publishMessage(string $message);

    /**
     * @param array $messages
     */
    public function publishBulkMessage(array $messages);
}
