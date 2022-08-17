timer();
function timer()
{
    var currentTime = new Date();
    var hours = currentTime.getHours() % 12;
    var minutes = currentTime.getMinutes();
    var sec = currentTime.getSeconds();
    var dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d_day = dayNames[currentTime.getDay()];
    var d_n = currentTime.getDate();
    var d_m = monthNames[currentTime.getMonth()];
    var d_y = currentTime.getFullYear();
    var full_date = d_m + ' ' + d_n + ', ' + d_y;

    if (minutes < 10){
        minutes = "0" + minutes;
    }
    if (sec < 10){
        sec = "0" + sec;
    }
    var t_str = hours + ":" + minutes + ' ';
    if(hours > 11){
        t_str += "pm";
    } else {
    t_str += "am";
    }
    
    document.getElementById('d_day').innerHTML = d_day;
    document.getElementById('d_date').innerHTML = full_date;
    document.getElementById('d_time').innerHTML = t_str;

    setTimeout(timer,1000);
}