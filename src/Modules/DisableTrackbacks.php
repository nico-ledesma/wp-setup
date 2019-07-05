<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: disable-trackbacks
 *
 * Disable trackbacks and pingbacks.
 *
 * @example wpSetup('disable-trackbacks')
 */
class DisableTrackbacks extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        $this->disable();
    }

    /**
     * Disable trackbacks/pingbacks
     */
    private function disable()
    {
        // Disable pingback XMLRPC method
        add_filter('xmlrpc_methods', function ($methods) {
            unset($methods['pingback.ping']);
            return $methods;
        }, 10, 1);

        // Remove pingback header
        add_filter('wp_headers', function ($headers) {
            if (isset($headers['X-Pingback'])) {
                unset($headers['X-Pingback']);
            }
            return $headers;
        }, 10, 1);

        // Kill trackback rewrite rule
        add_filter('rewrite_rules_array', function ($rules) {
            foreach ($rules as $rule => $rewrite) {
                if (preg_match('/trackback\/\?\$$/i', $rule)) {
                    unset($rules[$rule]);
                }
            }
            return $rules;
        });

        // Kill bloginfo('pingback_url')
        add_filter('bloginfo_url', function ($output, $show) {
            if ($show === 'pingback_url') {
                $output = '';
            }
            return $output;
        }, 10, 2);

        // Disable XMLRPC call
        add_action('xmlrpc_call', function ($action) {
            if ($action === 'pingback.ping') {
                wp_die('Pingbacks are not supported', 'Not Allowed!', ['response' => 403]);
            }
        });
    }
}
