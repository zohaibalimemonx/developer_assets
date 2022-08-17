<?php

    add_action( 'wpcf7_mail_sent', 'wpcf7_register_new_user' );
    function wpcf7_register_new_user( $contact_form ) {

        // Get Form ID On Which We Want To Register The User
        $register_form_id = $contact_form->id();

        // Get Data Instances From Contact Form 7
        $submission = WPCF7_Submission::get_instance();
        $contact_form = $submission->get_posted_data();

        if ( $register_form_id == 129 ) {
            
            // Validate Email Address (Should Not Exist)
            if(!email_exists($contact_form['email-address'])){
                
                $new_user_data = array(
                    'first_name' => $contact_form['first-name'],
                    'last_name' => $contact_form['last-name'],
                    'user_email' => $contact_form['email-address'],
                    'role' => 'subscriber',
                    'user_login' => substr($contact_form['email-address'], 0, strrpos($contact_form['email-address'], '@')),
                    'user_pass'	=> substr($contact_form['email-address'], 0, strrpos($contact_form['email-address'], '@')),
                    );
                
                $new_user = wp_insert_user($new_user_data);
            }

        }

    }

?>