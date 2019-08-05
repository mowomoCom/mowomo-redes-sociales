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
if (!defined('ABSPATH') || !defined('MWM_VERSION')) {
    exit; // Exit if accessed directly.
}

/**
 * Custom get template part.
 * 
 * Function that adds template parts of the plugin includes folder.
 *
 * @since 1.3.0
 * 
 * @return string/false
 */
function mwm_rrss_get_template_part($slug, $name = null)
{
    // Do stuff here if you need it.
    do_action("mwm_rrss_get_template_part_{$slug}", $slug, $name);

    // Vars
    $templates = array();
    $located = ''; 

    // Prepare the template
    if (isset($name)) :
        $templates[] = "{$slug}-{$name}.php";
    endif;

    $templates[] = "{$slug}.php";

    // Locate the template
    foreach ( (array) $templates as $template ) :
        if ( !$template ) :
            continue; 
        endif;

        if ( file_exists(MWM_TPL . $template)) :
            $located = MWM_TPL . $template; 
            break; 
        endif;
    endforeach;

    // Load the template
    if ( '' != $located ) :
        load_template($located);
    endif;

    // Return the template
    return $located;
}

/**
 * Simple Templating function
 *
 * @param $slug   - Slug of the file.
 * @param $name   - Name of the file.
 * @return string - Output of the template file. Likely HTML.
 */
function mwm_template( $slug, $name, $args = null ){
    // Make the file
    $file = MWM_TPL.$slug.'-'.$name.'.php';

    // Ensure the file exists
    if ( !file_exists( $file ) ) {
        return '';
    }

    // Make values in the associative array easier to access by extracting them
    if ( is_array( $args ) ){
        extract( $args );
    }
  
    // Buffer the output (including the file is "output")
    ob_start();
        load_template($file);
    return ob_get_clean();
}

/**
 * Return the post url
 *
 * @since      1.0.0
 *
 * @return string
*/
function mwm_rrss_get_post_url()
{
    global $post;

    $post_url = get_permalink( $post );

    return apply_filters( 'mwm_rrss_get_post_url', $post_url, $post->ID );
}