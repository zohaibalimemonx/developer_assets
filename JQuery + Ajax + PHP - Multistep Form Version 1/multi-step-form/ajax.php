<?php
    class cs_ajax
    {
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
        }
        
        // <! - - - STEP #1 - - - >
        function step1()
        {
            $_SESSION["step1"] = $_POST;
            
            ob_start();
            require CS_PATH.'/multi-step-form/form-steps/step2.php';
            $html = ob_get_clean();
            $ajax['html'] = $html;
            $ajax['status'] = true;
            
            print(json_encode($ajax));
            exit();
        }
        
        // <! - - - STEP #2 - - - >
        function step2()
        {
            $_SESSION["step2"] = $_POST;
            
            ob_start();
            require CS_PATH.'/multi-step-form/form-steps/step3.php';
            $html = ob_get_clean();
            $ajax['html'] = $html;
            $ajax['status'] = true;
            
            print(json_encode($ajax));
            exit();
        }
        
        // <! - - - STEP #3 - - - >
        function step3()
        {
            $_SESSION["step3"] = $_POST;
            
            ob_start();
            require CS_PATH.'/multi-step-form/form-steps/step4.php';
            $html = ob_get_clean();
            $ajax['html'] = $html;
            $ajax['status'] = true;
            
            print(json_encode($ajax));
            exit();
            
        }
        
        // <! - - - STEP #4 - - - >
        function step4()
        {
            $_SESSION["step4"] = $_POST;
            
            ob_start();
            require CS_PATH.'/multi-step-form/form-steps/step1.php';
            $html = ob_get_clean();
            $ajax['html'] = $html;
            $ajax['status'] = true;
            
            $headers = array('Content-Type: text/html; charset=UTF-8');
            $subject = "Interactive Form";
            $message = '<html><body>';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message = '<html><body>';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            
            foreach ($_SESSION['step1'] as $key => $value) {
                if(!empty($value)):
                $message .= "<tr style='background: #eee;'><td><strong>".ucwords(str_replace(array('_','-'), ' ', $key)).":</strong> </td><td>".$value."</td></tr>";
                endif;
            }
            foreach ($_SESSION['step2'] as $key => $value) {
                if(!empty($value)):
                $message .= "<tr style='background: #eee;'><td><strong>".ucwords(str_replace(array('_','-'), ' ', $key)).":</strong> </td><td>".$value."</td></tr>";
                endif;
            }
            foreach ($_SESSION['step3'] as $key => $value) {
                if(!empty($value)):
                $message .= "<tr style='background: #eee;'><td><strong>".ucwords(str_replace(array('_','-'), ' ', $key)).":</strong> </td><td>".$value."</td></tr>";
                endif;
            }
            foreach ($_SESSION['step4'] as $key => $value) {
                if(!empty($value)):
                $message .= "<tr style='background: #eee;'><td><strong>".ucwords(str_replace(array('_','-'), ' ', $key)).":</strong> </td><td>".$value."</td></tr>";
                endif;
            }
            
            $message .= "</table>";
            $message .= "</body></html>";
            $message .= "</table>";
            $message .= "</body></html>";
            wp_mail('developer@eseospace.com', $subject,$message, $headers);
            session_destroy();
            
            print(json_encode($ajax));
            exit();
        }
    }
    new cs_ajax();
?>