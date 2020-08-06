<?php 
/**
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt.
 */

/**
 * Elimina el contenido creado en la base de datos
 * 
 * @since 1.0.0
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

if (!defined('MWM_RRSS_SLUG')) {
    define('MWM_RRSS_SLUG', 'mowomo-redes-sociales');
}

delete_option( MWM_RRSS_SLUG.'-init');
delete_option( MWM_RRSS_SLUG.'-actives');
delete_option( MWM_RRSS_SLUG.'-posicion');
delete_option( MWM_RRSS_SLUG.'-twitter');
delete_option( MWM_RRSS_SLUG.'-appearance');
delete_option( MWM_RRSS_SLUG.'-border-type');
delete_option( MWM_RRSS_SLUG.'-size');
delete_option( MWM_RRSS_SLUG.'-alignment');
delete_option( MWM_RRSS_SLUG.'-orientation');
