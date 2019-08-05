/**
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt.
 */

jQuery(document).on("ready", function() {
    jQuery(".mwm_rrss").on("click", function() {
        // Get data
        var url = jQuery(this).attr("mwm-rrss-url");

        // Open window
        window.open(
            url,
            "_blanck",
            "toolbar=yes, top=500, left=500, width=400, height=400"
        );
    });
});
