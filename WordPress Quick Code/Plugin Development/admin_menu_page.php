<?php 

/*
*   Print Current Page ID/Name
*/

    echo '<pre>';
    $screen = get_current_screen(); 
    print_r($screen);
    echo '</pre>';
?>