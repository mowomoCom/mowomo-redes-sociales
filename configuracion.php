<?php

/**
 * mowomo-redessociales
 *
 * @since      1.0.0
 */
add_action( 'admin_init', 'mwm_rrss_init' );
function mwm_rrss_init() {

    register_setting( 'mwm_rrss_option', 'mwm_rrss_actives' );

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
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="twitter" <?php if(in_array('twitter',get_option('mwm_rrss_actives'))){echo "checked";} ?>>Twitter</td>
                    </tr>
                    <tr>
                        <th>Facebook</th>
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="facebook" <?php if(in_array('facebook',get_option('mwm_rrss_actives'))){echo "checked";} ?>>Facebook</td>
                    </tr>
                    <tr>
                        <th>Pinterest</th>
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="pinterest" <?php if(in_array('pinterest',get_option('mwm_rrss_actives'))){echo "checked";} ?>>Pinterest</td>
                    </tr>
                    <tr>
                        <th>Google+</th>
                        <td><input type="checkbox" name="mwm_rrss_actives[]" value="googleplus" <?php if(in_array('googleplus',get_option('mwm_rrss_actives'))){echo "checked";} ?>>Google+</td>
                    </tr>
                </tbody>
            <table>
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
