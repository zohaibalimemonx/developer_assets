<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}

// Backend System
require_once get_stylesheet_directory() . '/backend-system/functions.php';

/* Unregistered Widgets */
if ( ! function_exists( 'b7ectg_unregister_widget' ) ) {
    add_action( 'widgets_init', 'b7ectg_unregister_widget' );
    
    function b7ectg_unregister_widget() {
    
        unregister_widget( 'Tribe\Events\Views\V2\Widgets\Widget_List' );
        unregister_widget( 'Tribe\Events\Pro\Views\V2\Widgets\Widget_Countdown' );
        unregister_widget( 'Tribe\Events\Pro\Views\V2\Widgets\Widget_Featured_Venue' );
        unregister_widget( 'Tribe\Events\Pro\Views\V2\Widgets\Widget_Month' );
        unregister_widget( 'Tribe\Events\Pro\Views\V2\Widgets\Widget_Week' );
    }
}
