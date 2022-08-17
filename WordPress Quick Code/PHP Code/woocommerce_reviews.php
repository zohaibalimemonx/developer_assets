<?php
$comment_id = wp_insert_comment( array(
    'comment_post_ID'      => 37, // <=== The product ID where the review will show up
    'comment_author'       => 'LoicTheAztec',
    'comment_author_email' => 'loictheaztec@fantastic.com', // <== Important
    'comment_author_url'   => '',
    'comment_content'      => 'content here',
    'comment_type'         => 'review',
    'comment_parent'       => 0,
    'user_id'              => 5, // <== Important
    'comment_author_IP'    => '',
    'comment_agent'        => '',
    'comment_date'         => date('Y-m-d H:i:s'),
    'comment_approved'     => 1,
) );

// HERE inserting the rating (an integer from 1 to 5)
update_comment_meta( $comment_id, 'rating', 3 );