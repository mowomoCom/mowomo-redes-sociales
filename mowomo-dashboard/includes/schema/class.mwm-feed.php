<?php 

if (!class_exists('mwm_feed')) {
    /**
     * Implements the mwm_feed class.
     *
     * @since 1.0.0
     */
    class mwm_feed
    {
        /**
         * Variable
         * 
         * Plugin code
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $code = '';

        /**
         * Variable
         * 
         * Plugin url_json
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $url_json = '';

        /**
         * Variable
         * 
         * Plugin json
         *
         * @since 1.0.0
         * 
         * @return string
         */
        protected $json = '';

        /**
         * Variable
         * 
         * Plugin priority
         *
         * @since 1.0.0
         * 
         * @return int
         */
        protected $priority = 0;

        /**
         * Variable
         * 
         * Plugin position
         *
         * @since 1.0.0
         * 
         * @return int
         */
        protected $position = 0;

        /**
         * Variable
         * 
         * Plugin loaded
         *
         * @since 1.0.0
         * 
         * @return bool
         */
        protected $loaded = false;

        /**
         * Constructor
         *
         * Initialice plugin and registers actions and filters to be used.
         *
         * @since 1.0.0
         * 
         * @return \mwm_plugin
         */
        public function __construct(string $code, string $url_json, string $json, int $priority, int $position, bool $loaded)
        {
            // Initialization of all information
            if (is_string($code)) $this->code = $code;
            if (is_string($url_json)) $this->url_json = $url_json;
            if (is_string($json)) $this->json = $json;
            if (is_int($priority)) $this->priority = $priority;
            if (is_int($position)) $this->position = $position;
            if (is_bool($loaded)) $this->loaded = $loaded;
        }
        
        /**
         * Function
         *
         * Función que devuelve los atributos de un objeto según el tipo de 
         * parámetro introducido. Se recomienda fijarse del método get_info
         * (mixed properties initialized to string).
         *
         * @since 1.0.0
         * 
         * @return array
         */
        public function get_info($properties = '')
        {
            $object = new stdClass();
            if (is_array($properties)) {
                if (sizeof($properties) > 0) {
                    foreach ($properties as $key => $property) {
                        if (property_exists($this, $property)) {
                            $object->$property = $this->$property;
                        }
                    }
                } else {
                    $object = false;
                }
            } else if (is_string($properties) && strlen($properties) > 0 ) {
                if (property_exists($this, $properties)) {
                    $object = $this->$properties;
                } else {
                    $object = false;
                }
            } else if(equals($properties, '')){
                $object->code = $this->code;
                $object->url_json = $this->url_json;
                $object->json = $this->json;
                $object->priority = $this->priority;
                $object->position = $this->position;
                $object->loaded = $this->loaded;
            }
            return $object;
        }
    }
}

?>