<div class="calculator-wrapper">
	<form action="" id="calculatePrice" method="POST">
		<div class="container-fluid">
			<div class="row package-main-row">
				<div class="col-md-6">
					<div class="box-wrapper">
						<div class="calculator-tax-wrapper">
							<ul class="tabs tax-tabs tax-list">
								<?php 
								$terms = get_terms( array('taxonomy'   => 'calculator_tax', 'hide_empty' => false, 'parent' => 0) );
								if ( ! empty( $terms ) && is_array( $terms ) ):
								foreach($terms as $term):
								?>

								<li class="tab-link" data-tab="<?php echo $term->name; ?>"><?php echo $term->name; ?></li>
								<?php endforeach; endif; ?>
							</ul>
						</div>

						<div class="calculator-tabs-body-wrapper">

							<?php foreach($terms as $term): ?>
							<div id="<?php echo $term->name; ?>" class="tab-content custom-tabs-body">
								<?php 
								$mainarray = array(
									'post_type' => array('calculator'),
									'post_status' => array('publish'),
									'posts_per_page' => -1,
									'tax_query' => array(           
										array(
											'taxonomy' => 'calculator_tax',
											'field' => 'slug',
											'terms' => $term->slug,
										)
									),
								);
								$the_query = new WP_Query($mainarray);

								while ( $the_query->have_posts() ): $the_query->the_post();
								?>

								<div class="package-form-field">
									<label for="<?php echo 'CID' . get_the_ID(); ?>" class="package-form-label">
										<span class="option-title"><?php the_title(); ?></span>
										<span class="option-price">$<?php the_field('price'); ?></span>
									</label>
									<input type="checkbox" id="<?php echo 'CID' . get_the_ID(); ?>" name="items_for_cons[]" value="<?php echo get_the_title() .'+'. get_field('price'); ?>" data-price="<?php the_field('price'); ?>" data-title="<?php the_title();?>" data-unique="<?php echo 'Input' . get_the_ID(); ?>">
								</div>

								<?php endwhile; wp_reset_postdata(); ?>
							</div>
							<?php endforeach; ?>

						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="total-calculation">
						<h4>Selected Services and Total Prices</h4>
						<p id="checkoutStatus"></p>
						<div class="calculation-table">
							<table id="calTable"></table>
							<hr class="sep">
							<table class="grand-total border-none">
								<tr>
									<td></td>
									<td class="gt-total">
										<label>Total Cost Of</label>
										<span id="grandTotalCost">$0.00</span>
									</td>
								</tr>
							</table>
						</div>
						<div id="getPersonalInfo" class="personal-info">
							<div class="row">
								<div class="col-md-6"><input type="text" name="first_name" id="userFname" placeholder="First Name" class="input-field" required></div>
								<div class="col-md-6"><input type="text" name="last_name" placeholder="Last Name" class="input-field" required></div>
								<div class="col-md-6"><input type="email" name="email_address" id="userEmail" placeholder="Email Address" class="input-field" required></div>
								<div class="col-md-6"><input type="tel" name="phone_number" id="userPhone" placeholder="Phone Name" class="input-field" required></div>
							</div>
						</div>
						<div class="book-now-btn">
							<input type="hidden" name="grand_total_hidden" value="">
							<input type="button" id="submitBtn" class="book-btn" value="Book Now">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>





<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery('ul.tabs li:first-child').addClass('current');
		jQuery('.calculator-tabs-body-wrapper > div:first-child').addClass('current');
		jQuery('li[data-tab=Specials]').text('Special Offers');
		jQuery('ul.tabs li').click(function(){
			var tab_id = jQuery(this).attr('data-tab');
			jQuery('ul.tabs li').removeClass('current');
			jQuery('.tab-content').removeClass('current');

			jQuery(this).addClass('current');
			jQuery("#"+tab_id).addClass('current');
		});
	})
</script>