<?php 
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