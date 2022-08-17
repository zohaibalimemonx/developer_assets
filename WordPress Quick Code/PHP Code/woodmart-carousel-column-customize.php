<?php 
    function woodmart_shortcode_info_box_carousel( $atts = array(), $content = null ) {
		$output = $class = $autoplay = '';

		$parsed_atts = shortcode_atts( array_merge( woodmart_get_owl_atts(), array(
			'slider_spacing' => 30,
			'dragEndSpeed' => 600,
			'el_class' => '',
		) ), $atts );

		extract( $parsed_atts );

		$class .= ' ' . $el_class;
		$class .= ' ' . woodmart_owl_items_per_slide( $slides_per_view );

		$carousel_id = 'carousel-' . rand(100, 999);

		$parsed_atts['carousel_id'] = $carousel_id;
		
        // MODIFY HERE - CUSTOM_CLASS_NAME_HERE
        if ( $el_class == 'CUSTOM_CLASS_NAME_HERE' ) {
			$parsed_atts['custom_sizes'] = array(
				'desktop' => 5,
				'tablet_landscape' => 3,
				'tablet' => 2,
				'mobile' => 1,
			);
		}

		$owl_atts = woodmart_get_owl_attributes( $parsed_atts );
		
		ob_start(); ?>
			<div id="<?php echo esc_attr( $carousel_id ); ?>" class="woodmart-carousel-container info-box-carousel-wrapper woodmart-carousel-spacing-<?php echo esc_attr( $slider_spacing ); ?>" <?php echo ( $owl_atts ); ?>>
				<div class="owl-carousel info-box-carousel<?php echo esc_attr( $class ); ?>" >
					<?php echo do_shortcode( $content ); ?>
				</div>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
	add_shortcode( 'woodmart_info_box_carousel', 'woodmart_shortcode_info_box_carousel' );