<?php
    $events_array = array(
		'post_type' => array('product'),
		'post_status' => array('publish'),
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => -1,
	);
	$events_OBJ = new WP_Query($events_array);
	
	$events_data_all = array();
	$data_counter = 0;

	while ($events_OBJ->have_posts()) : $events_OBJ->the_post();
		
		$date_d = date_create(get_field('event_due_date'));

		$events_data_all[$data_counter]['ev_date']  =  date_format($date_d, "Y m d H:i:s");
		$events_data_all[$data_counter]['ev_title']  = get_the_title();
		$events_data_all[$data_counter]['ev_link']  = get_the_permalink();
		$data_counter++;

	endwhile;
    
    add_action('wp_enqueue_scripts', 'enqueue_scripts_cs');
    function enqueue_scripts_cs() {
		global $events_data_all;
        wp_enqueue_script( 'scripts-handler-js', CS_URL . '/backend-system/assets/scripts-handler.js', array('jquery'), '1.0.0', true );
        wp_localize_script('scripts-handler-js', 'cs_object',
    		array(
				'event_object' => $events_data_all
    		)
    	);
    }