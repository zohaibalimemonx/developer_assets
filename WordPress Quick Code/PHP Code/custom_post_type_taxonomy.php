<?php
	/** 
	 * Register Default Category/Taxonomy and Tag With Custom Post Type
	 * 
	 * taxonomy-{taxonomy}.php: 
	 * For example, if the taxonomy is named “sometax,” 
	 * WordPress would look for a file named taxonomy-sometax.php
	 * 
	 **/

function add_tags_categories() {
	
	register_taxonomy_for_object_type('category', 'POST_TYPE_SLUG');
	register_taxonomy_for_object_type('post_tag', 'POST_TYPE_SLUG');

}
	add_action('init', 'add_tags_categories');
?>


<?php 
	/** 
	 * Register Custom Category and Tag With Custom Post Type
	 **/
function prefix_taxonomy_name() {

	$labels = array(
		'name'                  => _x( 'Plural Name', 'Taxonomy Plural Name', 'text-domain' ),
		'singular_name'         => _x( 'Singular Name', 'Taxonomy Singular Name', 'text-domain' ),
		'search_items'          => __( 'Search Plural Name', 'text-domain' ),
		'popular_items'         => __( 'Popular Plural Name', 'text-domain' ),
		'all_items'             => __( 'All Plural Name', 'text-domain' ),
		'parent_item'           => __( 'Parent Singular Name', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent Singular Name', 'text-domain' ),
		'edit_item'             => __( 'Edit Singular Name', 'text-domain' ),
		'update_item'           => __( 'Update Singular Name', 'text-domain' ),
		'add_new_item'          => __( 'Add New Singular Name', 'text-domain' ),
		'new_item_name'         => __( 'New Singular Name Name', 'text-domain' ),
		'add_or_remove_items'   => __( 'Add or remove Plural Name', 'text-domain' ),
		'choose_from_most_used' => __( 'Choose from most used Plural Name', 'text-domain' ),
		'menu_name'             => __( 'Singular Name', 'text-domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'slug', array( 'POST_TYPE' ), $args );
}

add_action( 'init', 'prefix_taxonomy_name' );

?>

<!-- Print Custom Taxonomy On Page -->
<?php $terms = get_terms(array('taxonomy'   => 'CUSTOM_TAXONOMY_SLUG', 'hide_empty' => false, 'parent' => 0,)); ?>

<?php if ( ! empty( $terms ) && is_array( $terms ) ): ?> 
    
    <!-- Loop Through Each Taxonomy -->
    <?php foreach ( $terms as $term ): ?>
    
    <!-- Print Taxonomy's Custom Added Image -->
    <?php 
        $image_id = get_term_meta( $term->term_id, 'category_image', true ); 
        echo wp_get_attachment_image($image_id); 
    ?>

    <!-- Get Taxonomy's Permalink -->
    <?php echo esc_url( get_term_link( $term ) ); ?>
    
    <!-- Get Taxonomy's Name -->
    <?php echo $term->name; ?>

	<!-- Get Taxonomy's Post Count -->
	<?php echo $term->count; ?>

	<!-- Get Taxonomy's Slug -->
	<?php echo $term->slug; ?>

    <?php endforeach; ?>

<?php endif; ?>


<!-- Print Child Taxonomy On Click On Parent Taxonomy (FILE NAME = taxonomy-stressors-category.php) -->
<?php
    $tax = $wp_query->get_queried_object();

    $child_arg = array( 'hide_empty' => false, 'parent' => $tax->term_id );
    $child_cat = get_terms( 'stressors-category', $child_arg ); ?>

<?php if ($tax->parent == 0): ?>
	
    <ul class="custom-categories">
        <?php if ( ! empty( $child_cat ) && is_array( $child_cat ) ): ?> 
            <?php foreach ( $child_cat as $term ): ?>
            <li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo $term->name; ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
	
    <?php else: ?>

    <div class="row audiofiles">
    
        <?php    $q = new WP_Query(
            array(
                'post_type' => array('stressors'),
                'post_status' => array('publish'),
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => -1,
                'stressors-category' => $tax->slug
                )
            );
            
            while ($q->have_posts()) : $q->the_post(); 
            
                $uploads = json_decode( get_post_meta( get_the_ID(), 'audio_files', true ), true);
            
                if ($uploads): 
                    foreach ($uploads as $key1 => $value1): $thumbnail = wp_get_attachment_url($value1);  ?>
                        <div class="col-md-4">
                            <audio controls>
                        <source src="<?= $thumbnail; ?>" type="audio/mpeg">
                        Your browser does not support the audio tag.
                        </audio>
                        </div>
                    <?php endforeach ?>
                <?php endif;
                
            endwhile; 
        ?>
    </div>

<?php endif ?>


<?php

	/** 
	 * Add Image Form Into The Custom Taxonomy/Category With Custom Post Type
     * 
     * Get Image From Custom Taxonomy/Category = 
     * <?php 
     *      $image_id = get_term_meta( $term->term_id, 'category_image', true ); 
     *      echo wp_get_attachment_image($image_id); 
     * ?>
     * 
	 **/

if( ! class_exists( 'Showcase_Taxonomy_Images' ) ) {
  
	class Showcase_Taxonomy_Images {
   
		public function __construct() {}
    
		/**
     	* Initialize the class and start calling our hooks and filters
     	*/
		public function init() {

			add_action( 'TAXONOMY-CATEGORY-SLUG_add_form_fields', array( $this, 'add_category_image' ), 10, 2 );
			add_action( 'created_TAXONOMY-CATEGORY-SLUG', array( $this, 'save_category_image' ), 10, 2 );
			add_action( 'TAXONOMY-CATEGORY-SLUG_edit_form_fields', array( $this, 'update_category_image' ), 10, 2 );
			add_action( 'edited_TAXONOMY-CATEGORY-SLUG', array( $this, 'updated_category_image' ), 10, 2 );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
			add_action( 'admin_footer', array( $this, 'add_script' ) );
		
		}

		public function load_media() {
		
			if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'developer' || $_GET['taxonomy'] != 'development') {
				return;
			}
		
			wp_enqueue_media();
		}

		/**
		* Add a form field in the new category page
		* @since 1.0.0
		*/
		public function add_category_image( $taxonomy ) { ?>

			<div class="form-field term-group">
				<label for="developer_image_id"><?php _e( 'Image', 'showcase' ); ?></label>
				<input type="hidden" id="developer_image_id" name="developer_image_id" class="custom_media_url" value="">
				<div id="category-image-wrapper"></div>
				<p>
					<input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e( 'Add Image', 'showcase' ); ?>" />
					<input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e( 'Remove Image', 'showcase' ); ?>" />
				</p>
			</div>
   		<?php 
		}

		/**
		* Save the form field
		* @since 1.0.0
		*/
		public function save_category_image( $term_id, $tt_id ) {
			if( isset( $_POST['developer_image_id'] ) && '' !== $_POST['developer_image_id'] ){
				add_term_meta( $term_id, 'category_image', absint( $_POST['developer_image_id'] ), true );
			}
		}

		/**
		 * Edit the form field
		 * @since 1.0.0
		 */
		public function update_category_image( $term, $taxonomy ) { ?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="developer_image_id"><?php _e( 'Image', 'showcase' ); ?></label>
				</th>
				<td>
					<?php $image_id = get_term_meta( $term->term_id, 'category_image', true ); ?>
					<input type="hidden" id="developer_image_id" name="developer_image_id" value="<?php echo esc_attr( $image_id ); ?>">
					<div id="category-image-wrapper">
						<?php if( $image_id ) { ?>
						<?php echo wp_get_attachment_image( $image_id, 'medium' ); ?>
						<?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e( 'Add Image', 'showcase' ); ?>" />
						<input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e( 'Remove Image', 'showcase' ); ?>" />
					</p>
				</td>
			</tr>
		<?php }

		/**
		* Update the form field value
		* @since 1.0.0
		*/
   		public function updated_category_image( $term_id, $tt_id ) {

			if( isset( $_POST['developer_image_id'] ) && '' !== $_POST['developer_image_id'] )
			{
				update_term_meta( $term_id, 'category_image', absint( $_POST['developer_image_id'] ) );
			} 
			else 
			{
				update_term_meta( $term_id, 'category_image', '' );
			}
  		}
		
		 /**
		* Enqueue styles and scripts
		* @since 1.0.0
		*/
   		public function add_script() {
			
			if(!isset( $_GET['taxonomy'] )) {
				return;
			}?>

     		<script type="text/javascript"> 
				jQuery(document).ready( function($) {
				
					_wpMediaViewsL10n.insertIntoPost = '<?php _e( "Insert", "showcase" ); ?>';
					
					function ct_media_upload(button_class) {
						var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
						$('body').on('click', button_class, function(e) {
							var button_id = '#'+$(this).attr('id');
							var send_attachment_bkp = wp.media.editor.send.attachment;
							var button = $(button_id);
							_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
								if( _custom_media ) 
								{
									$('#developer_image_id').val(attachment.id);
									$('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
									$( '#category-image-wrapper .custom_media_image' ).attr( 'src',attachment.url ).css( 'display','block' );
								} 
								else 
								{
									return _orig_send_attachment.apply( button_id, [props, attachment] );
								}
							}
           					wp.media.editor.open(button); return false;
        				});
       				}
       				ct_media_upload('.showcase_tax_media_button.button');
					$('body').on('click','.showcase_tax_media_remove',function(){
						$('#developer_image_id').val('');
						$('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
					});
       				// Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
					$(document).ajaxComplete(function(event, xhr, settings) {
						var queryStringArr = settings.data.split('&');
						if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
							var xml = xhr.responseXML;
							$response = $(xml).find('term_id').text();
							if($response!=""){
								// Clear the thumb image
								$('#category-image-wrapper').html('');
							}
						}
					});
      			});
    		</script>
   		<?php }

	}

	$Showcase_Taxonomy_Images = new Showcase_Taxonomy_Images();
	$Showcase_Taxonomy_Images->init();

}

?>


<?php  

	// This is the Query for calling current categories data in it's archive with paginaiton
	// Custom Taxonomy

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$tax = $wp_query->get_queried_object();
		$mainarray = array(
			'post_type' => array('POST_TYPE'),
			'tax_query' => array(             
				array(
					'taxonomy' => 'CUSTON_TAXONOMY_SLUG',
					'field' => 'slug',
					'terms' => $tax->slug,
				)),
			'post_status' => array('publish'),
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 9,
			'paged'       => $paged,
		);
	$q = new WP_Query($mainarray);
?>

<?php  

	/** 
	 * This Code Will Get/Print the Posts From Custom TAXONOMY's(CUSTOM_TAXONIMY_SLUG) Specific Taxomony/Category(SPECIFIC_TAXONOMY_ID)
	**/

    $terms = get_term_by('id', SPECIFIC_TAXONOMY_ID, 'CUSTOM_TAXONIMY_SLUG');   
    $mainarray = array(
        'post_type' => array('CUSTOM_POST_TYPE'),
        'post_status' => array('publish'),
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 9,
        'tax_query' => array(             
			array(
				'taxonomy' => 'CUSTOM_TAXONIMY_SLUG',
				'field' => 'slug',
				'terms' => $terms->slug,
			)
		),
    );
    $q = new WP_Query($mainarray);
?>