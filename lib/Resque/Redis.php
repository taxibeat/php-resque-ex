<?php

class Resque_Redis extends \Predis\Client
{
    /**
     * Resque_Redis constructor.
     *
     * @param       $params
     * @param array $options
     */
    public function __construct($params, $options = [])
    {
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
