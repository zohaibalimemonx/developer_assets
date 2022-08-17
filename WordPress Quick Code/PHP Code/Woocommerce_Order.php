<?php

/**
 *  Create New Order With PHP
 */

$address = array(
    'first_name' => '',
    'last_name'  => '',
    'company'    => '',
    'email'      => '',
    'phone'      => '',
    'address_1'  => '',
    'address_2'  => '', 
    'city'       => '',
    'state'      => '',
    'postcode'   => '',
    'country'    => ''
);

$order = wc_create_order();
$order->add_product( get_product( '12' ), 1 ); //(get_product with id and next is for quantity)
$order->set_address( $address, 'billing' );
$order->set_address( $address, 'shipping' );
$order->add_coupon('Fresher','10','2'); // accepted param $couponcode, $couponamount,$coupon_tax
$order->update_status("processing", 'Imported order', TRUE);
$order->calculate_totals();

// FOR ORDER ID
$order->get_id();

?>








<?php 

/**
 *  Auto Complete all WooCommerce orders.
 */

add_action( 'woocommerce_thankyou', 'do_auto_complete_woo_order' );
function do_auto_complete_woo_order( $order_id ) { 
    if ( ! $order_id )
    {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}

?>