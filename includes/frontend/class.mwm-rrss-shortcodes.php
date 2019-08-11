<?php
/**
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt.
 */

/**
 * Detects if the plugin has been entered directly.
 *
 * @since 1.3.0
 */
if (!defined('ABSPATH') || !defined('MWM_RRSS_VERSION')) {
    exit; // Exit if accessed directly.
}

/**
 * Check if exists the class 'mwm_rrss_shortcodes'.
 *
 * @since 1.3.0
 */
if (!class_exists('mwm_rrss_shortcodes')) {
    /**
     * Implements the mwm_rrss_shortcodes class.
     * 
     * This is the class that controls the shortcodes.
     *
     * @since 1.3.0
     */
    class mwm_rrss_shortcodes
    {
        /**
         * Constructor.
         *
         * Initialice plugin and registers shortcodes, actions and filters to be used.
         *
         * @since 1.3.0
         * 
         * @return \mwm_rrss_shortcodes
         */
        public function __construct()
        {
            // Adding shortcodes
            add_shortcode('rrss_buttons', array($this, 'mwm_rrss_basic_social_media_bar'));
        }

        /**
         * Basic social media bar.
         * 
         * Shortcut that generates the basic social media bar.
         *
         * @since 1.3.0
         * 
         * @return string/false
         */
        public function mwm_rrss_basic_social_media_bar($atts)
        {
            // Attributes
    	    $atts = shortcode_atts(
    		    array(
    			    'twitter' => '',
    			    'facebook' => '',
                    'pinterest' => '',
                    'linkedin' => '',
                    'whatsapp' => '',
                ),
                $atts,
                'rrss_buttons'
            );

            // Load the template part with atts
            ob_start();
            set_query_var( 'mwm_rrss_atts', $atts );
            mwm_template('frontend/shortcode', 'basic');
            return ob_get_clean();
        }
    }
}
