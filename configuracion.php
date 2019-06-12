<?php

/**
 * mowomo-redessociales
 *
 * @since      1.0.0
 */
add_action( 'admin_init', 'mwm_rrss_init' );
function mwm_rrss_init() {


      register_setting( 'mwm_rrss_option', 'mwm_rrss_actives' );
      register_setting( 'mwm_rrss_option', 'mwm_rrss_posicion' );
      register_setting( 'mwm_rrss_option', 'mwm_rrss_twitter' );


}

/**
 * mowomo-redessociales
 *
 * @since      1.0.0
 *
 * Añade la página del plugin en el administrador de WordPress
 */
add_action('admin_menu', 'mwm_rrss_pagina');

function mwm_rrss_pagina(){
        add_menu_page( 'mowomo page', 'mowomo RRSS', 'manage_options', 'mwm-rrss', 'mwm_rrss_page', plugin_dir_url( __FILE__ ).'/assets/logo-mowomo-white.svg' );
}


/**
 * mowomo-redessociales
 *
 * @since      1.0.0
 */
function mwm_rrss_page(){
    $mwm_rrss_actives = get_option('mwm_rrss_actives');
    $twitter = $facebook = $linkedin = $pinterest = $whatsapp = false;
    if(!empty($mwm_rrss_actives)){
        if(in_array('twitter',$mwm_rrss_actives)){$twitter=true;}
        if(in_array('facebook',$mwm_rrss_actives)){$facebook=true;}
        if(in_array('linkedin',$mwm_rrss_actives)){$linkedin=true;}
        if(in_array('pinterest',$mwm_rrss_actives)){$pinterest=true;}
        if(in_array('whatsapp',$mwm_rrss_actives)){$whatsapp=true;}
    }
    ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php _e('mowomo Redes Sociales', 'mowomo-redes-sociales'); ?></h2>
        <form action="options.php" method="post">
            <?php settings_fields( 'mwm_rrss_option' ); ?>
            <?php @do_settings_fields( 'mwm-rrss' ,'mwm_rrss_option' ); ?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th><label><?php _e('Position of buttons', 'mowomo-redes-sociales'); ?></label></th>
                        <td>
                            <select name="mwm_rrss_posicion">
                                <?php $posicion = get_option('mwm_rrss_posicion'); ?>
                                <option value="0" <?php if( $posicion == '0' ) { echo "selected";} ?>><?php _e('Don\'t show','mowomo-redes-sociales'); ?></option>
                                <option value="1" <?php if ($posicion == '1' ) { echo "selected";} ?>><?php _e('Before the post', 'mowomo-redes-sociales'); ?></option>
                                <option value="2" <?php if ($posicion == '2' ) { echo "selected";} ?>><?php _e('After the post', 'mowomo-redes-sociales'); ?></option>
                                <option value="3" <?php if ($posicion == '3' ) { echo "selected";} ?>><?php _e('Before and after the post', 'mowomo-redes-sociales'); ?></option>
                            </select>
                            <p class="description"><?php _e('Choose where you want to make the social buttons appear', 'mowomo-redes-sociales'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for=""><?php _e('Twitter (no @)', 'mowomo-redes-sociales'); ?></label></th>
                        <td><input type="text" name="mwm_rrss_twitter" id="mwm_twitter" value="<?php echo get_option('mwm_rrss_twitter'); ?>"></td>
                    </tr>
                    <tr>
                        <th><h2><?php _e('Which buttons do you want to show?', 'mowomo-redes-sociales'); ?></h2></th>
                    </tr>
                    <tr>
                        <th>Twitter</th>
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="twitter" <?php if($twitter){echo "checked";} ?>>Twitter</td>
                    </tr>
                    <tr>
                        <th>Facebook</th>
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="facebook" <?php if($facebook){echo "checked";} ?>>Facebook</td>
                    </tr>
                    <tr>
                        <th>Pinterest</th>
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="pinterest" <?php if($pinterest){echo "checked";} ?>>Pinterest</td>
                    </tr>
                    <tr>
                        <th>Linkedin</th>
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="linkedin" <?php if($linkedin){echo "checked";} ?>>Linekdin</td>
                    </tr>
                    <tr>
                        <th>WhatsApp</th>
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="whatsapp" <?php if($whatsapp){echo "checked";} ?>>WhatsApp</td>
                    </tr>
                </tbody>
            <table>
            <p><?php _e('ShortCode for use wherever you want','mowomo-redes-sociales'); ?> -->  [rrss_buttons <?php if($twitter){echo 'twitter="on" ';}
                                                                            if($facebook){echo 'facebook="on" ';}
                                                                            if($pinterest){echo 'pinterest="on" ';}
                                                                            if($linkedin){echo 'linkdin="on" ';}
                                                                            if($whatsapp){echo 'whatsapp="on" ';} ?>]</p>
            <p><?php @submit_button(); ?></p>
        </form>
        <?php settings_errors(); ?>
    </div>
    <?php
}



/**
 * mowomo-redessociales
 *
 * @since      1.0.0
 *
 * Devuelve la descripción del post actual
 * @return string
 *
*/
function mwm_rrss_get_descripcion_post() {

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
 * mowomo-redessociales
 *
 * @since      1.0.0
 *
 * Devuelve la imagen destacada del post actual
 *
 * @return string
 *
*/
function mwm_rrss_get_imagen_destacada_post() {

    global $post;

    $post_thumbnail_id 	 = get_post_thumbnail_id( $post->ID );

    $post_thumbnail_data = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );

    return apply_filters( 'mwm_rrss_get_imagen_destacada_post', $post_thumbnail_data[0], $post->ID );

}

/**
 * mowomo-redessociales
 *
 * @since      1.0.0
 *
 * Devuelve la url del post
 *
 * @return string
 *
*/
function mwm_rrss_get_post_url() {

    global $post;

    $post_url = get_permalink( $post );

    return apply_filters( 'mwm_rrss_get_post_url', $post_url, $post->ID );

}

/**
 * mowomo-redessociales
 *
 * @since      1.0.0
 *
 * Reemplaza el footer de WordPress en la pagina de mowomo RRSS
 *
*/
function mwm_rrss_custom_admin_footer( $footer_text ) {

    if ( isset($_GET['page']) && $_GET['page'] == "mwm-rrss" ) { // Don't forget to add a check for your plugin's page here
        $footer_text = __( 'Thanks for using mowomo Redes Sociales, plugin made by <a href="https://mowomo.com" target="_blank" rel="nofollow">mowomo team</a>.' );
    }
    return $footer_text;
}
    add_filter( 'admin_footer_text', 'mwm_rrss_custom_admin_footer' );


    // Add Shortcode
function mwm_rrss_shortcode_buttons( $atts ) {

    	// Attributes
    	$atts = shortcode_atts(
    		array(
    			'twitter' => '',
    			'facebook' => '',
          'pinterest' => '',
          'linkdin' => '',
    			'whatsapp' => '',
    		),
    		$atts,
    		'rrss_buttons'
    	);
      $contenido = '<div class="mwm_rrss_contenedor">';
        if ($atts['twitter'] == "on"){
          $contenido .= '<span class="mwm_rrss mwm_twitter"><a onclick="compartirRrss(\'https://twitter.com/intent/tweet?text='. get_the_title() .' '. get_permalink() .' vía @'. get_option('mwm_rrss_twitter') .'\',\'_blank\');"><i class="icon-twitter"><img src="' . plugin_dir_url( __FILE__ ) .'assets/social-icons/twitter.svg"></i> '. esc_html( __( "Twitter", "mwm_rrss" ) ) .'</a></span>';
        }
        if ($atts['facebook'] == "on"){
          $contenido .= '<span class="mwm_rrss mwm_facebook"><a onclick="compartirRrss(\'https://www.facebook.com/sharer/sharer.php?u='. get_permalink() .'\',\'_blank\');"><i class="facebook-f"><img src="' . plugin_dir_url( __FILE__ ) .'assets/social-icons/facebook-f.svg"></i> '. esc_html( __( "Facebook", "mwm_rrss" ) ) .'</a></span>';
        }
        if ($atts['pinterest'] == "on"){
          $contenido .= '<span class="mwm_rrss mwm_pinterest"><a onclick="compartirRrss(\'http://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='.get_the_post_thumbnail_url().'&description='.get_the_title().'\',\'_blank\');"><i class="pinterest-p"><img src="' . plugin_dir_url( __FILE__ ) .'assets/social-icons/pinterest-p.svg"></i> '. esc_html( __( "Pinterest", "mwm_rrss" ) ) .'</a></span>';
        }
        if ($atts['linkdin'] == "on"){
          $contenido .= '<span class="mwm_rrss mwm_linkedin"><a onclick="compartirRrss(\'https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . get_the_title() . '&source=' . get_the_post_thumbnail_url() . '\',\'_blank\');"><img src="' . plugin_dir_url( __FILE__ ) .'assets/social-icons/linkedin-logo.svg"><span> '. esc_html( __( "Linkedin", "mwm_rrss" ) ) .'</span></a></span>';
        }
        if ($atts['whatsapp'] == "on"){
          $contenido .= '<span class="mwm_rrss mwm_whatsapp"><a href="whatsapp://send?text='. get_the_title() .' – '.get_permalink().'" data-action="share/whatsapp/share" ><i class="icon-whatsapp"><img src="' . plugin_dir_url( __FILE__ ) .'assets/social-icons/whatsapp.svg"></i> '. esc_html( __( "WhatsApp", "mwm_rrss" ) ) .'</a></span>';
        }
      $contenido .= '</div>';
    	// Return custom embed code
    	return $contenido;

}
add_shortcode( 'rrss_buttons', 'mwm_rrss_shortcode_buttons' );
