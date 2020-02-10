<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: google-analytics
 *
 * Add Google Analytics tracking snippet on <head>.
 *
 * @example wpSetup('google-analytics', 'UA-111111111-1')
 */
class GoogleAnalytics extends Module
{
    /**
     * Run module
     */
    public function run()
    {
        if (!is_admin()) {
            $this->printSnippet($this->config);
        }
    }

    /**
     * Print snippet in <head>
     * @param string $id
     */
    protected function printSnippet($id)
    {
        // Don't print if an ID is not provided
        if (!isset($id) || !$id) {
            return;
        }

        // Print snippet
        add_action('wp_head', function () use ($id) {
            echo <<<EOD
  <!-- Global Site Tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=$id"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '$id');
  </script>

EOD;
        }, 10);
    }
}
