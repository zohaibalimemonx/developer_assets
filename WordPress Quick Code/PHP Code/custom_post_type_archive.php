<?php 

/*
*   Create Custom Archive Page => archive-{post_type}.php
*/

/*
*   Enable Pagination Into Custom Archive Page
*/
function custom_posts_per_page( $query ) {

    if ( $query->is_archive('POST_TYPE_SLUG') ) {
        set_query_var('posts_per_page', -1);
    }
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );

?>

<!-- Get Post Type Archive Title -->
<?php echo post_type_archive_title( '', false ); ?>

<!-- Get Current Taxonomy Name/Title In Custom Taxonomy Archive -->
<?php single_term_title(); ?>

<!-- 
    PRINT ARCHIVE OF CUSTOM POST TYPE BY YEAR/MONTH/ETC 
    NOTE( It Worked Last Time 20/10/2021 - Need To Verify Again )

    JUST CHANGE UPPERCASE ( POST_TYPE ) IN $args[] 
-->
<?php

    $args = array(
        'post_type'    => 'POST_TYPE',
        'type'         => 'yearly',
        'echo'         => 0
    );
    function my_custom_post_type_archive_where($where,$args){  
        $post_type  = isset($args['post_type'])  ? $args['post_type']  : 'post';  
        $where = "WHERE post_type = '$post_type' AND post_status = 'publish'";
        return $where;  
    }
    add_filter( 'getarchives_where','my_custom_post_type_archive_where', 10, 2);
    
    echo '<ul>'.wp_get_archives($args).'</ul>';

    /*
    *   The Code Below Will Modify the Main WordPress Loop, Before the Queries Fired.
    *   Set Query Attributes For Certain Fired WP_Query() - Generaly Use On Archive Page
    */
    function industry_archive_posts_order($query)
    {
        if( !is_admin() && $query->is_post_type_archive('POST_TYPE') && $query->is_main_query() )
        {
            $query->set( 'orderby', 'menu_order' );
            $query->set( 'order', 'ASC' );
        }
    }
    add_action( 'pre_get_posts', 'industry_archive_posts_order' );

?>
