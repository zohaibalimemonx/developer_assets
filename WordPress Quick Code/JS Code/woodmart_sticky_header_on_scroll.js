var num = 200; //number of pixels before modifying styles

jQuery(window).bind('scroll', function() {

    if (jQuery(window).scrollTop() > num) {
        jQuery('.whb-sticky-prepared').addClass('whb-sticked');
    } else {
        jQuery('.whb-sticky-prepared').removeClass('whb-sticked');
    }

});