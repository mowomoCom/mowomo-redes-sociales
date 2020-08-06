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
 * @since 1.0.0
 */
if (!defined('ABSPATH') || !defined('MWM_FRA_VERSION')) {
    exit; // Exit if accessed directly.
}

/**
 * Check if exists the class 'mwm_plugin'.
 *
 * @since 1.0.0
 */
if (!class_exists('mwm_plugin')) {
    /**
     * Implements the mwm_plugin class.
     * 
     * This is the class that controls the entire plugin.
     *
     * @since 1.0.0
     */
    class mwm_plugin
    {
        /**
         * Variable
         * 
         * Plugin Slug
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $slug = '';

        /**
         * Variable
         * 
         * Plugin name
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $name = '';

        /**
         * Variable
         * 
         * Version of the plugin
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $version = '';

        /**
         * Variable
         * 
         * Plugin update url
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $update_url = '';

        /**
         * Variable
         * 
         * Plugin pro version
         *
         * @since 1.0.0
         * 
         * @return bool
         */
        protected $is_pro = false;

        /**
         * Variable
         * 
         * Plugin pro license
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $pro_license = '';

        /**
         * Variable
         * 
         * Plugin update message
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $update_message = '';

        /**
         * Variable
         * 
         * Plugin notifications
         *
         * @since 1.0.0
         * 
         * @return array
         */
        protected $notifications = array();

        /**
         * Constructor
         *
         * Initialice plugin and registers actions and filters to be used.
         *
         * @since 1.0.0
         * 
         * @return \mwm_plugin
         */
        public function __construct($slug, $name, $version, $update_url, $is_pro, $pro_license, $update_message)
        {
            // Initialization of all information
            if (is_string($slug)) $this->slug = $slug;
            if (is_string($name)) $this->name = $name;
            if (is_string($version)) $this->version = $version;
            if (is_string($update_url)) $this->update_url = $update_url;
            if (is_bool($is_pro)) $this->is_pro = $is_pro;
            if (is_string($pro_license)) $this->pro_license = $pro_license;
            if (is_string($update_message)) $this->update_message = $update_message;
        }

        /**
         * Return an object with plugin info
         * 
         * @since      1.0.0
         *
         * @return array
        */
        public function get_info($properties = '')
        {
            $object = new stdClass();

            if (is_array($properties) && sizeof($properties) > 0) {
                foreach ($properties as $key => $property) {
                    if (property_exists($this, $property)) {
                        $object->$property = $this->$property;
                    }
                }
            } else if ($properties != '') {
                if (property_exists($this, $properties)) {
                    $object = $this->$properties;
                } else {
                    $object = false;
                }
            } else {
                $object->slug = $this->slug;
                $object->name = $this->name;
                $object->version = $this->version;
                $object->update_url = $this->update_url;
                $object->pro_license = $this->pro_license;
                $object->update_message = $this->update_message;
                $object->notifications = $this->notifications;
            }
            
            return $object;
        }

        /**
         * Add a notification to the notifications array
         * 
         * @since      1.0.0
         *
         * @return array
        */
        public function add_notification($notification)
        {
            if (!is_a($notification, 'mwm_notification')) return false;
            return array_push($this->notifications, $notification);
        }
    }
}