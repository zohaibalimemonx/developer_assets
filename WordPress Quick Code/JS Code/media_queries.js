$(document).load($(window).bind("resize", checkPosition));

function checkPosition() {
    if (window.matchMedia('(max-width: 767px)').matches) {
        //...
    } else {
        //...
    }
}