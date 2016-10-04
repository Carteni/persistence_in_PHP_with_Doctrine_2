<?php
namespace AppBundle\Interfaces;

use Predis\ClientInterface;

interface RedisDefaultCacheInterface
{
    public function setDefaultCache(ClientInterface $client);

    public function getDefaultCache():ClientInterface;
}