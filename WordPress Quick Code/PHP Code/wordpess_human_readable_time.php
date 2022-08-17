<?php 
    // Time Function
    function time_ago( $type = 'post' ) {
        $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

        return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

    }

?>

<!-- Function Call -->
<?php echo time_ago(); ?>