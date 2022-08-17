<?php 

/**  
 * Hidden Price & Add to Cart For The Public - Only Logged In Users Can See The Price
*/

function hide_price_from_logout_users() {   
   if ( ! is_user_logged_in() ) {      
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );   
      add_action( 'woocommerce_single_product_summary', 'login_to_see_prices', 31 );
      add_action( 'woocommerce_after_shop_loop_item', 'login_to_see_prices', 11 );
   }
}

add_action( 'init', 'hide_price_from_logout_users' );

function login_to_see_prices() {
   echo '<a href="' . get_permalink(wc_get_page_id('myaccount')) . '">' . __('Login to see prices', 'theme_name') . '</a>';
}

?>