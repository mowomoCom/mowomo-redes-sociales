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
if (!defined('ABSPATH') || !defined('MWM_RRSS_VERSION'))
{
    exit; // Exit if accessed directly.
}

// Load all includes
require_once MWM_FRA_INC.'admin/class.mwm-dashboard.php';
require_once MWM_FRA_INC.'schema/class.mwm-plugin.php';
require_once MWM_FRA_INC.'schema/class.mwm-notification.php';
require_once MWM_FRA_INC.'schema/class.mwm-feed.php';