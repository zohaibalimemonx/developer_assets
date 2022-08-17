<?php 
    require 'ajax.php';
    
    define('CS_PATH', dirname(dirname(__FILE__)));
    define('CS_URL', get_stylesheet_directory_uri());
    
    add_action('init', function (){
        session_start();
    });
    
    add_action('wp_enqueue_scripts', 'enqueue_scripts_cs');
    
    function enqueue_scripts_cs() {
        wp_enqueue_script( 'validate', CS_URL . '/multi-step-form/form-scripts/library/jquery.validate.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'loadingoverlay', CS_URL . '/multi-step-form/form-scripts/library/loadingoverlay.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'sweetalert', CS_URL . '/multi-step-form/form-scripts/library/sweetalert.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'inputmast', CS_URL . '/multi-step-form/form-scripts/library/jquery.inputmask.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'customjs', CS_URL . '/multi-step-form/form-scripts/multi-step-form.js', array('jquery'), '1.0.0', true );
        
        wp_localize_script('customjs', 'cs_object',
    		array(
    			'ajax_url' => admin_url( 'admin-ajax.php' ),
    		)
    	);
    }