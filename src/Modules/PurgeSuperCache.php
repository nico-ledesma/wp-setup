<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: purge-super-cache
 *
 * Delete site cache when widgets or global options are updated.
 *
 * @example wpSetup('purge-super-cache')
 */
class PurgeSuperCache extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        $this->setupCachePurge();
    }

    /**
     * Delete site cache
     */
    public function purgeCache()
    {
        global $cache_path;

        $is_global_set = false;

        // Save global value to restore it later
        if (isset($GLOBALS['super_cache_enabled'])) {
            $temp = $GLOBALS['super_cache_enabled'];
            $is_global_set = true;
        }

        // This global must be set, according to plugin docs
        // @link https://odd.blog/wp-super-cache-developers/
        $GLOBALS['super_cache_enabled'] = 1;

        // Delete cache
        if (function_exists('\prune_super_cache')) {
            prune_super_cache($cache_path . 'supercache/', true);
            prune_super_cache($cache_path, true);
        }

        // Restore global to original value
        if ($is_global_set) {
            $GLOBALS['super_cache_enabled'] = $temp;
        } else {
            unset($GLOBALS['super_cache_enabled']);
        }
    }

    /**
     * Setup cache invalidation
     */
    private function setupCachePurge()
    {
        $that = $this;

        // Widget updated
        add_filter('widget_update_callback', function ($instance) use ($that) {
            $that->purgeCache();
            return $instance;
        }, 10);

        // Global option updated
        add_action('update_option', [$this, 'purgeCache'], 1);
    }
}
