/* FULL PAGE (fullPage.js) Library (See PHP Pre Enqueue Scripts File) */

jQuery(document).ready(function () {
    jQuery('#fullpage').fullpage({
        css3: true,
        scrollingSpeed: 700,
        autoScrolling: true,
        slidesNavigation: true,
        slidesNavPosition: 'bottom',
        navigation: true,
        anchors: ['', '',''],
    });
});