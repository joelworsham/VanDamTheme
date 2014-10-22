var VD;
(function ($) {
    VD = {
        init: function () {
            // Apply foundation do the page
            $(document).foundation();

            //this.smooth_scroll();
            this.mobile_icons_size();
            this.mobile_icons_position();

            $(window).resize(function () {

                // Only on mobile!
                if ($(window).width() <= 750) {
                    VD.mobile_icons_size();
                    VD.mobile_icons_position();
                }
            });
        },
        /**
         * Performs a smooth page scroll to an anchor on the same page.
         *
         * @since VanDam 0.1.0
         *
         * @author Chris Coyer
         */
        smooth_scroll: function () {
            var hashTagActive = "";
            $('a[href*=#]:not([href=#])').click(function (event) {
                event.preventDefault();
                if (hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
                    //calculate destination place
                    var dest = 0;
                    if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
                        dest = $(document).height() - $(window).height();
                    } else {
                        dest = $(this.hash).offset().top;
                    }
                    //go to destination
                    $('html,body').animate({
                        scrollTop: dest
                    }, 1000);
                    hashTagActive = this.hash;
                }
            });
        },
        /**
         * Sets the size of the icons on the mobile homepage to be square.
         *
         * @since VanDam 0.1.0
         */
        mobile_icons_size: function () {

            var e_container = e_container = $('#home-action-mobile'),
                e_icons = e_container.find('.color-fill'),
                width = e_icons.width();

            e_icons.height(width);
        },
        /**
         * Moves the mobile icons to the bottom of the screen.
         *
         * @since VanDam 0.1.0
         */
        mobile_icons_position: function () {

            var e_adminbar = $('#wpadminbar'),
                e_container = e_container = $('#home-action-mobile'),
                e_iconcontainer = e_container.find('.home-icons'),
                screen_height = $(window).innerHeight(),
                adminbar_height = e_adminbar.length ? e_adminbar.outerHeight(true) : 0,
                logo_height = $('#site-logo-mobile').outerHeight(true),
                action_height = e_container.outerHeight(true) - parseInt(e_iconcontainer.css('margin-top')),
                mobileheader_height = $('#mobile-header').outerHeight(true),
                padding = 5,
                offset = screen_height - adminbar_height - mobileheader_height - logo_height - action_height - padding;

            e_iconcontainer.css('margin-top', offset);
        }
    };

    // Initialize on doc.ready
    $(function () {
        VD.init();
    });
})(jQuery);