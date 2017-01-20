/*
 * The main script for the site.
 *
 * @since VanDam 0.1
 */
var VD;
(function ($) {

    var elements = {};

    VD = {

        init: function () {

            elements.home_action = $('#home-action');
            elements.wpadminbar = $('#wpadminbar');
            elements.mobile_home_action = $('#home-action-mobile');
            elements.mobile_home_action_icons = elements.mobile_home_action.find('.color-fill');
            elements.mobile_home_action_icon_container = elements.mobile_home_action.find('.home-icons');
            elements.arrow = $('.icon-arrow-down');
            elements.home_content = $('#home-content');
            elements.content_container = $('#site-content');
            elements.body_content = $('.body-content');

            // Apply foundation do the page
            $(document).foundation();

            elements.content_container.scroll(function () {
                VD.hide_arrow();
            });

            VD.smoothScroll();

            elements.content_container.scroll(VD.scroll);
        },

        load: function () {

            elements.home_action.removeClass('hidden');

            VD.mobile_icons_size();
            VD.mobile_icons_position();
            VD.hide_arrow();
            VD.stickyFooter();
            VD.home_action_properties();
        },

        resize: function () {

            // Only on mobile!
            if ($(window).width() <= 750) {
                VD.mobile_icons_size();
                VD.mobile_icons_position();
            } else {
                VD.home_action_properties();
            }
        },

        scroll: function () {

            // Only on desktop!
            if ($(window).width() <= 750) {

                return;
            }

            if (elements.content_container.scrollTop() + ($(window).height() * 0.6)
                > elements.body_content.offset().top) {

                elements.content_container.addClass('in-view');

            } else {

                elements.content_container.removeClass('in-view');
            }
        },

        smoothScroll: function () {

            var wpadminbar_height = elements.wpadminbar.length ? elements.wpadminbar.outerHeight() : 0;

            $('a[href*=#]:not([href=#])').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('#site-content').animate({
                            scrollTop: target.offset().top - wpadminbar_height - 20
                        }, 1000);
                        return false;
                    }
                }
            });
        },

        stickyFooter: function () {

            var footer = $("#site-footer"),
                pos = footer.position(),
                height = $('#wrapper').height() - pos.top - footer.outerHeight();

            if (height > 0) {
                footer.css({
                    'margin-top': height + 'px'
                });
            }

            footer.animate({'opacity': 1});
        },

        hide_arrow: function () {

            // Bail on not home page
            if (!$('#home-content').length) {
                return;
            }

            var scroll_window = elements.content_container.scrollTop(),
                h_screen = $(window).height(),
                content_offset = elements.home_content.offset().top;

            if (content_offset > scroll_window + h_screen - 20) {
                elements.arrow.removeClass('hidden');
            } else {
                elements.arrow.addClass('hidden');
            }
        },

        home_action_properties: function () {

            if (!$('#home-action').length) {
                return;
            }

            var e_img = elements.home_action.find('.home-action-image'),
                e_icons = elements.home_action.find('.home-action-icons'),
                window_height = $(window).height(),
                wpadminbar_height = elements.wpadminbar.length ? elements.wpadminbar.height() : 0,
                max_height = window_height - wpadminbar_height;

            e_img.css('max-height', max_height);

            var margin = max_height - e_img.height();

            if (margin > 0) {
                elements.home_action.css('margin-bottom', margin);
            }

            e_icons.width(e_img.width()).height(e_img.height()).css('left', e_img.position().left);
        },

        /**
         * Sets the size of the icons on the mobile homepage to be square.
         *
         * @since VanDam 0.1.0
         */
        mobile_icons_size: function () {

            var width = elements.mobile_home_action_icons.width();

            elements.mobile_home_action_icons.height(width);
        },

        /**
         * Moves the mobile icons to the bottom of the screen.
         *
         * @since VanDam 0.1.0
         */
        mobile_icons_position: function () {

            var h_screen = $(window).innerHeight(),
                h_adminbar = elements.wpadminbar.length ? elements.wpadminbar.outerHeight(true) : 0,
                h_logo = $('#site-logo-mobile').outerHeight(true),
                h_action = elements.mobile_home_action.outerHeight(true) - parseInt(elements.mobile_home_action_icon_container.css('margin-top')),
                h_mobileheader = $('#mobile-header').outerHeight(true),
                padding = 60,
                offset = h_screen - h_adminbar - h_mobileheader - h_logo - h_action - padding;

            // Don't allow the margin to pull the icons up into the content
            if (offset < 0) {
                offset = 0;
            }

            elements.mobile_home_action_icon_container.css('margin-top', offset);
        }
    };

    // Initialize on doc.ready
    $(VD.init);

    // Launch on load
    $(window).load(VD.load);

    $(window).resize(VD.resize);

})(jQuery);