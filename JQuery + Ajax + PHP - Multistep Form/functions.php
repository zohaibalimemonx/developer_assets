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
    			'site_url' => site_url()
    		)
    	);
    }
}

if(!function_exists('insert_attachment')) {
	function insert_attachment($file_handler, $post_id, $setthumb=false) {

		if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) {
			return __return_false();
		}
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		$attach_id = media_handle_upload( $file_handler, $post_id );

		return $attach_id;
	}
}

class Custom_Multistep_Form{
    
    function __construct()
    {
        add_action( "wp_ajax_step1", array($this, 'step1'), 10 );
        add_action( "wp_ajax_nopriv_step1", array($this, 'step1'), 10 );
        
        add_action( "wp_ajax_step2", array($this, 'step2'), 10 );
        add_action( "wp_ajax_nopriv_step2", array($this, 'step2'), 10 );
        
        add_action( "wp_ajax_step3", array($this, 'step3'), 10 );
        add_action( "wp_ajax_nopriv_step3", array($this, 'step3'), 10 );
        
        add_action( "wp_ajax_step4", array($this, 'step4'), 10 );
        add_action( "wp_ajax_nopriv_step4", array($this, 'step4'), 10 );
        
        add_action( "wp_ajax_step5", array($this, 'step5'), 10 );
        add_action( "wp_ajax_nopriv_step5", array($this, 'step5'), 10 );
        
        add_action( "wp_ajax_one_step_back_func", array($this, 'one_step_back_func'), 10 );
        add_action( "wp_ajax_nopriv_one_step_back_func", array($this, 'one_step_back_func'), 10 );
    }
    
    function step1()
    {
        $_SESSION["step1"] = $_POST;
            
        ob_start();
        require get_stylesheet_directory() . '/backend-system/form-steps/step2.php';
        $html = ob_get_clean();
        
        $ajax['html'] = $html;
        $ajax['status'] = true;
        $ajax['old_session'] = ( !empty($_SESSION["step2"]) ) ? $_SESSION["step2"] : '';
        print(json_encode($ajax));
        exit();
    }
    
    function step2()
    {
        $_SESSION["step2"] = $_POST;
            
        ob_start();
        require get_stylesheet_directory() . '/backend-system/form-steps/step3.php';
        $html = ob_get_clean();
        
        $ajax['html'] = $html;
        $ajax['status'] = true;
        $ajax['old_session'] = ( !empty($_SESSION["step3"]) ) ? $_SESSION["step3"] : '';
        print(json_encode($ajax));
        exit();
    }
    
    function step3()
    {
        $_SESSION["step3"] = $_POST;
            
        ob_start();
        require get_stylesheet_directory() . '/backend-system/form-steps/step4.php';
        $html = ob_get_clean();
        
        $ajax['html'] = $html;
        $ajax['status'] = true;
        $ajax['old_session'] = $_SESSION["step4"];
        print(json_encode($ajax));
        exit();
    }
    
    function step4()
    {
        $_SESSION["step4"] = $_POST;
        
        if( !empty( $_SESSION['attach_id'] ) )
        {
            wp_delete_attachment( $_SESSION['attach_id'], true );
        }
        
        $attach_id = insert_attachment('csv_file',  rand(111111, 999999));
        $_SESSION['attach_id'] = $attach_id;
        
        ob_start();
        require get_stylesheet_directory() . '/backend-system/form-steps/step5.php';
        $html = ob_get_clean();
        $ajax['html'] = $html;
        $ajax['status'] = true;
        print(json_encode($ajax));
        exit();
    }
    
    function step5()
    {
        if( $_POST )
        {
            ob_start();
            require get_stylesheet_directory() . '/backend-system/form-steps/step1.php';
            $html = ob_get_clean();
            
            // STEP #1
            $full_name      = $_SESSION["step1"]["full_name"];
            $phone          = $_SESSION["step1"]["phone_number"];
            $email          = $_SESSION["step1"]["your_email"];
            $about_company  = $_SESSION["step1"]["about_your_business"];
            
            // STEP #2
            $have_domain    = $_SESSION["step2"]["registered_domain"];
            $have_domain_true = false;
            
            if( $have_domain == 'yes' )
            {
                $domain_name = $_SESSION["step2"]["domain_names"];
                $domain_date = $_SESSION["step2"]["registration_date"];
                $have_domain_true = true;
            }
            
            // STEP #3
            $have_trademark = $_SESSION["step3"]["trademark"];
            $have_trademark_true = false;
            
            if( $have_trademark == 'yes' )
            {
                $trademark_name = $_SESSION["step3"]["what_national_or_international_class_it_was_registered"];
                $trademark_date = $_SESSION["step3"]["trade_registration_date"];
                $have_trademark_true = true;
            }
            
            // STEP #4
            $evidence_note  = $_SESSION["step4"]["notes"];
            
            // STEP #5
            $query_def = $_POST["cancel_domain_name"];
            
            // HANDLE FILE
            
            $headers = array('Content-Type: text/html; charset=UTF-8');
            $subject = 'Notification: File A Domain Name Dispute';
            $message = '<html><body>';
            $message .= '<table>';
            
            
            $message .= '<tr><td><strong>Information About The Company</strong></td></tr>';
            $message .= '<tr><td></td></tr>';
            $message .= '<tr><td><strong>Name:</strong> '. $full_name .'</td></tr>';
            $message .= '<tr><td><strong>Phone:</strong> '. $phone .'</td></tr>';
            $message .= '<tr><td><strong>Email:</strong> '. $email .'</td></tr>';
            $message .= '<tr><td><strong>About Company:</strong> '. $about_company .'</td></tr>';
            
            $message .= '<tr><td><br></td></tr>';
            
            $message .= '<tr><td><strong>Company Domain Name Information</strong></td></tr>';
            $message .= '<tr><td></td></tr>';
            $message .= '<tr><td>Do you have your own registered domain names?</td></tr>';
            $message .= '<tr><td><strong>'. ucwords($have_domain) .'</strong></td></tr>';
            
            if( $have_domain_true )
            {
                $message .= '<tr><td><strong>Domain Details:</strong></td></tr>';
                $message .= '<tr><td>Domain Name: <strong>'. $domain_name .'</strong></td></tr>';
                $message .= '<tr><td>Registration Date: <strong>'. $domain_date .'</strong></td></tr>';
            }
            
            $message .= '<tr><td><br></td></tr>';
            
            $message .= '<tr><td><strong>Trademark Information</strong></td></tr>';
            $message .= '<tr><td></td></tr>';
            $message .= '<tr><td>Do you have the registered/unregistered trademarks?</td></tr>';
            $message .= '<tr><td><strong>'. ucwords($have_trademark) .'</strong></td></tr>';
            
            if( $have_trademark_true )
            {
                $message .= '<tr><td>Trademark Details:</td></tr>';
                $message .= '<tr><td>What International/National Class it was registered: <strong>'. $trademark_name .'</strong></td></tr>';
                $message .= '<tr><td>Registration Date: <strong>'. $trademark_date .'</strong></td></tr>';
            }
            
            $message .= '<tr><td><br></td></tr>';
            
            $message .= '<tr><td><strong>Evidence Of Violations Of Your Right</strong></td></tr>';
            $message .= '<tr><td></td></tr>';
            
            $message .= '<tr><td>Note & Attachment:</td></tr>';
            $message .= '<tr><td>'. $evidence_note .'</td></tr>';
            
            $message .= '<tr><td><br></td></tr>';
            
            $message .= '<tr><td><strong>Query Definition</strong></td></tr>';
            $message .= '<tr><td></td></tr>';
            
            $message .= '<tr><td>Would you like to cancel the domain name, which infringe your rights or simply transfer it for your disposition?</td></tr>';
            $message .= '<tr><td><strong>'. $query_def .'</strong></td></tr>';
            
            $attach_file = get_attached_file($_SESSION['attach_id']);
            $attachments = array($attach_file);
            
            $message .= "</table>";
            $message .= "</body></html>";
            wp_mail('zx.snowdrop@gmail.com', $subject,$message, $headers, $attachments);
            
            $ajax['html'] = $html;
            $ajax['status'] = true;
            $ajax['message'] = 'Thank you for submitting the form. Our team will reach out to you shortly. We look forward to helping you secure your brand.';
            $ajax['test'] = $attach_file;
            session_destroy();
            print(json_encode($ajax));
            exit();
        }
    }
    
    function one_step_back_func()
    {
        if( !empty( $_POST['step_no'] ) )
        {
            $step = (int)$_POST['step_no'];
            
            if( $step == 1 )
            {
                ob_start();
                require get_stylesheet_directory() . '/backend-system/form-steps/step1.php';
                $html = ob_get_clean();
                
                $ajax['status'] = true;
                $ajax['html'] = $html;
                $ajax['step_on'] = 1;
                $ajax['session_data'] = ( !empty($_SESSION["step1"]) ) ? $_SESSION["step1"] : '';
                print(json_encode($ajax));
                exit();
            }
            elseif( $step == 2 )
            {
                ob_start();
                require get_stylesheet_directory() . '/backend-system/form-steps/step2.php';
                $html = ob_get_clean();
                
                $ajax['status'] = true;
                $ajax['html'] = $html;
                $ajax['step_on'] = 2;
                $ajax['session_data'] = ( !empty($_SESSION["step2"]) ) ? $_SESSION["step2"] : '';
                print(json_encode($ajax));
                exit();
            }
            elseif( $step == 3 )
            {
                ob_start();
                require get_stylesheet_directory() . '/backend-system/form-steps/step3.php';
                $html = ob_get_clean();
                
                $ajax['status'] = true;
                $ajax['html'] = $html;
                $ajax['step_on'] = 3;
                $ajax['session_data'] = ( !empty($_SESSION["step3"]) ) ? $_SESSION["step3"] : '';
                print(json_encode($ajax));
                exit();
            }
            elseif( $step == 4 )
            {
                ob_start();
                require get_stylesheet_directory() . '/backend-system/form-steps/step4.php';
                $html = ob_get_clean();
                
                $ajax['status'] = true;
                $ajax['html'] = $html;
                $ajax['step_on'] = 4;
                $ajax['session_data'] = ( !empty($_SESSION["step4"]) ) ? $_SESSION["step4"] : '';
                print(json_encode($ajax));
                exit();
            }
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'No Such Step Found!';
            print(json_encode($ajax));
            exit();
        }
    }
}
new Custom_Multistep_Form();