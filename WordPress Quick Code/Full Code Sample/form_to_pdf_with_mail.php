<?php
/*
    This is the Working Code of WordPress Form With PDF Generation and Send Mail To Certain Email Address
*/
    
    // PDF MAKER LIBRARY
    require 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    
    // Rental Agreement Form Submit

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

    // AJAX HIT FUNCTION

    add_action( "wp_ajax_rental_agreement_form", 'rental_agreement_form');
    add_action( "wp_ajax_nopriv_rental_agreement_form", 'rental_agreement_form');
    
    function rental_agreement_form(){
        
        // GET FORM DATA FROM AJAX-JQUERY
        $rental_agreement_form = $_POST;
		
		$post_id = rand(1,99);
		$attach_id = insert_attachment('signature',  $post_id);
        $attach_url = wp_get_attachment_url( $attach_id );
		
        $file_content = '';
            
        $file_content .= '<html><body>';
        $file_content .= '<center><h3>SAFETY AND LIABILITY TERMS AND CONDITIONS/RENTAL AGREEMENT</h3></center>';
        $file_content .= '<table rules="all" style="border-color:#666;width:100%" cellpadding="10">';
        
        foreach ($rental_agreement_form as $key => $value) {
            
            $file_content .= "<tr style='background: #eee;'><td><strong>".ucwords(str_replace(array('_','-'), ' ', $key))."</strong> </td><td>".$value."</td></tr>";
        }
        $file_content .= "<tr style='background: #eee;'><td><strong>".ucwords(str_replace(array('_','-'), ' ', 'signature'))."</strong> </td><td>".wp_get_attachment_image($attach_id, array('300', '300'))."</td></tr>";
        $file_content .= "</table>";
        $file_content .= "</body></html>";
        
        $file_name = get_stylesheet_directory().'/rental-agreement-form/docs/rental_agreement.pdf';
        
        $document = new Dompdf();
		$document->set_option('isRemoteEnabled', TRUE);
        $document->loadHtml($file_content);
        $document->setPaper('A4', 'portrait');
        $document->render();
        file_put_contents($file_name,$document->output());
		
        $attachments = array(get_stylesheet_directory().'/rental-agreement-form/docs/rental_agreement.pdf');
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $to = 'zx.snowdrop@gmail.com';
        $subject = "RENTAL AGREEMENT";
        $message = 'Rental Agreement PDF';
        wp_mail( $to, $subject, $message, $headers, $attachments );
        
        $ajax['status'] = true;
        print(json_encode($ajax));
        exit();
    }