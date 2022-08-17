jQuery(document).ready(function($) {

    jQuery(document).on('click', '.open-popup1', function(event) {
        event.preventDefault();
        jQuery(this).magnificPopup({
            items: {
                src: '.popup-review1',
                type: 'inline'
            },
            fixedContentPos: true,
            callbacks: {
                beforeOpen: function() { jQuery('html').addClass('mfp-helper'); },
                close: function() { jQuery('html').removeClass('mfp-helper'); }
            }
        }).magnificPopup('open');

    }); //click ends here	
});