<?php

/**
 * Content Type
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.3
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( isset( $_POST['options'] ) ) {
	$options       = isset( $_POST['options'] ) ? array_map( 'sanitize_text_field', $_POST['options'] ) : [];
	$args          = isset( $_POST['args'] ) ? array_map( 'sanitize_text_field', $_POST['args'] ) : [];
	$args['paged'] = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : 0;
}
else {
	$settings      = $element->get_settings_for_display();
	$args          = $element->args;
	$args['paged'] = $element->paged;

	$options['style']                         = $settings['style'] ?? 'masonry';
	$options['title_tag']                     = $settings['title_tag'] ?? 'h3';
	$options['columns']                       = $settings['columns'] ?? 'col-md-4';
	$options['meta']                          = $settings['meta'] ?? 'category';
	$options['excerpt']                       = $settings['excerpt'] ?? 'show';
	$options['excerpt_limit']                 = $settings['excerpt_limit'] ?? '100';
	$options['dimension']                     = $settings['dimension'] ?? [ 'width'  => '700', 'height' => '500' ];
	$options['pagination']                    = $settings['pagination'] ?? 'none';
	$options['ex_class']                      = $settings['ex_class'] ?? '';	
	$options['show_btn']                      = $settings['show_btn'] ?? 'show';
	$options['btn_text']                      = $settings['btn_text'] ?? esc_html__( 'Read More', 'octagon-elements-lite-for-elementor' );
	$options['btn_size']                      = $settings['btn_size'] ?? 'btn-size-mini';
	$options['btn_type']                      = $settings['btn_type'] ?? 'btn-type-solid-ellipse';
	$options['btn_color']                     = $settings['btn_color'] ?? 'btn-color-black';
	$options['gradient_palette']              = $settings['gradient_palette'] ?? 'orange-pulp';
	$options['btn_icon']                      = $settings['btn_icon'] ?? '';
	$options['icon_position']                 = $settings['icon_position'] ?? 'left';
	$options['only_icon']                     = $settings['only_icon'] ?? '';
	$options['loadmore_btn_type']             = $settings['loadmore_btn_type'] ?? 'btn-type-solid-ellipse';
	$options['loadmore_btn_color']            = $settings['loadmore_btn_color'] ?? 'btn-color-black';
	$options['loadmore_btn_gradient_palette'] = $settings['loadmore_btn_gradient_palette'] ?? 'orange-pulp';
}

if( ! is_array( $options ) ) {
	return;
}

if( ! empty( $options ) ) {
	extract( $options );
}

if( ! is_array( $args ) || ! octagon_is_number( $args['paged'] ) ) {
	return;
}

$q = new WP_Query( $args );
$max = $q->max_num_pages;

if( $q->have_posts() ):

	?>
	<div class="octagon-elements content-type loop-container <?php echo esc_attr( $style ); ?>">
		
		<?php 
		if( 'masonry' == $style ) : 
			?>
			<div class="post-inner post-loop ajax-content-pull">

				<div class="isotope-item-sizer col-md-1"></div>

				<?php
				$post_count = 1;
				while( $q->have_posts() ):
					$q->the_post();

					$permalink = get_permalink();		
					?>

					<article <?php post_class( 'element post isotope-item '. $columns ); ?>>

						<div class="post-details">

							<?php
							if( has_post_thumbnail() ) :
								
								$width  = ! empty( $options['dimension']['width'] ) ? $options['dimension']['width'] : 700;
								$height = ! empty( $options['dimension']['height'] ) ? $options['dimension']['height'] : null;
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
				?>

			</div> <!-- .post-inner -->
			<?php
		elseif( 'post-content-overlap' == $style ) :
			?>
			<div class="post-inner post-loop ajax-content-pull">

				<?php
				$post_count = 1;
				while( $q->have_posts() ):
					$q->the_post();

					$permalink = get_permalink();		
					?>

					<article <?php post_class( 'element post' ); ?>>

						<div class="post-details">
							
							<?php
							if( has_post_thumbnail() ) :
								
								$width  = ! empty( $options['dimension']['width'] ) ? $options['dimension']['width'] : 1200;
								$height = ! empty( $options['dimension']['height'] ) ? $options['dimension']['height'] : 600;
								?>

								<div class="post-media">
									<?php echo octagon_get_cropped_image( '', $width, $height, false ); ?>
								</div> <!-- .post-media -->

								<?php 
							endif;
							?>

							<div class="post-content">

								<?php if( 'none' != $meta ) : ?>
									<div class="meta-group">
										<?php octagon_meta( $meta ); ?>
									</div> <!-- .meta-group -->
								<?php endif; ?>
								
								<?php
								the_title( '<'. octagon_title_tag( $title_tag ) .' class="title"><a href="'. esc_url( $permalink ) .'">', '</a></'. octagon_title_tag( $title_tag ) .'>' );

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
				?>

			</div> <!-- .post-inner -->
			<?php
		endif;
		
		$values = array( 
			'type'    => 'query', 
			'args'    => $args, 
			'options' => array_merge( $options, array( 'isotope' => true ) ),
			'max'     => $max,
			'ajax'    => 'octagon_content_type_loadmore'
		);
		echo octagon_pagination( $pagination, $values );
		?>

	</div> <!-- .content-type -->

	<?php

endif;