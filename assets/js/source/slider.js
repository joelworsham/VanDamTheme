/**
 * Controls the slider functionality for the homepage.
 *
 * @since VanDam 0.1
 */
var VD_Slider;
(function ($) {
    VD_Slider = {
        /**
         * Initializes the object.
         *
         * @since VanDam 0.1
         */
        init: function () {
            // Initially resize the slider
            this.resize();

            // On window resize, resize slider
            $(window).resize(function () {
                VD_Slider.resize();
            })
        },
        /**
         * Re-sizes the slider.
         *
         * @since VanDam 0.1
         */
        resize: function () {
            var win_height = $(window).innerHeight(),
                e_slider = $('#site-slider'),
                e_slides = $('[class^="slide-"]'),
                e_logo = $('#site-logo-mobile'),
                logo_height = e_logo.css('display') == 'block' ? e_logo.outerHeight() : false,
                output_height = (logo_height ? win_height - logo_height : win_height) + 'px';

            // Transform the slider container
            e_slider.css({
                height: output_height
            });

            // Transform the slides themselves
            e_slides.css({
                height: output_height,
                'line-height': output_height
            });
        }
    };

    // Initialize on doc.ready
    $(function () {
        VD_Slider.init();
    });
})(jQuery);