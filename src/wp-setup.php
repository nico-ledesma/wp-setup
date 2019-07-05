<?php

namespace Cusqo\WPSetup;

/**
 * Run a specific module
 * @param string $module
 * @param mixed $config
 */
function wpSetup($module = false, $args = false)
{
    $class = __NAMESPACE__ . '\Modules\\' . str_replace('-', '', ucwords($module, '-'));
    $instance = new $class($args);
    $instance->run();
}
