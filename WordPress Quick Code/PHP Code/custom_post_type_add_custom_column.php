<?php

/* > > > Add Custom Column Into Custom Post Type < < < */

add_filter( 'manage_POST_TYPE_NAME_HERE_posts_columns', 'coniferwellness_filter_posts_columns' );
function coniferwellness_filter_posts_columns( $columns )
{
    // $columns['KEY_HERE'] = __( 'COLUMN_LABEL_HERE', 'THEME_TEXT_DOMAIN' );
    $columns['team_role'] = __( 'Team Role' );

    return $columns;
}

add_action( 'manage_POST_TYPE_NAME_HERE_posts_custom_column', 'coniferwellness_team_column_meta', 10, 2 );
function coniferwellness_team_column_meta( $column, $post_id )
{
    // CONDITION FOR MATCHING COLUMNS - if( 'KEY_HERE' === $column )
    
    if( 'team_role' === $column )
    {
        $terms = get_the_terms( $post_id, 'team-member-role' );
        if ( !empty( $terms ) && is_array( $terms ) )
        {
            foreach ( $terms as $term )
            {
                $x[] = $term->name;
            }
            
            echo implode(', ', $x);
        }
    }
}