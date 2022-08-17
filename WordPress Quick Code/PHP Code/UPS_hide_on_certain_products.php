<?php 

add_filter('woocommerce_package_rates', 'hide_shipping_method_if_particular_product_available_in_cart', 10, 2);
	
	function hide_shipping_method_if_particular_product_available_in_cart($available_shipping_methods)
	{
		global $woocommerce;
	
		// products_array should be filled with all the products ids
		// for which shipping method (stamps) to be restricted.
	
		$products_array = array(
			735,
		);
	
		// You can find the shipping service codes by doing inspect element using
		// developer tools of chrome. Code for each shipping service can be obtained by
		// checking 'value' of shipping option.
	
		$shipping_services_to_hide = array(
			'wf_usps_stamps:D_FIRST_CLASS',
			'wf_usps_stamps:D_PRIORITY_MAIL'
		);
	
		// Get all products from the cart.
	
		$products = $woocommerce->cart->get_cart();
	
		// Crawl through each items in the cart.
	
		foreach($products as $key => $item) {
	
			// If any product id from the array is present in the cart,
			// unset all shipping method services part of shipping_services_to_hide array.
	
			if (in_array($item['product_id'], $products_array)) {
				foreach($shipping_services_to_hide as & $value) {
					unset($available_shipping_methods[$value]);
				}
	
				break;
			}
		}
	
		// return updated available_shipping_methods;
		return $available_shipping_methods;
	}



?>