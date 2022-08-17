<?php 

/**  
 *  GET PRODUCT ID FROM COMPLETED ORDERS
**/

$order_args = array(
    'customer_id' => $current_user_id
);

// getting all orders of the current user
$total_orders = wc_get_orders($order_args);

// loop through all orders object
foreach( $total_orders as $total_order )
{
    // get each order
    $order_items = $total_order->get_items();
    
    // loop through each order
    foreach( $order_items as $order_item )
    {
        // get id from the order
        $_product_id[] = $order_item->get_product_id();
    }
}


/**  
 *  GET PRODUCT ID FROM USER's SUBSCRIPTIONS
**/

// USER SUBSCRIPTION DATA
$users_subscriptions_object = wcs_get_users_subscriptions( $current_user_id );

// LOOP THROUGH EACH SUBSCRIPTION
foreach ( $users_subscriptions_object as $users_subscriptions ) :
    
    // EACH ORDER OBJECT
    $users_order_object = wc_get_order( $users_subscriptions );
    
    // EACH ORDERED SUBSCRIPTION OBJECT
    $ordered_product = $users_order_object->get_items();
    
    foreach ( $ordered_product as $_product ) :
        
        $_product_id[] = $_product->get_product_id();
        
    endforeach;
    
endforeach;



?>