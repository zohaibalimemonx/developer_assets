$(window).scroll(function() {

    var windscroll = $(window).scrollTop();

    if (windscroll >= 100) {
        $('#TrackerSections').each(function(i) {
            if ($(this).position().top <= windscroll + 50) {
                $('.navScrollTo.active').removeClass('active');
                $('.navScrollTo').eq(i).addClass('active');
            }
        });

    } else {

        $('.navScrollTo.active').removeClass('active');
        $('.navScrollTo:first').addClass('active');
    }

}).scroll();