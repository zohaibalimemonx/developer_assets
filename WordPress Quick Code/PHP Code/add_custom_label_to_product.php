<?php 
		function custom_badges() {

		// Get the value from custom field (Advance Custom Field)	
	    $badges = get_field('product_definition_label');

	    // Validate and place it into the product
    	if(!empty($badges)){
			echo "<div class='p-custom-label'>".get_field('product_definition_label')."</div>";
		}
	}
	
	add_action( 'woocommerce_before_shop_loop_item_title', 'custom_badges', 5 );
	add_action( 'woocommerce_before_single_product_summary', 'custom_badges', 5 );

?>