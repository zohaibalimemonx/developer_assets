<?php
// Enqueue Scripts
wp_enqueue_style( 'simple-calendar-css', CS_URL . '/backend-system/library/simple-calendar.css', array(), '1.0.0', 'all' );
wp_enqueue_script( 'jquery-simple-calendar-min', CS_URL . '/backend-system/library/jquery.simple-calendar.min.js', array('jquery'), '1.0.0', true );


// PHP Date Formating
$date_d = date_create(get_field('event_due_date'));
$events_data_all[$data_counter]['ev_date']  =  date_format($date_d, "Y m d H:i:s");

?>

<script>
    // Events Calender
	jQuery(document).on('click', '#showEventsTab', function(e){
		e.preventDefault();

		var event_calender = '<div class="events-calender-wrapper"><div id="eventCalender"></div></div>';
		
		jQuery('.events-intro-title > a').removeClass('tab-active');
		jQuery(this).addClass('tab-active');
		jQuery('.custom-paging-row').hide();
		jQuery('#signupEventContent').html(event_calender);

        // Initialize Calender
		var calContainer = jQuery(document).find('#eventCalender').simpleCalendar();
		let CalenderInstance = calContainer.data('plugin_simpleCalendar');
		
        // Add Events
		jQuery.each(cs_object.event_object, function(index, val) {
			var newEvent = {
				startDate: new Date(val.ev_date).toISOString(),
				endDate: new Date(val.ev_date).toISOString(),
				summary: '<a href="'+val.ev_link+'">'+val.ev_title+'</a>'
			}
			CalenderInstance.addEvent(newEvent);
		});
		
	});
</script>

<!-- Simple Events Calender Without Click Action -->
<script>
	var calContainer = jQuery(document).find('#eventCalender').simpleCalendar();
	let CalenderInstance = calContainer.data('plugin_simpleCalendar');
	if( CalenderInstance )
	{
	    jQuery.each(cs_object.event_object, function(index, val) {
		
    		var newEvent = {
    			startDate: new Date(val.ev_date).toISOString(),
    			endDate: new Date(val.ev_date).toISOString(),
    			summary: '<a href="'+val.ev_link+'">'+val.ev_title+'</a>'
    		}
    		CalenderInstance.addEvent(newEvent);
    	});
	}
</script>