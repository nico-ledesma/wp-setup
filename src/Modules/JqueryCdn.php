<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: jquery-cdn
 *
 * Load jQuery from a CDN on the front-end.
 *
 * @example wpSetup('jquery-cdn')
 */
class JqueryCdn extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        if (!is_admin()) {
            $this->replaceJQuery();
        }
    }

    /**
     * Load jQuery from a CDN
     */
    protected function replaceJQuery()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', [], false, true);
        });
    }
}
