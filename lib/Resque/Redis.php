<?php

class Resque_Redis extends \Predis\Client
{
    /**
     * @param array       $params
     * @param bool|string $replication
     * @param bool        $phpiredis If it should utilize phpiredis
     */
    public function __construct($params, $replication = false, $phpiredis = false)
    {
        $options = [];

        if ($phpiredis) {
            $options['connections'] = [
                'tcp' => 'Predis\Connection\PhpiredisStreamConnection',
                'unix' => 'Predis\Connection\PhpiredisSocketConnection'
            ];
        }

        if ($replication) {
            $options['replication'] = $replication;
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
