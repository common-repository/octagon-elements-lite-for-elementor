<?php

/**
 * Team Slider
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
$title_tag         = $settings['title_tag'] ?? 'p';
$show_job          = $settings['show_job'] ?? 'show';
$ex_class          = $settings['ex_class'] ?? '';
$slider_pagination = $settings['slider_pagination'] ?? 'show';
$slider_navigation = $settings['slider_navigation'] ?? 'hide';

$q = new WP_Query( $args );

$slide_data = [];

if( $q->have_posts() ):

	$wrapper_attr = [];

	$wrapper_class[] = 'octagon-elements team-slider team swiper-container';
	$wrapper_class[] = $style;
	$wrapper_class[] = $ex_class;

	$wrapper_attr[] = 'class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'"';
	$wrapper_attr[] = implode( ' ', $slider_data );
	?>

	<div <?php echo implode( ' ', $wrapper_attr ); ?>>
		
		<div class="team-posts post-inner post-loop swiper-wrapper">
			<?php 
			if( 'classic' == $style ) : 

				$post_count = 1;
				while( $q->have_posts() ):
					$q->the_post();

					$id = get_the_ID();

					$class[] = 'member';
					$class[] = 'swiper-slide';
					?>

					<article <?php post_class( $class ); ?>>

						<div class="post-details">

							<div class="team-thumbnail">

								<?php echo octagon_get_cropped_image( '', 720, 800, true ); ?>

							</div> <!-- .team-thumbnail -->

							<div class="post-content">
								
								<div class="content-group">
									<?php 
									the_title( '<'. octagon_title_tag( $title_tag ) .' class="title">', '</'. octagon_title_tag( $title_tag ) .'>' );

									if( 'show' == $show_job ) :
										?>
										<div class="meta-group">
											<?php
											$term = octagon_first_term( $id, 'octagon_member_job' );

											if( ! empty( $term ) ) :
												?>
												<p class="category"><?php echo esc_html( $term['name'] ); ?></p>
												<?php 
											endif;
											?>
										</div> <!-- .meta-group -->
										<?php 
									endif;
									?>
									
								</div> <!-- .content-group -->
								
							</div> <!-- .post-content -->

						</div> <!-- .post-details -->

					</article> <!-- article -->

				<?php
				$post_count++; endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div> <!-- .team-posts -->
		
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

	</div> <!-- .team-slider -->

	<?php

endif;