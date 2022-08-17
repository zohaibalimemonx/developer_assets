<!-- LOOP FROM CUSTOM POST TYPE "TEAM" -->
<?php  
    $mainarray = array(
        'post_type' => array('TEAM'),
        'post_status' => array('publish'),
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
    );
    $q = new WP_Query($mainarray); 
?>

<!-- GRID OF TEAM MEMBERS -->
<div class="row">
	<?php while ($q->have_posts()) : $q->the_post(); ?>
	<div class="col-md-3 col-sm-6">
		<div class="team">
			<div class="team-featue">
				<?php if (has_post_thumbnail()):  
					$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true);
				?>
					<a href="#" class="team-profile-open">
						<img src="<?php echo $thumbnail[0]; ?>" alt="Picture" class="featured-image">
					</a>		
				<?php else: ?>
				<a href="#" class="team-profile-open">
					<img src="<?php echo site_url('/wp-content/uploads/2021/11/No_Profile_Image.png'); ?>" alt="Picture" class="featured-image">				</a>
				<?php endif; ?>
			</div>
			<div class="team-about">
				<h3 class="team-title"><a href="#" class="team-profile-open"><?php the_title(); ?></a></h3>
				<p class="team-position"><?php the_field('designation'); ?></p>
				<div class="team-content" style="display: none;">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
</div>

<!-- POPUP STRUCTURE FOR EACH TEAM PROFILE IN THE ABOVE GRID -->
<div class="mfp-hide popup-team">
    <section class="mfp-with-anim woodmart-promo-popup" style="background-color: #ffff;">
        <div class="row">
            <div class="col-md-12">
				<div class="row team-info-row row-0">
					<div class="col-md-3">
						<div class="popup-team-feature">
							<img src="">
						</div>
					</div>
					<div class="col-md-9">
						<h3 class="popup-team-title">
							<span class="popup-team-name"></span>
							<span class="popup-team-desig"></span>
						</h3>
						<p class="popup-team-content">
							
						</p>
					</div>
				</div>
            </div>
        </div>
    </section>
</div>

<!-- OPEN POPUP AND ATTACH EACH TEAM MEMBER'S INFO INTO IT -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery(document).on('click', '.team-profile-open', function(event) {
			event.preventDefault();
			
			var featuredImage = jQuery(this).closest('.team').find('img.featured-image').attr('src');
			var title = jQuery(this).closest('.team').find('.team-about .team-title').text();
			var position = jQuery(this).closest('.team').find('.team-about .team-position').text();
			var info = jQuery(this).closest('.team').find('.team-about .team-content').html();

			jQuery('.team-info-row .popup-team-feature img').attr('src', featuredImage);
			jQuery('.team-info-row .popup-team-title .popup-team-name').text(title);
			jQuery('.team-info-row .popup-team-desig').text(position);
			jQuery('.team-info-row .popup-team-content').html(info);
			
			jQuery(this).magnificPopup({
				items: {
					src: '.popup-team',
					type: 'inline'
				},
				fixedContentPos: true,
				callbacks: {
					beforeOpen: function() { jQuery('html').addClass('mfp-helper'); },
					close: function() { jQuery('html').removeClass('mfp-helper'); }
				}
			}).magnificPopup('open');

		}); //click ends here	
	});
</script>