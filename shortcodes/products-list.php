<?php

/**
 * Products List
 *
 * @package octagon-elements-lite-for-elementor/shortcodes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! octagon_woo_exists() ) {
	return;
}

$settings = $element->get_settings_for_display();
$args     = $element->args;

$style      = $settings['style'] ?? 'style1';
$title_tag  = $settings['title_tag'] ?? 'h3';
$show_thumb = $settings['show_thumb'] ?? 'show';
$ex_class   = $settings['ex_class'] ?? '';

$q = new WP_Query( $args );

if( $q->have_posts() ):

	$wrapper_class = array( 'octagon-elements products-list recent-products loop-container' );
	$wrapper_class[] = $style;
	$wrapper_class[] = $ex_class;

	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<?php 
		if( 'style1' == $style ) : 
			?>

			<ul class="products">

				<?php

				$post_count = 1;

				while( $q->have_posts() ):
					$q->the_post();

					global $product;

					$id = get_the_ID();
					$permalink = get_permalink();

					?>

					<li <?php wc_product_class( 'element' ); ?>>

						<div class="product-thumb">
							<?php echo octagon_get_cropped_image( '', 80, 80, false ); ?>
						</div>
						

						<div class="product-content">

							<?php the_title( '<'. octagon_title_tag( $title_tag ) .' class="title"><a href="'. esc_url( $permalink ) .'">', '</a></'. octagon_title_tag( $title_tag ) .'>' );
							?>

							<p class="price"><?php echo $product->get_price_html(); ?></p>
							
						</div> <!-- ..product-content -->

					</li> <!-- .element -->

				<?php
				$post_count++; endwhile;
				wp_reset_postdata();
				?>

			</ul> <!-- .products -->

			<?php
		endif;
		?>

	</div> <!-- .products-list -->

	<?php

endif;