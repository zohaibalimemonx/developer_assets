<?php 
    
    function woo_custom_cart_button_text() {
        return __('Book Now', 'woocommerce');
    }
    add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text');

?>