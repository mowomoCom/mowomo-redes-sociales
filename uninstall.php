<?php 
/**
 * mowomo-redessociales
 *
 *  Elimina el contenido creado en la base de datos
 * 
 * @since      1.0.0
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
//Eliminar cuenta de Twitter
delete_option('mwm_rrss_twitter');
//Eliminar posición de los botones
delete_option('mwm_rrss_posicion');
//Eliminar botones que se muestran
delete_option('mwm_rrss_show_tw');
delete_option('mwm_rrss_show_fb');
delete_option('mwm_rrss_show_pt');
delete_option('mwm_rrss_show_gp');

