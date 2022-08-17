<?php
if( !function_exists( 'wordpress_enqueue_additional_scripts' ) )
{
    add_action( 'wp_enqueue_scripts', 'wordpress_enqueue_additional_scripts' );
    function wordpress_enqueue_additional_scripts()
    {
        wp_enqueue_script( 'jquery-3-6-0-min', get_stylesheet_directory_uri() . '/backend-system/library/jquery-3.6.0.min.js', array(), '3.6.0', true );
        wp_enqueue_script( 'jquery-validate-min-js', get_stylesheet_directory_uri() . '/backend-system/library/jquery.validate.min.js', array('jquery-3-6-0-min'), '1.17.0', true );
        wp_enqueue_script( 'loadingoverlay-min-js', get_stylesheet_directory_uri() . '/backend-system/library/loadingoverlay.min.js', array('jquery-3-6-0-min'), '2.1.6', true );
        wp_enqueue_script( 'sweetalert-min-js', get_stylesheet_directory_uri() . '/backend-system/library/sweetalert.min.js', array('jquery-3-6-0-min'), '1.0.0', true );
        wp_enqueue_script( 'scripts-handler-js', get_stylesheet_directory_uri() . '/backend-system/scripts-handler.js', array('jquery-validate-min-js', 'loadingoverlay-min-js', 'sweetalert-min-js', 'jquery-3-6-0-min'), '1.0.0', true );
        wp_localize_script('scripts-handler-js', 'handler_object',
    		array(
    			'ajax_url' => admin_url( 'admin-ajax.php' ),
    		)
    	);
    }
}