<?php
/* Template Name: Regulatory News */ 
get_header();

if($_GET){
	
	$terms = get_terms( 'regulatory-news-tax' ); 
	$all_slug = wp_list_pluck( $terms, 'slug' );
	
	$args = array(
		'post_type'         => array('regulatory-news'),
		'post_status'       => array('publish'),
		'orderby'           => 'date',
		'order'             => 'DESC',
		'posts_per_page'    => -1,
		'query_label'       => 'date_query_label',
		's' 			=>  $_GET['search_by_text'],
		'tax_query' => array(
			array(
				'taxonomy' => 'regulatory-news-tax',
				'terms' => !empty($_GET['search_by_category']) ? $_GET['search_by_category'] : $all_slug,
				'field' => 'slug',
			)
		)
	);
	
}else{
	
	$args = array(
		'post_type'         => array('regulatory-news'),
		'post_status'       => array('publish'),
		'orderby'           => 'date',
		'order'             => 'DESC',
		'posts_per_page'    => -1,
	);
}

$q = new WP_Query();

add_filter('posts_where', function ($where, $query) {

	$s_date = $_GET['search_date_start'];
	$e_date = date('Y-m-d 00:00:00', strtotime($_GET['search_date_end'] . ' +1 day'));
	
	$label = $query->query['query_label'] ?? '';
	if($label === 'date_query_label') {
	    global $wpdb;
		$where .= "AND post_date >= '$s_date' AND post_date <= '$e_date' ";
	}
	return $where;
}, 10, 2);

$q->query($args);
?>

<div class="col-md-12">
    <div class="news-search">
        <form action="" method="GET">
            <div class="search-field">
                <input type="text" name="search_by_text" value="<?php echo $_GET['search_by_text']; ?>" placeholder="Search Here">
            </div>
            <div class="search-field sf-date">
                <label>Select From: </label>
                <div class="search-dates">
                    <input type="date" name="search_date_start" value="<?php echo $_GET['search_date_start']; ?>"> <label>to</label> <input type="date" name="search_date_end" value="<?php echo $_GET['search_date_end']; ?>">
                </div>
            </div>
            <div class="search-field">
                <select name="search_by_category">
                    <option selected disabled>All Categories</option>
                    <?php 
                     $terms = get_terms(array('taxonomy'   => 'regulatory-news-tax', 'hide_empty' => false, 'parent' => 0));
                     if ( ! empty( $terms ) && is_array( $terms ) ):
                     foreach ( $terms as $term ): ?>
                        <option value="<?php echo $term->slug; ?>" <?php selected($_GET['search_by_category'],$term->slug); ?>><?php echo $term->name; ?></option>                    
                    <?php endforeach; endif; ?>
                    
                </select>
            </div>
            <div class="search-submit">
                <input type="submit">
            </div>
        </form>
    </div>
    
    <div class="regulatory-news-wrapper">
        <div class="row">
            <div class="col-md-12">
                <table class="table rn-table">
                    <thead>
                        <th>Date</th>
                        <th>Title</th>
                        <th>PDF</th>
                    </thead>
                    <tbody>
                        <?php
                            if($q->have_posts()):
                            while ($q->have_posts()) : $q->the_post();    
                        ?>
                        <tr>
                            <td class="date-tcol"><?php echo get_the_date('M d, Y'); ?></td>
                            <td class="title-tcol">
                                <span class="rn-title"><a href="<?php the_field('custom_link_for_this_post'); ?>"><?php the_title(); ?></a></span>
                                <span class="rn-cat">
									<?php
										$terms = wp_get_post_terms( get_the_ID(), 'regulatory-news-tax');
										foreach ( $terms as $term ) {
											echo "<span>".$term->name."</span>";
										}
									?>
								</span>
                            </td>
                            <td class="pdf-tcol">
								<?php
									$file = get_field('pdf_file');
									if( $file ): ?>
                                <a href="<?php echo $file['url']; ?>" target="_blank" download="download">
                                    <img src="<?php echo site_url() . '/wp-content/uploads/2022/02/download-pdf-img.png'; ?>">
                                </a>
								<?php endif; ?>
                            </td>
                        </tr>
                        <?php 
                            endwhile;
							else:
							echo "<tr><td colspan='3' style='text-align:center'>No such record found</td></tr>";
                            endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>