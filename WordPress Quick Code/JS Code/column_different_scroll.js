var background_image_parallax = function($object, multiplier){
    multiplier = typeof multiplier !== 'undefined' ? multiplier : 0.5;
    multiplier = 1 - multiplier;
    var $doc = jQuery(document);
    jQuery(window).scroll(function(){
        var from_top = $doc.scrollTop(),
            // bg_css = '0px ' +(multiplier * from_top) + 'px';
            // bg_css = "matrix(1, 0, 0, 1, 0, -" + (multiplier * from_top) + ")";
                bg_css = '-'+(multiplier * from_top) + 'px'
        $object.css({"margin-top" : bg_css });
    });
};
background_image_parallax(jQuery(".row.projects-row > div.speedTwo"), 0.95);