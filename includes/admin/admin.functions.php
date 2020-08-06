<?php 

/**
 * Detects if the plugin has been entered directly.
 *
 * @since 2.0.2
 * @author victorSTM
 */
if (!defined('ABSPATH') || !defined('MWM_RRSS_VERSION')) {
    exit; // Exit if accessed directly.
}

/**
 * Get Sidebar admin contents
 *
 * @since 2.0.2
 * @author pedroMCJ95
 */
function mwm_endpoint_get_sidebar_content( $lang = '' ) {

    $return = array();
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.mowomo.com/wp-json/mowomo_plugins/v1/anuncios/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    
    $response = json_decode( curl_exec($curl) );
    curl_close($curl);

    if ( is_array( $response ) ) {
        $return = $response;

        if ( $lang ) {

            $aux_return = $return;
            $return = array();

            foreach ( $aux_return as $post ) {
                if ( mb_substr( $post->post_title, 0, 4 ) == '['.$lang.']' ) {
                    array_push( $return, $post );
                }
            }
        }
    }

    return $return;
}
