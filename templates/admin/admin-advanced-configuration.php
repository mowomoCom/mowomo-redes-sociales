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

mwm_title('Position of buttons');
mwm_table();

    mwm_input_text(
        'mwm_rrss_twitter',
        'Usuario de Twitter',
        get_option('mwm_rrss_twitter'),
        'Introducir el usuario sin @. E.j: mowomocom'
    );

mwm_endtable();