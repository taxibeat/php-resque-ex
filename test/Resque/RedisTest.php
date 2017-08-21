<?php

use Predis\Client;

require_once __DIR__.'/../bootstrap.php';

class RedisTest extends Resque_Tests_TestCase
{
    private $redisent_methods = array(
        'exists',
        'del',
        'type',
        'keys',
        'expire',
        'ttl',
        'move',
        'set',
        'get',
        'getset',
        'setnx',
        'incr',
        'incrby',
        'decr',
        'decrby',
        'rpush',
        'lpush',
        'llen',
        'lrange',
        'ltrim',
        'lindex',
        'lset',
        'lrem',
        'lpop',
        'rpop',
        'sadd',
        'srem',
        'spop',
        'scard',
        'sismember',
        'smembers',
        'srandmember',
        'zadd',
        'zrem',
        'zrange',
        'zrevrange',
        'zrangebyscore',
        'zcard',
        'zscore',
        'zremrangebyscore',
        'sort'
    );

    private $predis_methods = array(
        'exists',
        'del',
        'type',
        'keys',
        'expire',
        'ttl',
        'move',
        'set',
        'setex',
        'get',
        'getset',
        'setnx',
        'incr',
        'incrby',
        'decr',
        'decrby',
        'rpush',
        'lpush',
        'llen',
        'lrange',
        'ltrim',
        'lindex',
        'lset',
        'lrem',
        'lpop',
        'blpop',
        'rpop',
        'sadd',
        'srem',
        'spop',
        'scard',
        'sismember',
        'smembers',
        'srandmember',
        'hdel',
        'hexists',
        'hget',
        'hgetall',
        'hincrby',
        'hincrbyfloat',
        'hkeys',
        'hlen',
        'hmget',
        'hmset',
        'hset',
        'hsetnx',
        'hvals',
        'zadd',
        'zrem',
        'zrange',
        'zrevrange',
        'zrangebyscore',
        'zrevrangebyscore',
        'zcard',
        'zscore',
        'zremrangebyscore',
        'sort',
    );

    public function testInstance()
    {
        $this->assertInstanceOf(RedisApi::class, $this->redis);
        $this->assertTrue(is_subclass_of($this->redis, Client::class));

        foreach ($this->redisent_methods as $method) {
            $this->assertTrue(is_callable(array($this->redis, $method)));
        }

        foreach ($this->predis_methods as $method) {
            $this->assertTrue(is_callable(array($this->redis, $method)));
        }
    }

    public function testFlush()
    {
        /** @var  \Predis\Response\Status $flush_success */
        $flush_success = $this->redis->flushAll();
        $this->assertInstanceOf('\Predis\Response\Status', $flush_success);
        $this->assertSame('OK', $flush_success->getPayload());
    }
}