/*
    GOOGLE reCaptcha v2
*/

#STEP 1: Add Script Into Header OR Footer

<?php wp_enqueue_script( 'google-captcha-js', 'https://www.google.com/recaptcha/api.js', array(), '1.0', true ); ?>

#STEP 2: Add Into Custom Form + SITE_KEY

<div class="g-recaptcha" data-sitekey="COPY_SITE_KEY"></div>

#STEP 3: Add PHP Code + SECRET_KEY

<?php   
    if( $_POST['g-recaptcha-response'] == "" )
    {
        $ajax['message'] = 'reCAPTCHA Error!';
        $ajax['status'] = false;
        
        print(json_encode($ajax));
        exit();
    }

    $secret = 'COPY_SECRET_KEY';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);

    if ( !$responseData->success )
    {
        $ajax['message'] = 'reCAPTCHA Error!';
        $ajax['status'] = false;
        
        print(json_encode($ajax));
        exit();
    }
?>