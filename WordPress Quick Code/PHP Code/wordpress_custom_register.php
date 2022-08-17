<?php 

function register_auth()
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

        // FOR WOOCOMMERCE FIELDS
        update_user_meta($user_ID, "billing_phone", sanitize_text_field($_POST["phone_number"]));
        
        if ( ! is_wp_error( $user_ID ) ) 
        {
            $ajax['status'] = true;
            $ajax['redirect'] = get_permalink( $std_page_id = 1503 );
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

?>