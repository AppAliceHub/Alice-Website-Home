jQuery(document).ready(function($) {
    // Check initial scroll position
    if ($(window).scrollTop() > 50) {
        $('.logo-1').hide();
        $('.logo-2').show();
    } else {
        $('.logo-1').show();
        $('.logo-2').hide();
    }

    // Handle scroll events
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 50) {
            $('.logo-1').hide();
            $('.logo-2').show();
        } else {
            $('.logo-1').show();
            $('.logo-2').hide();
        }
    });
});
