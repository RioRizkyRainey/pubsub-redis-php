<?php

namespace Tests;

use stdClass;

class MockRedisPubSubLoop extends \ArrayIterator
{
    public function __construct()
    {
        $messageSubscribe = new stdClass();
        $messageSubscribe->kind = 'subscribe';
        $messageSubscribe->payload = null;

        $message = new stdClass();
        $message->kind = 'message';
        $message->payload = '{ "test": "mock" }';

        parent::__construct([$messageSubscribe, $message]);
    }
}
