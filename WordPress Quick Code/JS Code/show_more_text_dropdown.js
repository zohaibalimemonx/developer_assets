$(document).ready(function() {
    var showChar = 100;
    var ellipsestext = "...";
    var moretext = "Show more";
    var lesstext = "Show less";

    $('.more').each(function() {
        var content = $(this).html();
        if (content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar - 1, content.length - showChar);
            var html = c + '<span class="morecontent"><span>' + h + '</span><a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
        }
    });
    $(".morelink").click(function() {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});

// R E A D - M O R E - W I T H - S I M P L Y - B U T T O N - T E X T/I C O N - C H A N G E

jQuery('.custom-more-btn').on('click', function(e) {
    e.preventDefault();
    jQuery('#readMoreTarget').slideToggle();
    jQuery('.custom-more-btn > .btn-icon i').toggleClass('fa-angle-double-up fa-angle-double-down');
    if (jQuery('.custom-more-btn > .btn-text').text() === 'Read More') {
        jQuery('.custom-more-btn > .btn-text').text('Read Less')
    } else {
        jQuery('.custom-more-btn > .btn-text').text('Read More');
    }
});