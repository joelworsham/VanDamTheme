/**
 * Controls the crazy, quirky nav fly-outs on the page.
 *
 * @since VanDam 0.1
 */
var VD_Nav;
(function ($) {
    VD_Nav = {
        /**
         * Initializes the object.
         *
         * @since VanDam 0.1
         */
        init: function () {
            this.flyouts();
            this.offcanvas_toggle();
            this.submenu_toggle();
            this.submenu_init();
        },
        /**
         * Initializes the menu flyout capabilities.
         *
         * @since VanDam 0.1
         */
        flyouts: function () {

            $('#site-nav').find('.menu-item-has-children').click(function () {
                var e = $(this),
                    child_ID = e.attr('id').match(/\d+/),
                    e_content = $('#site-content'),
                    e_menu = $('.sub-menu-' + child_ID ),
                    open = e_content.hasClass('move-right') ? true : false,
                    active = e.hasClass('active') ? true : false;

                // Deal with setting this menu item to active

                // Remove all other active classes first
                $('#site-nav').find('.menu-item').removeClass('active');

                // If it's already active, close it and bail
                if (active) {
                    e_content.removeClass('move-right');
                    e.removeClass('active');

                    return;
                }

                // If we've made it this far, make it active
                e.addClass('active');

                // Deal with sliding the content over

                // Move content back left first
                e_content.removeClass('move-right');

                // Add it back after animation has completed, unless it's not yet moved right,
                // then just do it immediately
                if (open) {
                    window.vd_nav = setTimeout(function () {
                        e_content.addClass('move-right');

                        // Deal with setting the fly-out menu to active
                        $('.flyout.active').removeClass('active');
                        e_menu.addClass('active');

                    }, 500); // The timeout should match the transition for $menu-slide in SCSS settings
                } else {
                    e_content.addClass('move-right');

                    // Deal with setting the fly-out menu to active
                    $('.flyout.active').removeClass('active');

                    e_menu.addClass('active');
                }
            });
        },

        /**
         * Moves the entire screen back and forth.
         *
         * @since VanDam 0.1
         */
        offcanvas_toggle: function () {
            var e_toggle = $('[class^="left-off-canvas-toggle-full"]'),
                e_wrapper = $('#wrapper');

            // When clicking the hamburgers
            e_toggle.click(function () {

                clearTimeout(window.vd_nav);

                // Move the content right
                e_wrapper.toggleClass('move-right');

                // Get rid of all of the active classes of the nav menus
                $('.flyout.active').removeClass('active');
                $('#site-nav').find('.sub-menu.active').removeClass('active');
                $('#site-content').removeClass('move-right');

                return false;
            });
        },

        /**
         * Toggles the sub-menus under each menu-icon when mobile.
         *
         * @since VanDam 0.1
         */
        submenu_toggle: function () {
            $('#site-nav').find('.menu-item-has-children > a').click(function () {
                $(this).closest('.menu-item-has-children').find('.sub-menu').toggleClass('active');
            });
        },

        /**
         * Initializes open submenus.
         *
         * @since VanDam 0.1.0
         */
        submenu_init: function () {
            $('#site-nav').find('.menu > .menu-item').each(function () {
                if ($(this).hasClass('current-menu-parent')) {
                    $(this).find('.sub-menu').addClass('active');
                }
            });
        }
    };

    // Launch on doc.ready
    $(function () {
        VD_Nav.init();
    });
})(jQuery);