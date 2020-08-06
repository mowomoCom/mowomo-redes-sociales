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
 * @since 1.0.0
 */
if (!defined('ABSPATH') || !defined('MWM_RRSS_VERSION')) {
    exit; // Exit if accessed directly.
}

mwm_title('Position of buttons');
mwm_table();
    mwm_select(
        MWM_RRSS_SLUG.'-posicion',
        'Position of buttons',
        get_option(MWM_RRSS_SLUG.'-posicion'),
        array(
            '0' => 'Don\'t show',
            '1' => 'Before the post',
            '2' => 'After the post',
            '3' => 'Before and after the post'
        ),
        'Choose where you want to make the social buttons appear'
    );
mwm_endtable(); 