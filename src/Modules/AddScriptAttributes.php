<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: add-script-attributes
 *
 * Add custom attributes to scripts. Basically used for async/defer.
 *
 * @example wpSetup('add-script-attributes', ['script-handle' => 'async defer'])
 */
class AddScriptAttributes extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        $this->addAttributes($this->config);
    }

    /**
     * Add script attributes
     */
    private function addAttributes($args)
    {
        if (!is_array($args)) {
            return;
        }

        $scripts = array_keys($args);

        add_filter('script_loader_tag', function ($tag, $handle) use ($scripts, $args) {
            if (in_array($handle, $scripts)) {
                $replace = ' ' . $args[$handle] . ' src';
                $tag = str_replace(' src', $replace, $tag);
            }

            return $tag;
        }, 10, 2);
    }
}
