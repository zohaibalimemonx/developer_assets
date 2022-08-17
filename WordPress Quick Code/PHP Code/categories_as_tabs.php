<ul class="tabs custom-tabs-head">
    
    <?php 
        $args = array(
            'hide_empty'=> 1,
            'orderby' => 'name',
            'order' => 'ASC'
        );

        $categories = get_categories($args);
        
        foreach($categories as $category):
    ?>

    <li class="tab-link" data-tab="<?php echo $category->name; ?>"><?php echo $category->name; ?></li>
    <?php $cat_name = $category->name; ?>
    <?php endforeach; ?>
</ul>

<div class="custom-tabs-body-wrapper">
    <?php foreach($categories as $category): ?>
        <div id="<?php echo $category->name; ?>" class="tab-content custom-tabs-body">
            <?php 
                $the_query = new WP_Query(array(
                    'post_type' => 'custom_book',
                    'posts_per_page' => 9,
                    'category_name' => $category->slug
                ));

                while ( $the_query->have_posts() ): $the_query->the_post();
            ?>
            
                <h1><?php the_title(); ?></h1>
            
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        
    <?php endforeach; ?>
</div>


<script type="text/javascript">
    jQuery(document).ready(function(){
    	
        jQuery('ul.tabs li:first-child').addClass('current');
		jQuery('.custom-tabs-body-wrapper > div:first-child').addClass('current');
        
        jQuery('ul.tabs li').click(function(){
            var tab_id = jQuery(this).attr('data-tab');
            jQuery('ul.tabs li').removeClass('current');
            jQuery('.tab-content').removeClass('current');

            jQuery(this).addClass('current');
            jQuery("#"+tab_id).addClass('current');
        })
    })
</script>