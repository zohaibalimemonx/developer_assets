<?php

    function login_auth()
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
                $ajax['redirect'] = get_permalink( $std_page_id = 207 );
                print(json_encode($ajax));
                exit();
            }
            else
            {
                wp_set_current_user( $userID, $creds['user_login'] );
                wp_set_auth_cookie( $userID, true, false );
                
                $ajax['status'] = true;
                $ajax['redirect'] = get_permalink( $std_page_id = 14 );
                print(json_encode($ajax));
                exit();
            }
        }
    }

?>