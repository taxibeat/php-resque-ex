<?php

class Resque_Tests_TestCase extends PHPUnit_Framework_TestCase
{
    protected $resque;
    protected $redis;

    public function setUp()
    {
        $config = file_get_contents(REDIS_CONF);
        preg_match('#^\s*port\s+([0-9]+)#m', $config, $matches);
        $this->redis = new Resque_Redis('127.0.0.1', $matches[1]);
        $this->redis->prefix(REDIS_NAMESPACE);
        $this->redis->select(REDIS_DATABASE);
        // Flush redis
        $this->redis->flushAll();
    }
}