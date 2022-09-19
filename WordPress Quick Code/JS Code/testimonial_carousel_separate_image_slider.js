// REF: https://sports-nutritionist.com/

jQuery(document).ready(function($) {
	/* ON LOAD */
	var pic = jQuery(document).find('.owl-item.active .testimonial-avatar img').attr('src');
	var thePic = jQuery(document).find('.img-col img');
	jQuery(thePic).attr('src', pic).attr('srcset', pic);
	/* On CHANGE */
	var owl = jQuery(document).find('.testimonials .owl-carousel');
	//owl.owlCarousel();
	owl.on('changed.owl.carousel', function(event) {
		setTimeout(function() {
			var pic = jQuery(document).find('.owl-item.active .testimonial-avatar img').attr('src');
			var thePic = jQuery(document).find('.img-col img');
			jQuery(thePic).attr('src', pic).attr('srcset', pic);
		}, 100);
	});
});