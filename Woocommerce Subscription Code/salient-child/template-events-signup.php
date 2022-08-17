<?php /* Template Name: Events Signup Template */ get_header(); ?>
<?php  
    $datetime = new DateTime();
    $today = $datetime->format('Ymd');
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $mainarray = array(
        'post_type' => array('product'),
        'post_status' => array('publish'),
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_key' => 'event_due_date',
        'posts_per_page' => 9,
        'paged'       => $paged,
        'meta_query' => array(
            array(
                'key' => 'event_due_date',
                'value' => $today,
                'type' => 'numeric',
                'compare' => '>='
            )
        ),
        
    );
    $q = new WP_Query($mainarray);
?>



<section class="signup-events-section">
    
    <div class="events-page-title">
        <div class="container">
            <div class="entry-content">
                <h1>Events</h1>
            </div>
        </div>
    </div>

    <div class="signup-events-wrapper">
        <div class="container">
            <div class="row signup-events-row">
                <div class="col-md-12">
                    <div class="events-intro-title">
                        <h3>Latest Events</h3>
                    </div>
                    <div class="row event-product-grid">
                        <?php if( $q->have_posts() ): while ($q->have_posts()) : $q->the_post(); ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="event-product-card">
                                <div class="event-card-top">
                                    <div class="event-product-feature">
                                        <?php if (has_post_thumbnail()):  
                                		    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true);
                                		?>
                                			<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail[0]; ?>" alt="Picture" class="featured-image"></a>		
                                		<?php else: ?>
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo site_url('/wp-content/uploads/woocommerce-placeholder.png'); ?>" alt="Picture" class="featured-image"></a>
                                	    <?php endif; ?>
                                    </div>
                                </div>
                                <div class="p-event-card-top">
                                    <div class="p-event-date">
                                        <span>
                                            <?php 
                                                $event_date = get_field('event_due_date');
                                                $event_date_format = date("l, F j, Y", strtotime($event_date));
                                                echo $event_date_format;
                                            ?>
                                        </span>
                                    </div>
                                    <div class="p-event-title">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                    <div class="p-event-content">
                                        <p>
                                            <?php if( !empty( get_the_excerpt() ) ){
                                                    echo strip_tags(substr(get_the_excerpt(), 0, 200)) . '...';
                                                }
                                                else{
                                                    echo strip_tags(substr(get_the_content(), 0, 200)) . '...';
                                                } 
                                            ?>
                                        </p>
                                    </div>
                                    <div class="event-product-action-wrapper">
                                        <?php woocommerce_template_single_add_to_cart(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; else: ?>
                        <div class="col-lg-12"><h3>No Record Found!</h3></div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if( $q->have_posts() ): ?>
                    <div class="row custom-paging-row">
                        <div class="col-md-12">
                            <div class="text-center pagination">
                                <?php if (function_exists("pagination")) {
                                    pagination($q->max_num_pages);
                                } ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>

</section>

<?php echo do_shortcode('[wpsbx_html_block id=1492]'); get_footer(); ?>