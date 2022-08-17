jQuery(window).scroll(function() {

    if(jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height() - 700) {
        jQuery('.row.projects-row > div.speedTwo').attr('style','margin-top: 0!important');
    }

});