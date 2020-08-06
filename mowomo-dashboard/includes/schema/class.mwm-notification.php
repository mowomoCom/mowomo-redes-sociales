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
 * Check if exists the class 'mwm_notification'.
 *
 * @since 1.0.0
 */
if (!class_exists('mwm_notification')) {
    /**
     * Implements the mwm_notification class.
     * 
     * This is the class that controls the entire plugin.
     *
     * @since 1.0.0
     */
    class mwm_notification
    {
        /**
         * Variable
         * 
         * Notification code
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $code = '';

        /**
         * Variable
         * 
         * Notification name
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $name = '';

        /**
         * Variable
         * 
         * Notification message
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $message = '';

        /**
         * Variable
         * 
         * Notification url
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $url = '';

        /**
         * Variable
         * 
         * Notification type
         * - 0: success
         * - 1: info
         * - 2: warning
         * - 3: danger
         *
         * @since 1.0.0
         * 
         * @return int
         */
        protected $type = 0;

        /**
         * Variable
         * 
         * Notification priority
         * - 0: Low priority
         * - 0...10: Middle priority
         * - 10: High priority
         *
         * @since 1.0.0
         * 
         * @return int
         */
        protected $priority = 0;

        /**
         * Variable
         * 
         * Notification position
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $position = '';

        /**
         * Variable
         * 
         * Notification removable
         *
         * @since 1.0.0
         * 
         * @return boolean
         */
        protected $removable = true;

        /**
         * Constructor
         *
         * Initialice plugin and registers actions and filters to be used.
         *
         * @since 1.0.0
         * 
         * @return \mwm_notification
         */
        public function __construct($slug, $name, $message, $url, $type, $priority, $position, $removable)
        {
            // Initialization of all information
            if (is_string($slug) && is_string($name)) $this->code = $slug.'__'.slugify($name);
            if (is_string($name)) $this->name = $name;
            if (is_string($message)) $this->message = $message;
            if (is_string($url)) $this->url = $url;
            if (is_int($type)) $this->type = $type;
            if (is_int($priority)) $this->priority = $priority;
            if (is_string($position)) $this->position = $position;
            if (is_bool($removable)) $this->removable = $removable;

            if ($slug != MWM_FRA_SLUG) {
                $plugin = mwm_dashboard()->get_plugins($slug);
                if ($plugin) {
                    $plugin->add_notification($this);
                }
            }
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
                $object->code = $this->code;
                $object->name = $this->name;
                $object->message = $this->message;
                $object->url = $this->url;
                $object->type = $this->type;
                $object->priority = $this->priority;
                $object->position = $this->position;
                $object->removable = $this->removable;
            }
            
            return $object;
        }
    }
}