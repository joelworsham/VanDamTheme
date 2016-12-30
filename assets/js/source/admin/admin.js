var VD_Admin;
(function ($) {
    var maxlength = 75;

    VD_Admin = {
        init: function () {

            var icon_blocks = $('.vd-admin-icon');

            // Limit char count on keyup
            icon_blocks.find('textarea').keyup(function () {
                VD_Admin.limits($(this), maxlength);
            });

            // Show chars remaining on init
            icon_blocks.find('textarea').each(function () {
                var length = $(this).val().length > 0 ? $(this).val().length : 0;
                $(this).closest('label').find('.word-count').text(maxlength - length);
            });
        },
        limits: function (obj, limit) {

            var text = obj.val(),
                length = text.length;

            obj.closest('label').find('.word-count').text(maxlength - length);
        }
    };

    $(function () {
        VD_Admin.init();
    });
})(jQuery);