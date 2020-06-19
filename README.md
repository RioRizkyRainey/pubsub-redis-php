# Pub/Sub Redis for PHP

Pub/Sub Redis for php

![PHP Composer](https://github.com/RioRizkyRainey/pubsub-redis-php/workflows/PHP%20Composer/badge.svg)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Before you go make sure you already install Redis.

### Installing

Install with composer

```
composer require riorizkyrainey/pubsub-redis-php
```

## Usage - Subscribe

```
$client = new Predis\Client([
    'scheme' => 'tcp',
    'host' => 'redis',
    'port' => 6379,
    'database' => 0,
    'read_write_timeout' => 0,
]);

$redisSubscribeAdapter = new \RioRizkyRainey\PubsubRedis\RedisSubscribeAdapter();
$redisSubscribeAdapter->setClient($client)
    ->setChannel('channel')
    ->subscribe(function ($message) {
        printf($message . PHP_EOL);
    });

```

## Usage - Publisher

```
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

```

## Built With

* [Predis](https://github.com/nrk/predis) - Flexible and feature-complete Redis client for PHP and HHVM
* [PHPUnit](https://github.com/sebastianbergmann/phpunit) - The PHP Unit Testing framework.
* [Mockery](https://github.com/mockery/mockery) - Mockery is a simple yet flexible PHP mock object framework for use in unit testing with PHPUnit

## Contributing

Please read [CONTRIBUTING.md] for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Rio Rizky Rainey** - *Initial work* - (https://github.com/RioRizkyRainey)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Inspired from [Superbalist](https://github.com/Superbalist)
