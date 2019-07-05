<?php

namespace Cusqo\WPSetup\Modules;

use Cusqo\WPSetup\Module;

/**
 * Module: facebook-pixel
 *
 * Add Facebook Pixel tracking snippet in <head>.
 *
 * @example wpSetup('facebook-pixel', '1111111111111111')
 */
class FacebookPixel extends Module
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
    private function printSnippet($id)
    {
        // Don't print if an ID is not provided
        if (!isset($id) || !$id) {
            return;
        }

        // Print snippet
        add_action('wp_head', function () use ($id) {
            echo <<<EOD
  <!-- Facebook Pixel Code -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '$id');
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=$id&ev=PageView&noscript=1"/>
  </noscript>
  <!-- End Facebook Pixel Code -->

EOD;
        }, 10);
    }
}
