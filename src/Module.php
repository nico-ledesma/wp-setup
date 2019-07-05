<?php

namespace Cusqo\WPSetup;

class Module
{
    protected $config;

    /**
     * Constructor
     * @param mixed $config
     */
    public function __construct($config = false)
    {
        $this->config = $config;
    }
}
