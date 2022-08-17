<?php /* UPC Number Integration For WooCommerce Products AND ATTACH WITH EMAIL */

/* *** Add Custom Field In WooCommerce Variatons *** */
add_action( 'woocommerce_variation_options_pricing', 'add_woodmart_upc_input_field', 10, 3 );
function add_woodmart_upc_input_field( $loop, $variation_data, $variation ) 
{
	woocommerce_wp_text_input( array(
		'id' => 'custom_upc_field[' . $loop . ']',
		'class' => 'short wc_input_decimal',
		'label' => __( 'UPC Number', 'woocommerce' ),
		'wrapper_class' => 'form-row form-row-full',
		'value' => get_post_meta( $variation->ID, 'custom_upc_field', true )
		) 
	);
}

/* *** Save Custom Field In WooCommerce Variations *** */
add_action( 'woocommerce_save_product_variation', 'save_woodmart_upc_input_field', 10, 2 );
function save_woodmart_upc_input_field( $variation_id, $i )
{
	$custom_upc_field = $_POST['custom_upc_field'][$i];
	if ( isset( $custom_upc_field ) )
	{
		update_post_meta( $variation_id, 'custom_upc_field', esc_attr( $custom_upc_field ) );
	}
}

/* *** Store Custom Field In WooCommerce Variations Data *** */
add_filter( 'woocommerce_available_variation', 'store_woodmart_upc_input_field' );
 
function store_woodmart_upc_input_field( $variations ) {
   $variations['custom_upc_field'] = '<div class="woocommerce_custom_field">UPC Number: <span>' . get_post_meta( $variations[ 'variation_id' ], 'custom_upc_field', true ) . '</span></div>';
   return $variations;
}

/* *** Email UPC Data *** */
add_action( 'woocommerce_email_after_order_table', 'woodmart_email_upc_number', 10, 4 );
function woodmart_email_upc_number( $order, $sent_to_admin, $plain_text, $email ) 
{ 
    $order_data = wc_get_order( $order );

	$items = $order_data->get_items();
	$table = '';
	foreach ( $items as $item )
	{
        $variation = new WC_Product_Variation($item['variation_id']);
        $variationName = implode(" / ", $variation->get_variation_attributes());
        
		$table .= '<div style="border: 1px solid #e5e5e5; padding: 10px; margin-bottom: 5px; "><strong>'.$item['name'].' | '.$variationName.' (UPC No.) : </strong><span style="border-right: 1px solid #e5e5e5;">'.get_post_meta( $item['variation_id'], 'custom_upc_field', true ).'</span></div>';
	}
	
	echo $table;
}

?>