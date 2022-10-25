<?php
add_action('init', function (){ session_start(); });
    
if( !function_exists( 'wordpress_enqueue_additional_scripts' ) )
{
    add_action( 'wp_enqueue_scripts', 'wordpress_enqueue_additional_scripts' );
    function wordpress_enqueue_additional_scripts()
    {
        wp_enqueue_script( 'jquery-validate-min-js', get_stylesheet_directory_uri() . '/backend-system/library/jquery.validate.min.js', array(), '1.17.0', true );
        wp_enqueue_script( 'loadingoverlay-min-js', get_stylesheet_directory_uri() . '/backend-system/library/loadingoverlay.min.js', array(), '2.1.6', true );
        wp_enqueue_script( 'sweetalert-min-js', get_stylesheet_directory_uri() . '/backend-system/library/sweetalert.min.js', array(), '1.0.0', true );
        wp_enqueue_script( 'scripts-handler-js', get_stylesheet_directory_uri() . '/backend-system/scripts-handler.js', array('jquery-validate-min-js', 'loadingoverlay-min-js', 'sweetalert-min-js'), '1.0.0', true );
        wp_localize_script('scripts-handler-js', 'handler_object',
    		array(
    			'ajax_url' => admin_url( 'admin-ajax.php' ),
    		)
    	);
    }
}

// Custom Post Type (Calculator)

add_action( 'init', 'calculator_custom_post_type' );
function calculator_custom_post_type() {

	$labels = array(
		'name'               => __( 'Services', 'text-domain' ),
		'singular_name'      => __( 'Service', 'text-domain' ),
		'add_new'            => _x( 'Add New Service', 'text-domain', 'text-domain' ),
		'add_new_item'       => __( 'Add New Service', 'text-domain' ),
		'edit_item'          => __( 'Edit Service', 'text-domain' ),
		'new_item'           => __( 'New Service', 'text-domain' ),
		'view_item'          => __( 'View Service', 'text-domain' ),
		'search_items'       => __( 'Search Services', 'text-domain' ),
		'not_found'          => __( 'No Services found', 'text-domain' ),
		'not_found_in_trash' => __( 'No Services found in Trash', 'text-domain' ),
		'parent_item_colon'  => __( 'Parent Service:', 'text-domain' ),
		'menu_name'          => __( 'Services', 'text-domain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-calculator',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'thumbnail'
		),
	);

	register_post_type( 'calculator', $args );
}

add_action( 'init', 'calculator_custom_tax' );
function calculator_custom_tax() {

	$labels = array(
		'name'                  => _x( 'Categories', 'Taxonomy Categories', 'text-domain' ),
		'singular_name'         => _x( 'Category', 'Taxonomy Category', 'text-domain' ),
		'search_items'          => __( 'Search Categories', 'text-domain' ),
		'popular_items'         => __( 'Popular Categories', 'text-domain' ),
		'all_items'             => __( 'All Categories', 'text-domain' ),
		'parent_item'           => __( 'Parent Category', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent Category', 'text-domain' ),
		'edit_item'             => __( 'Edit Category', 'text-domain' ),
		'update_item'           => __( 'Update Category', 'text-domain' ),
		'add_new_item'          => __( 'Add New Category', 'text-domain' ),
		'new_item_name'         => __( 'New Category Name', 'text-domain' ),
		'add_or_remove_items'   => __( 'Add or remove Categories', 'text-domain' ),
		'choose_from_most_used' => __( 'Choose from most used Categories', 'text-domain' ),
		'menu_name'             => __( 'Category', 'text-domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'calculator_tax', array( 'calculator' ), $args );
}

if(!function_exists('custom_filter_title')) {
	function custom_filter_title($lab) {
		$label = substr($lab, 0, strpos($lab, "+"));
		return $label;
	}
}
if(!function_exists('custom_filter_price')) {
	function custom_filter_price($pri) {
		$price = (int)str_replace('+', '', substr($pri, strpos($pri, "+")));
		return $price;
	}
}

add_action( "wp_ajax_process_consultation_function_one", 'process_consultation_function_one', 10 );
add_action( "wp_ajax_nopriv_process_consultation_function_one", 'process_consultation_function_one', 10 );

function process_consultation_function_one()
{
    if( !empty($_POST['email_address']) && !empty($_POST['phone_number']) && !empty($_POST['first_name']) )
    {
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $subject = 'Consultation Request From '.$_POST['first_name'].'.';
        $message = '<html><body>';
        $message .= '<table>';
        
        $message .= "<tr><td>Request For Consultation</td></tr>";
        $message .= "<tr><td><br></td></tr>";
        
        $message .= "<tr><td>Name: ".$_POST['first_name']. " ".$_POST['last_name']."</td></tr>";
        $message .= "<tr><td>Email: ".$_POST['email_address']."</td></tr>";
        $message .= "<tr><td>Phone: ".$_POST['phone_number']."</td></tr>";
        $message .= "<tr><td><br></td></tr>";
        
        $message .= "<tr><td>Selected Items:</td></tr>";
        $message .= "<tr><td></td></tr>";
        
        foreach ($_POST['items_for_cons'] as $key => $value)
        {
            if( !empty($value) )
            {
                $message .= "<tr><td><strong>".custom_filter_title($value).":</strong> </td><td>$".custom_filter_price($value)."</td></tr>";
            }
        }
        
        $message .= "<tr><td><br></td></tr>";
        $message .= "<tr><td><strong>Grand Total:</strong> </td><td>$".$_POST['grand_total_hidden']."</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        
        $admin_email = 'developer@eseospace.com';
        wp_mail($admin_email, $subject,$message, $headers);
        
        $ajax['status'] = true;
        $ajax['message'] = 'Your Request For Consultation Has Been Sent!';
        print(json_encode($ajax));
        exit();
    }
    else
    {
        $ajax['status'] = false;
        $ajax['message'] = 'Invalid Input';
        print(json_encode($ajax));
        exit();
    }
}















