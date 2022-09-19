
/*
*   JavaScript Time (Both - Plus & Minus)
*/

clearInterval(waitTimeInterval);

var waitTime = 60;
var waitTimeInterval = setInterval(function () {
    
    if( waitTime === 0 )
    {
        jQuery(document).find('#waitTime').text('');
        clearInterval(waitTimeInterval);
        get_all_registered_users();
        return;
    }
    
    jQuery(document).find('#waitTime').text(waitTime + ' sec');
    waitTime--;
    
}, 1000);