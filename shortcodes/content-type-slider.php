<?php

/**
 * Content Type Slider
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.3
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

$settings    = $element->get_settings_for_display();
$args        = $element->args;
$slider_data = $element->get_slider_data();

$style             = $settings['style'] ?? 'masonry';
$title_tag         = $settings['title_tag'] ?? 'h3';
$meta              = $settings['meta'] ?? 'category';
$excerpt           = $settings['excerpt'] ?? 'show';
$excerpt_limit     = $settings['excerpt_limit'] ?? '100';
$dimension         = $settings['dimension'] ?? [ 'width'  => '700', 'height' => '500' ];
$pagination        = $settings['pagination'] ?? 'none';
$ex_class          = $settings['ex_class'] ?? '';	
$show_btn          = $settings['show_btn'] ?? 'show';
$btn_text          = $settings['btn_text'] ?? esc_html__( 'Read More', 'octagon-elements-lite-for-elementor' );
$btn_size          = $settings['btn_size'] ?? 'btn-size-mini';
$btn_type          = $settings['btn_type'] ?? 'btn-type-solid-ellipse';
$btn_color         = $settings['btn_color'] ?? 'btn-color-black';
$gradient_palette  = $settings['gradient_palette'] ?? 'orange-pulp';
$btn_icon          = $settings['btn_icon'] ?? '';
$icon_position     = $settings['icon_position'] ?? 'left';
$only_icon         = $settings['only_icon'] ?? '';
$slider_pagination = $settings['slider_pagination'] ?? 'show';
$slider_navigation = $settings['slider_navigation'] ?? 'hide';

$q = new WP_Query( $args );

$slide_data = [];

if( $q->have_posts() ):

	$wrapper_attr = [];

	$wrapper_class[] = 'octagon-elements content-type-slider content-type-masonry masonry loop-container swiper-container';
	$wrapper_class[] = $style;
	$wrapper_class[] = $ex_class;

	$wrapper_attr[] = 'class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'"';
	$wrapper_attr[] = implode( ' ', $slider_data );
	?>

	<div <?php echo implode( ' ', $wrapper_attr ); ?>>
		
		<div class="content-type-posts post-inner post-loop no-isotope swiper-wrapper">
			<?php 
			if( 'masonry' == $style ) : 

				$post_count = 1;
				while( $q->have_posts() ):
					$q->the_post();

					$id = get_the_ID();
					$permalink = get_permalink();
					?>

					<article <?php post_class( 'element post swiper-slide' ); ?>>

						<div class="post-details">

							<?php
							if( has_post_thumbnail() ) :
								
								$width  = ! empty( $dimension['width'] ) ? $dimension['width'] : 700;
								$height = ! empty( $dimension['height'] ) ? $dimension['height'] : null;
								?>

								<div class="post-media">
									<?php echo octagon_get_cropped_image( '', $width, $height, false ); ?>
								</div> <!-- .post-media -->

								<?php 
							endif;
							?>

							<div class="post-content">

								<?php 
								if( 'none' != $meta ) : 
									?>
									<div class="meta-group">
										<?php octagon_meta( $meta ); ?>
									</div> <!-- .meta-group -->
									<?php 
								endif;

								the_title( '<'. octagon_title_tag( $title_tag ) .' class="title"><span class="line"></span><a href="'. esc_url( $permalink ) .'">', '</a></'. octagon_title_tag( $title_tag ) .'>' );

								if( 'show' == $excerpt ) :
									?>
									<p class="excerpt"><?php echo octagon_get_excerpt( $excerpt_limit ); ?></p>
									<?php 
								endif;

								if( 'show' == $show_btn ) :
									$btn_class   = array( 'btn' );
									$btn_class[] = $btn_size;
									$btn_class[] = $btn_type;
									$btn_class[] = $btn_color;
									$btn_class[] = $gradient_palette;
									?>
									<a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( implode( ' ', $btn_class ) ); ?>">
										<span>

											<?php 
											if( ! empty( $btn_icon['value'] ) && 'left' == $icon_position ) :
												\Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true' ] );
											endif;

											if( ! $only_icon ) :
												?>
												<span><?php echo esc_html( $btn_text ); ?></span>
												<?php 
											endif;

											if( ! empty( $btn_icon['value'] ) && 'right' == $icon_position ) :
												\Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true' ] );
											endif;
											?>
										</span>
									</a>
									<?php
								endif;
								?>

							</div> <!-- .post-content -->

						</div> <!-- .post-details -->

					</article> <!-- article -->

				<?php
				$post_count++; endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div> <!-- .content-type-posts -->
		
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

	</div> <!-- .content-type-slider -->

	<?php

endif;