<?php 

    add_action('wp_logout','ps_redirect_after_logout');
    function ps_redirect_after_logout(){
        wp_redirect( get_permalink( $std_page_id = 1488 ) );
        exit();
    }

?>