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
 * Check if exists the class 'mwm_rrss'.
 *
 * @since 1.3.0
 */
if (!class_exists('mwm_rrss')) {
    /**
     * Implements the mwm_rrss class.
     * 
     * This is the class that controls the entire plugin.
     *
     * @since 1.3.0
     */
    class mwm_rrss
    {
        /**
         * Single instance of the class.
         *
         * @var \mwm_rrss
         *
         * @since 1.3.0
         */
        protected static $instance;

        /**
         * Plugin shortcodes.
         *
         * @var array
         *
         * @since 1.3.0
         */
        public $shortcodes;

        /**
         * Returns single instance of the class.
         *
         * @since 1.3.0
         * 
         * @return \mwm_rrss
         */
        public static function get_instance()
        {
            if (is_null(self::$instance)) :
                self::$instance = new self();
            endif;

            return self::$instance;
        }

        /**
         * Constructor.
         *
         * Initialice plugin and registers actions and filters to be used.
         *
         * @since 1.3.0
         * 
         * @return \mwm_rrss
         */
        public function __construct()
        {
            // Adding shortcodes
            $this->shortcodes = new mwm_rrss_shortcodes();

            // Showing the admin tab
            if (is_admin()) :
                mwm_rrss_admin();
            endif;

            // Adding scripts
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

            // Add scripts al footer
            add_action( 'wp_footer', array( $this, 'enqueue_scripts_in_footer' ), 999 );

            // Showing social content
            add_filter('the_content', array($this, 'before_after'));

            // Adding metadata
            add_action('wp_head', array($this, 'metadata'));

            
        }

        /**
         * Enqueue scripts.
         *
         * @since 2.0.2
         * 
         * @return void
         */
        public function enqueue_scripts()
        {
            // Enqueuing scripts
            wp_register_style('mwm_rrss_styles', MWM_RRSS_ASS.'css/styles.min.css', array(), MWM_RRSS_VERSION);
            wp_enqueue_style('mwm_rrss_styles');
        }

        /**
         * Enqueue critical scripts.
         *
         * @since 2.0.2
         * 
         * @return void
         */
        public function enqueue_scripts_in_footer()
        {
            ob_start();
            ?>
                <script>
                jQuery(document).on("ready", function() {
                    jQuery(".mwm_rrss").on("click", function() {
                        // Get data
                        var url = jQuery(this).attr("mwm-rrss-url");

                        // Open window
                        window.open(
                            url,
                            "_blank",
                            "toolbar=yes, top=500, left=500, width=400, height=400"
                        );
                    });
                });
                </script>
            <?php
            $result = ob_get_clean();
            echo $result;
        }

        /**
         * Show the social media icon bar.
         *
         * @since 1.3.0
         * 
         * @return string
         */
        public function before_after($content)
        {
            if(is_single()) :
                if (strcmp(get_post_type(), 'post') == 0) :
                    $contenido = $this->get_content();
                    $posicion = get_option(MWM_RRSS_SLUG.'-posicion', '0');
                    switch ($posicion) :
                        case '0':
                            $fullcontent = $content;
                            break;
                        case '1':
                            $fullcontent = $contenido . $content;
                            break;
                        case '2':
                            $fullcontent = $content . $contenido;
                            break;
                        case '3':
                            $fullcontent = $contenido . $content . $contenido;
                            break;
                    endswitch;
                    return $fullcontent;
                else :
                    return $content;
                endif;
            else :
                return $content;
            endif; 
        }

        /**
         * Show the contents of the social media icon bar.
         *
         * @since 1.3.0
         * 
         * @return string
         */
        public function get_content()
        {
            $actives = get_option(MWM_RRSS_SLUG.'-actives', array('twitter', 'facebook', 'pinterest', 'linkedin', 'whatsapp'));
            if (sizeof($actives) == 0) {
                $actives = array('twitter', 'facebook', 'pinterest', 'linkedin', 'whatsapp');
            }
            if (!($appearance = get_option(MWM_RRSS_SLUG.'-appearance'))) {
                $appearance = '1';
            }
            if (!($alignment = get_option(MWM_RRSS_SLUG.'-alignment'))) {
                $alignment = '1';
            }

            $contenido = '<div class="mwm_rrss_contenedor mwm_rrss_appearance_'.$appearance.' mwm_rrss_alingment_'.$alignment.'">';

            // echop($actives);

            foreach ($actives as $active) {
                $contenido .= $this->get_rrss_link($active, $appearance);
            }

            $contenido .= '</div>';
        
            return $contenido;
        }

        /**
         * Show the required social media button.
         *
         * @since 1.3.0
         * 
         * @return string
         */
        public function get_rrss_link($active, $appearance)
        {
            switch($active) {
                case 'twitter':
                    return '<a class="mwm_rrss mwm_twitter" mwm-rrss-url="'.(!is_admin() ? 'https://twitter.com/intent/tweet?text='.get_the_title().' '.get_permalink().' vía @'.get_option(MWM_RRSS_SLUG.'-twitter') : '').'"><i class="icon-rrss-twitter"></i>'.((strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "Twitter", 'mowomo-redes-sociales' ) : '').' </a>';
                    break;
                case 'facebook':
                    return '<a class="mwm_rrss mwm_facebook" mwm-rrss-url="'.(!is_admin() ? 'https://www.facebook.com/sharer/sharer.php?u='. get_permalink() : '').'"><i class="icon-rrss-facebook"></i>'.((strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "Facebook", "mowomo-redes-sociales" ) : '').' </a>';
                    break;
                case 'pinterest':
                    return '<a class="mwm_rrss mwm_pinterest" mwm-rrss-url="'.(!is_admin() ? 'http://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='.get_the_post_thumbnail_url().'&description='.get_the_title() : '').'"><i class="icon-rrss-pinterest"></i>'.((strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "Pinterest", 'mowomo-redes-sociales' ) : '').' </a>';
                    break;
                case 'linkedin':
                    return '<a class="mwm_rrss mwm_linkedin" mwm-rrss-url="'.(!is_admin() ? 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . get_the_title() . '&source=' . get_the_post_thumbnail_url() : '').'"><i class="icon-rrss-linkedin"></i>'.((strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "Linkedin", 'mowomo-redes-sociales' ) : '').' </a>';
                    break;
                case 'whatsapp':
                    return '<a class="mwm_rrss mwm_whatsapp" mwm-rrss-url="'.(!is_admin() ? 'https://api.whatsapp.com/send?text='. get_the_title() .' – '.get_permalink() : '').'" data-action="share/whatsapp/share"><i class="icon-rrss-whatsapp"></i>'.((strcmp($appearance, '1') == 0 || strcmp($appearance, '2') == 0 || strcmp($appearance, '3') == 0 || strcmp($appearance, '4') == 0) ? __( "WhatsApp", 'mowomo-redes-sociales' ) : '').' </a>';
                    break;
                default:
                    return '';
                    break;
            }
        }

        /**
         * Metadata for social networks
         *
         * @since      1.3.0
         * 
         * @return string
         */
        public function metadata()
        {
            global $post;

            if (is_object($post)) {
                // Twitter specific
                echo '<meta name="twitter:card" 		content="summary_large_image" />';

                // Meta tags for Open Graph
                echo '<meta property="og:description" 	content="' . esc_attr( $this->get_descripcion_post() ) . '" />';
                echo '<meta property="og:type"			content="article" />';
                echo '<meta property="og:image" 		content="' . esc_attr( $this->get_imagen_destacada_post() ) . '" />';

                // Do stuff if need it
                do_action( 'mwm_rrss_metadata' );
            }
        }

        /**
         * Returns the description of the current post.
         *
         * @since 1.0.0
         *
         * @return string
        */
        function get_descripcion_post()
        {
            global $post;

            if( !empty( $post->post_excerpt ) )

                $post_description = $post->post_excerpt;

            elseif( !empty( $post->post_content ) ) {

                $post_description = strip_shortcodes( $post->post_content );
                $post_description = wp_trim_words( $post_description, apply_filters( 'dpsp_post_description_length', 15 ), '' );

            } else
                $post_description = '';

            return apply_filters( 'mwm_rrss_get_descripcion_post', $post_description, $post->ID );
        }

        /**
         * Returns the featured image of the current post
         *
         * @since      1.0.0
         *
         * @return string
        */
        function get_imagen_destacada_post()
        {
            global $post;

            $post_thumbnail_id 	 = get_post_thumbnail_id( $post->ID );

            $post_thumbnail_data = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );

            return apply_filters( 'mwm_rrss_get_imagen_destacada_post', $post_thumbnail_data[0], $post->ID );
        }
    }
}

/**
 * Unique access to instance of mwm_rrss class.
 * 
 * @since 1.3.0
 *
 * @return \mwm_rrss
 */
function mwm_rrss()
{
    return mwm_rrss::get_instance();
}
