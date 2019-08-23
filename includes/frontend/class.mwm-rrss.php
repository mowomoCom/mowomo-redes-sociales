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
         * @var \mwm_rrss_shortcodes
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

            // Showing social content
            add_filter('the_content', array($this, 'before_after'));

            // Adding metadata
            add_action('wp_head', array($this, 'metadata'));
        }

        /**
         * Enqueue scripts and styles.
         *
         * @since 1.3.0
         *
         * @return void
         */
        public function enqueue_scripts()
        {
            // Enqueuing scripts
            wp_register_script('mwm_rrss_scripts', MWM_RRSS_ASS.'js/scripts.js', array('jquery'), '1.0.0', true);
            wp_register_style('mwm_rrss_styles', MWM_RRSS_ASS.'css/styles.min.css', array());
            wp_enqueue_script('mwm_rrss_scripts');
            wp_enqueue_style('mwm_rrss_styles');

            // Adding info to scripts
            wp_localize_script( 'mwm_rrss_scripts', 'mwm_rrss_data', array(
                'ajax_url' => admin_url( 'admin-ajax.php' )
            ));
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
            if(is_single() && get_post_type() =='post') :
                $contenido = $this->get_content();
                $posicion = get_option(MWM_RRSS_SLUG.'-posicion');
                switch ($posicion) :
                    case '':
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
        }

        /**
         * Show the contents of the social media icon bar.
         *
         * @since 1.3.1
         *
         * @author Paco Marchante
         *
         * @return string
         */
        public function get_content()
        {
            $redes_sociales_activas   = get_option(MWM_RRSS_SLUG.'-actives');
            $appaerance = get_option(MWM_RRSS_SLUG.'-appearance');
            switch(get_option(MWM_RRSS_SLUG.'-border-type')) {
                case '0' :  $border_type = 'border-square';
                    break;
                case '1' :  $border_type = 'border-rounded';
                    break;
                case '2' :  $border_type = 'border-rounded-full';
                    break;
                default: $border_type = 'border-square';
            }
            switch(get_option(MWM_RRSS_SLUG.'-size')) {
                case '0' :  $size = 'size-static';
                    break;
                case '1' :  $size = 'size-responsive';
                    break;
                default: $size = 'size-static';
            }
            switch(get_option(MWM_RRSS_SLUG.'-alignment')) {
                case '0' :  $alignment = 'alignment-start';
                    break;
                case '1' :  $alignment = 'alignment-center';
                    break;
                case '2' :  $alignment = 'alignment-end';
                    break;
                default: $alignment = 'alignment-start';
            }
            $contenido = '<div class="mwm_rrss_contenedor '.$border_type.' '.$size.' '.$alignment.' '.$appaerance.'">';

            if (is_array($redes_sociales_activas) || is_object($redes_sociales_activas)) {
              foreach ($redes_sociales_activas as $red_social_activa) {
                $contenido .= $this->get_rrss_link($red_social_activa, $appaerance);
              }
            } else {
              $contenido .= $red_social_activas;
            }
            $contenido .= '</div>';

            return $contenido;
        }

        /**
         * Show the required social media button.
         *
         * @since 1.3.1
         *
         * @author Paco Marchante
         *
         * @return string
         */
        public function get_rrss_link($red_social_activa, $appaerance)
        {
            switch ($red_social_activa) :
                case 'twitter':
                    return '<a class="mwm_rrss mwm_twitter" mwm-rrss-url="https://twitter.com/intent/tweet?text='.get_the_title().' '.get_permalink().' vía @'.get_option(MWM_RRSS_SLUG.'-twitter').'"><span>'.esc_html(__( "Twitter", MWM_RRSS_SLUG )).'</span></a>';
                    break;
                case 'facebook':
                    return '<a class="mwm_rrss mwm_facebook" mwm-rrss-url="https://www.facebook.com/sharer/sharer.php?u='. get_permalink().'"><span>'.esc_html(__( "Facebook", "mwm-redes-sociales" )).'</span></a>';
                    break;
                case 'pinterest':
                    return '<a class="mwm_rrss mwm_pinterest" mwm-rrss-url="http://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='.get_the_post_thumbnail_url().'&description='.get_the_title().'"><span>'.esc_html(__( "Pinterest", MWM_RRSS_SLUG )).'</span></a>';
                    break;
                case 'whatsapp':
                    return '<a class="mwm_rrss mwm_whatsapp" href="whatsapp://send?text='. get_the_title() .' – '.get_permalink().'" data-action="share/whatsapp/share"><span>'.esc_html(__("WhatsApp", MWM_RRSS_SLUG)).'</span></a>';
                    break;
                case 'linkedin':
                    return '<a class="mwm_rrss mwm_linkedin" mwm-rrss-url="https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . get_the_title() . '&source=' . get_the_post_thumbnail_url().'"><span>'.esc_html(__("Linkedin", MWM_RRSS_SLUG)).'</span></a>';
                    break;
                default:
                    return '';
                    break;
            endswitch;
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

            // Twitter specific
            echo '<meta name="twitter:card" 		content="summary_large_image" />';

            // Meta tags for Open Graph
            echo '<meta property="og:description" 	content="' . esc_attr( $this->get_descripcion_post() ) . '" />';
            echo '<meta property="og:type"			content="article" />';
            echo '<meta property="og:image" 		content="' . esc_attr( $this->get_imagen_destacada_post() ) . '" />';

            // Do stuff if need it
            do_action( 'mwm_rrss_metadata' );
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
