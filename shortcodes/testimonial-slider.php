<?php

/**
 * Testimonial Slider
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$settings    = $element->get_settings_for_display();
$args        = $element->args;
$slider_data = $element->get_slider_data();

$style             = $settings['style'] ?? 'style1';
$show_thumb        = $settings['show_thumb'] ?? 'show';
$show_name         = $settings['show_name'] ?? 'show';
$show_job          = $settings['show_job'] ?? 'show';
$show_rating       = $settings['show_rating'] ?? 'show';
$title_tag         = $settings['title_tag'] ?? 'p';
$excerpt_limit     = $settings['excerpt_limit'] ?? 100;
$ex_class          = $settings['ex_class'] ?? '';
$slider_pagination = $settings['slider_pagination'] ?? 'show';
$slider_navigation = $settings['slider_navigation'] ?? 'hide';

$q = new WP_Query( $args );

$slide_data = [];

if( $q->have_posts() ):

	$wrapper_attr = [];

	$wrapper_class[] = 'octagon-elements testimonial-slider swiper-container';
	$wrapper_class[] = $style;

	$wrapper_attr[] = 'class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'"';
	$wrapper_attr[] = implode( ' ', $slider_data );
	?>

	<div <?php echo implode( ' ', $wrapper_attr ); ?>>
		
		<div class="testimonial-posts swiper-wrapper">
		<?php 
		if( 'classic' == $style ) : 

			$post_count = 1;
			while( $q->have_posts() ):
				$q->the_post();

				$id = get_the_ID();	
				$permalink = get_permalink();		
				?>

				<article <?php post_class( 'swiper-slide' ); ?>>

					<p class="excerpt"><?php echo octagon_get_excerpt( $excerpt_limit ); ?></p>
						
					<?php if( has_post_thumbnail() && 'show' == $show_thumb ) : ?>

						<div class="avatar">
							<?php echo wp_kses( octagon_get_cropped_image( '', 80, 80 ), array( 'img' => array( 'src' => [], 'alt' => [] ) ) ); ?>
						</div>

					<?php endif;

					if( 'show' == $show_name ) :
						the_title( '<'. octagon_title_tag( $title_tag ) .' class="client-name sub-title">', '</'. octagon_title_tag( $title_tag ) .'>' );
					endif;

					$job = octagon_first_term( $id, 'octagon_testimonial_job' );
					if( ! empty( $job ) && 'show' == $show_job ) {
						printf( '<p class="client-job sub-title">%s</p>', esc_html( $job['name'] ) );
					}

					$rating = octagon_get_meta( $id, 'client_rating', '5' );

					$rating_icon = '';
					for( $i=1; $i<=5; $i++ ) {
						$star_class = ( $i <= (int)$rating ) ? 'oct-basic-star-filled' : 'oct-basic-star';
						$rating_icon .= '<span class="'. esc_attr( $star_class ) .'"></span>';						
					}

					if( 'show' == $show_rating ) :
						?>
						<p class="rating"><?php echo wp_kses( $rating_icon, array( 'span' => array( 'class' => [] ) ) ); ?></p>
						<?php
					endif; ?>

				</article> <!-- article -->

			<?php
			$post_count++; endwhile;
			wp_reset_postdata();
		endif;
		?>
		</div>
		
		<?php 
		if( 'show' == $slider_pagination ) : 
			?>
			<div class="swiper-pagination"></div>
			<?php 
		endif; 

		if( 'show' == $slider_navigation ) : 
			?>
			<div class="swiper-button-next"></div>
    		<div class="swiper-button-prev"></div>
		    <?php 
		endif;
		?>

	</div> <!-- .testimonial-slider -->

	<?php

endif;