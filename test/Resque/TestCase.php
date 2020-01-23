<?php

class Resque_Tests_TestCase extends PHPUnit_Framework_TestCase
{
    protected $resque;
    protected $redis;

    public function setUp()
    {
        $config = file_get_contents(REDIS_CONF);
        preg_match('#^\s*port\s+([0-9]+)#m', $config, $matches);
        $this->redis = new Resque_Redis([
            'host' => '127.0.0.1',
            'port' => $matches[1],
            'database' => REDIS_DATABASE
        ]);
        $this->redis->prefix(REDIS_NAMESPACE);
        // Flush redis
        $this->redis->flushAll();
    }
}