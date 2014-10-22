jQuery(function ($) {
    $('.dc-line').each(function () {
        var e_padding = Math.round(Math.random() * 50);

        $(this).css('padding-right', e_padding);
    });
});