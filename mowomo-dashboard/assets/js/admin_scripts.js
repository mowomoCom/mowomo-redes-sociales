/**
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt.
 */

jQuery(document).ready(function() {
    first_load();

    /**
     * Detects when the user click on any tab
     *
     * @since      1.0.0
     */
    jQuery(".nav-tab").on("click", function() {
        var tab = jQuery(this).attr("mwm-tab");
        var page_slug = jQuery("#mwm-admin-form").attr("mwm-page-slug");
        var end_of_href = "#tab=" + tab;
        var newHref =
            jQuery(location)
                .attr("href")
                .replace(jQuery(location).attr("hash"), "") + end_of_href;
        jQuery(".nav-tab.nav-tab-active").removeClass("nav-tab-active");
        jQuery(this).addClass("nav-tab-active");
        jQuery(".mwm-tab").addClass("hidden");
        jQuery("#tab-" + tab).removeClass("hidden");
        // jQuery("#mwm-admin-form").attr("action", "/options.php" + end_of_href);

        window.history.pushState(tab, document.title, newHref);
    });

    /**
     * Detects when user change the url with the navigator buttons
     *
     * @since      1.0.0
     */
    jQuery(window).on("hashchange", function() {
        var actual_hash = jQuery(location)
            .attr("hash")
            .replace("#tab=", "");
        if (actual_hash.length == 0) {
            actual_hash = jQuery(".nav-tab")
                .eq(0)
                .attr("mwm-tab");
        }

        change_tabs(actual_hash);
    });

    /**
     * Dinamic toggle buttons
     *
     * @since      1.0.0
     */
    jQuery("label.mwm-toggle").on("click", function() {
        if (
            jQuery(this)
                .prev()
                .prop("checked")
        ) {
            jQuery(this)
                .prev()
                .prop("checked", false);
        } else {
            jQuery(this)
                .prev()
                .prop("checked", true);
        }
    });

    /**
     * Dinamic radio option boxes
     *
     * @since      1.0.0
     */
    jQuery(".mwm-option-boxes .mwm-option-box").on("click", function() {
        jQuery(this)
            .find("input")
            .prop("checked", true);
        jQuery(this)
            .closest(".mwm-option-boxes")
            .find(".mwm-option-box")
            .removeClass("active");
        jQuery(this).addClass("active");
    });
    jQuery(".mwm-option-boxes .mwm-option-box").on("click", function() {
        jQuery(this)
            .find("input")
            .prop("checked", true);
    });
    jQuery("select[name='mowomo-redes-sociales-alignment']").on(
        "change",
        function() {
            jQuery(".mwm-option-boxes .mwm-option-box .mwm_rrss_contenedor")
                .removeClass("mwm_rrss_alingment_1")
                .removeClass("mwm_rrss_alingment_2")
                .removeClass("mwm_rrss_alingment_3");
            jQuery(
                ".mwm-option-boxes .mwm-option-box .mwm_rrss_contenedor"
            ).addClass("mwm_rrss_alingment_" + jQuery(this).val());
        }
    );

    /**
     * Copy to clipboard
     *
     * @since      1.0.0
     */
    jQuery(".input-group button").on("click", function() {
        jQuery(this)
            .closest(".input-group")
            .find("input")
            .select();
        document.execCommand("copy");
    });
});

/**
 * First load of the admin page
 *
 * @since      1.0.0
 *
 * @return string
 */
function first_load() {
    var actual_hash = jQuery(location)
        .attr("hash")
        .replace("#tab=", "");

    if (actual_hash.length == 0) {
        actual_hash = jQuery(".nav-tab")
            .eq(0)
            .attr("mwm-tab");
    }

    change_tabs(actual_hash);
}

/**
 * Function that changes the visibility of tabs according to the current hash
 *
 * @since      1.0.0
 *
 * @return string
 */
function change_tabs(actual_hash) {
    jQuery(".nav-tab.nav-tab-active").removeClass("nav-tab-active");
    jQuery(".nav-tab[mwm-tab='" + actual_hash + "']").addClass(
        "nav-tab-active"
    );
    jQuery(".mwm-tab").addClass("hidden");
    jQuery("#tab-" + actual_hash).removeClass("hidden");
}
