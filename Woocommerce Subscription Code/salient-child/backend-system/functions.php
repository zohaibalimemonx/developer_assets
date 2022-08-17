<?php
    
    define('CS_PATH', dirname(dirname(__FILE__)));
    define('CS_URL', get_stylesheet_directory_uri());
    
    add_action('wp_enqueue_scripts', 'enqueue_scripts_cs');
    
    function enqueue_scripts_cs() {
        wp_enqueue_style( 'bootstrap-grid-min-css', CS_URL . '/backend-system/library/bootstrap-grid.min.css', array(), '4.6.0', 'all' );
        wp_enqueue_script( 'validate', CS_URL . '/backend-system/library/jquery.validate.min.js', array('jquery'), '1.17.0', true );
        wp_enqueue_script( 'loadingoverlay', CS_URL . '/backend-system/library/loadingoverlay.min.js', array('jquery'), '2.1.6', true );
        wp_enqueue_script( 'sweetalert', CS_URL . '/backend-system/library/sweetalert.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'scripts-handler-js', CS_URL . '/backend-system/assets/scripts-handler.js', array('jquery'), '1.0.0', true );
        
        wp_localize_script('scripts-handler-js', 'cs_object',
    		array(
    			'ajax_url' => admin_url( 'admin-ajax.php' ),
    		)
    	);
    }
    
    // RE-DIRECT AFTER LOGOUT
    add_action('wp_logout','ps_redirect_after_logout');
    function ps_redirect_after_logout(){
        wp_redirect( get_permalink( $std_page_id = 1488 ) );
        exit();
    }
    
    function pagination($pages = '', $range = 4){  
      $showitems = ($range * 2)+1;  
    
      global $paged;
      if(empty($paged)) $paged = 1;
    
      if($pages == '')
      {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
          $pages = 1;
        }
      }   
    
      if(1 != $pages)
      {
             // echo "<div class=\"pagination\">
             // <span>Page ".$paged." of ".$pages."</span>";         
        echo "<div class=\"woocommerce-pagination\"><ul class='page-numbers'>";
    
        echo '<li>';
        previous_posts_link('<span class="prev page-numbers">←</span>');
        echo '</li>';
    
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
        if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>";
    
        for ($i=1; $i <= $pages; $i++)
        {
          if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
          {
            echo ($paged == $i)? "<li><span class=\"page-numbers current\">".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
          }
        }
    
        if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a></li>";  
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
        echo '<li>';
        next_posts_link('<span class="next page-numbers">←</span>');
        echo '</li>';
        echo "</ul></div>\n";
      }
    }
    
    function woo_custom_cart_button_text() {
        return __('Sign Up', 'woocommerce');
    }
    add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text');
        
    // <!--- REGISTER & LOGIN --->
    class Website_Access_Controller
    {
        
        function __construct()
        {
            add_action( "wp_ajax_login_auth", array($this, 'login_auth'), 10 );
            add_action( "wp_ajax_nopriv_login_auth", array($this, 'login_auth'), 10 );
            
            add_action( "wp_ajax_register_auth", array($this, 'register_auth'), 10 );
            add_action( "wp_ajax_nopriv_register_auth", array($this, 'register_auth'), 10 );
            
        }
        
        public function login_auth()
        {
            if( !empty($_POST['username']) && !empty($_POST['password']) )
            {
                $creds = array(
                    'user_login'    => esc_attr($_POST['username']),
                    'user_password' => esc_attr($_POST['password']),
                    'remember'      => false,
                );
                
                $user = wp_signon( $creds, true );
                $userID = $user->ID;
                
                if ( is_wp_error($user) )
                {
                    $ajax['status'] = false;
                    print(json_encode($ajax));
                    exit();
                }
                else
                {
                    wp_set_current_user( $userID, $creds['user_login'] );
                    wp_set_auth_cookie( $userID, true, false );
                    
                    $ajax['status'] = true;
                    $ajax['redirect'] = get_permalink( $std_page_id = 1526 );
                    print(json_encode($ajax));
                    exit();
                }
            }
        }
        
        public function register_auth()
        {
            if( !empty($_POST['email_address']) && !empty($_POST['username']) && !empty($_POST['cpassword']) )
            {
                
                if( username_exists($_POST['username']) )
                {
                    $ajax['status']     = false;
                    $ajax['message']    = 'Username already exists';
                    print(json_encode($ajax));
                    exit();
                }
                elseif( email_exists($_POST['email_address']) )
                {
                    $ajax['status']     = false;
                    $ajax['message']    = 'Email Address already exists';
                    print(json_encode($ajax));
                    exit();
                }
                
                $user_data = array(
                    'user_pass'     => esc_attr($_POST['cpassword']),
                    'user_login'    => esc_attr($_POST['username']),
                    'user_email'    => esc_attr($_POST['email_address']),
                    'first_name'    => esc_attr($_POST['first_name']),
                    'last_name'     => esc_attr($_POST['last_name']),
                    'role'          => esc_attr('subscriber')
                );
                
                $user_ID = wp_insert_user($user_data);
                update_user_meta($user_ID, "billing_phone", sanitize_text_field($_POST["phone_number"]));
                
                if ( ! is_wp_error( $user_ID ) ) 
                {
                    $ajax['status'] = true;
                    $ajax['redirect'] = get_permalink( $std_page_id = 1488 );
                    print(json_encode($ajax));
                    exit();
                }
                else
                {
                    $ajax['status'] = false;
                    $ajax['message']    = 'Registration Failed - Please Try Again!';
                    print(json_encode($ajax));
                    exit();
                }
            }
            else
            {
                $ajax['status']     = false;
                $ajax['message']    = 'Invalid User Input';
                print(json_encode($ajax));
                exit();
            }
        }
		
    }
    new Website_Access_Controller();
    
    
    class Woocommerce_Subscription_Controller
    {
        function __construct()
        {
            add_action( "wp_ajax_get_user_subscription", array($this, 'get_user_subscription'), 10 );
            // add_action( "wp_ajax_nopriv_get_user_subscription", array($this, 'get_user_subscription'), 10 );
            
            add_action( "wp_ajax_get_user_past_events", array($this, 'get_user_past_events'), 10 );
            // add_action( "wp_ajax_nopriv_get_user_past_events", array($this, 'get_user_past_events'), 10 );
        }
        
        function get_user_subscription()
        {
            $current_user_id = get_current_user_id();
            $_product_id = array();
            $counter = 0;
            
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
            
            if( !empty( $_product_id ) && $_product_id != 0 )
            {
                $datetime = new DateTime();
                $today = $datetime->format('Ymd');
                $mainarray = array(
                    'post_type' => array('product'),
                    'post_status' => array('publish'),
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'meta_key' => 'event_due_date',
                    'post__in'=> $_product_id,
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'event_due_date',
                            'value' => $today,
                            'type' => 'numeric',
                            'compare' => '>='
                        )
                    ),
                );
                
                $subscribed_product_object = new WP_Query($mainarray);
            
                if( $subscribed_product_object->have_posts() )
                {
                    while ($subscribed_product_object->have_posts()) : $subscribed_product_object->the_post();
                    
                        if(has_post_thumbnail())
                        {
                            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true);
                        }
                        else
                        {
                            $thumbnail[0] = site_url() . '/wp-content/uploads/2022/05/woocommerce-placeholder.webp';
                        }
                        $cs_ajax[$counter]['single_title'] = get_the_title();
                        $cs_ajax[$counter]['single_id'] = get_the_ID();
                        $cs_ajax[$counter]['single_feature'] = $thumbnail[0];
                        $cs_ajax[$counter]['single_permalink'] = get_the_permalink();
                        if( !empty( get_field('event_due_date') ) )
                        {
                            $event_date = get_field('event_due_date');
                            $event_date_format = date("l, F j, Y", strtotime($event_date));
                            $cs_ajax[$counter]['single_meta_field'] = $event_date_format;
                        }
                        
                        $counter++;
                    
                    endwhile;
                    
                    $ajax['status'] = true;
                    $ajax['data'] = $cs_ajax;
                    print(json_encode($ajax));
                    exit();
                }
                else
                {
                    $ajax['status'] = false;
                    $ajax['message'] = 'No Event Found!';
                    print(json_encode($ajax));
                    exit();
                }
            }
            else
            {
                $ajax['status'] = false;
                $ajax['message'] = 'You are not Subscribed to any event!';
                print(json_encode($ajax));
                exit();
            }
        }
        
        function get_user_past_events()
        {
            $current_user_id = get_current_user_id();
            $_product_id = array();
            $counter = 0;
            
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
            
            if( !empty( $_product_id ) && $_product_id != 0 )
            {
                $datetime = new DateTime();
                $today = $datetime->format('Ymd');
                $mainarray = array(
                    'post_type' => array('product'),
                    'post_status' => array('publish'),
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'meta_key' => 'event_due_date',
                    'post__in'=> $_product_id,
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'event_due_date',
                            'value' => $today,
                            'type' => 'numeric',
                            'compare' => '<='
                        )
                    ),
                    
                );
            
                $subscribed_product_object = new WP_Query($mainarray);
            
                if( $subscribed_product_object->have_posts() )
                {
                    while ($subscribed_product_object->have_posts()) : $subscribed_product_object->the_post();
                    
                        if (has_post_thumbnail())
                        {
                            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true);
                        }
                        else
                        {
                            $thumbnail[0] = site_url() . '/wp-content/uploads/2022/05/woocommerce-placeholder.webp';
                        }
                        $cs_ajax[$counter]['single_title'] = get_the_title();
                        $cs_ajax[$counter]['single_id'] = get_the_ID();
                        $cs_ajax[$counter]['single_feature'] = $thumbnail[0];
                        $cs_ajax[$counter]['single_permalink'] = get_the_permalink();
                        if( !empty( get_field('event_due_date') ) )
                        {
                            $event_date = get_field('event_due_date');
                            $event_date_format = date("l, F j, Y", strtotime($event_date));
                            $cs_ajax[$counter]['single_meta_field'] = $event_date_format;
                        }
                        
                        $counter++;
                    
                    endwhile;
                    
                    $ajax['status'] = true;
                    $ajax['data'] = $cs_ajax;
                    print(json_encode($ajax));
                    exit();
                }
                else
                {
                    $ajax['status'] = false;
                    $ajax['message'] = 'No Events Found!';
                    print(json_encode($ajax));
                    exit();
                }
            }
            else
            {
                
                $ajax['status'] = false;
                $ajax['message'] = 'You are not Subscribed to any event!';
                print(json_encode($ajax));
                exit();
            }
        }
    }
    new Woocommerce_Subscription_Controller();
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    