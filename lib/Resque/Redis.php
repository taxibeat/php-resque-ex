<?php

class Resque_Redis extends \Predis\Client
{
    /**
     * Resque_Redis constructor.
     *
     * @param             $params
     * @param bool|string $replication
     * @param bool        $phpiredis
     * @param bool        $cluster_mode
     */
    public function __construct($params, $replication = false, $phpiredis = false, $cluster_mode = false)
    {
        $options = [];

        if ($phpiredis) {
            $options['connections'] = [
                'tcp' => 'Predis\Connection\PhpiredisStreamConnection',
                'unix' => 'Predis\Connection\PhpiredisSocketConnection',
            ];
        }

        if ($replication) {
            $options['replication'] = $replication;
        }
        if ($cluster_mode) {
            $options['cluster'] = 'redis';
        }

        parent::__construct($params, $options);
    }

    /**
     * Set Redis prefix
     *
     * @param string $prefix
     */
    public function prefix($prefix = '')
    {
        if (!empty($prefix)) {
            if (strpos($prefix, ':') === false) {
                $prefix .= ':';
            }

            $processor = new Predis\Command\Processor\KeyPrefixProcessor($prefix);
            $this->getProfile()->setProcessor($processor);
        }
    }
}
