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

// Args

// Structure
mwm_title('Diseño de los botones');
mwm_table();
    mwm_select(
        MWM_RRSS_SLUG.'-appearance',
        'Aspecto',
        get_option(MWM_RRSS_SLUG.'-appearance'),
        array(
            '0' => 'Metro',
            '1' => 'Material blanco y negro',
            '2' => 'Material a color'
        )
    );
    mwm_select(
        MWM_RRSS_SLUG.'-border-type',
        'Tipo de borde',
        get_option(MWM_RRSS_SLUG.'-border-type'),
        array(
            '0' => 'Cuadrado',
            '1' => 'Ligeramente bordeado',
            '2' => 'Completamente bordeado'
        )
    );
    mwm_select(
        MWM_RRSS_SLUG.'-size',
        'Tamaño',
        get_option(MWM_RRSS_SLUG.'-size'),
        array(
            '0' => 'Estático',
            '1' => 'Responsive',
        )
    );
    mwm_select(
        MWM_RRSS_SLUG.'-alignment',
        'Alineamiento',
        get_option(MWM_RRSS_SLUG.'-alignment'),
        array(
            '0' => 'Al principio',
            '1' => 'Al centro',
            '2' => 'Al final'
        )
    );
    // mwm_select(
    //     MWM_RRSS_SLUG.'-orientation',
    //     'Orientación',
    //     get_option(MWM_RRSS_SLUG.'-orientation'),
    //     array(
    //         '0' => 'Horizontal',
    //         '1' => 'A la izquierda',
    //         '2' => 'A la derecha',
    //     )
    // );
mwm_endtable(); 