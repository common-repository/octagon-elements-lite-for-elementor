<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! function_exists( 'octagon_woocommerce_template_loop_add_to_cart' ) ) {
	function octagon_woocommerce_template_loop_add_to_cart( $product = '', $options = [], $args = [] ) {

		/**
		 * To customize the 'woocommerce_template_loop_add_to_cart()' in shortcode
		 * template, just copied it from WooCommerce and modified.
		 *
		 * TODO: Needs to set the function with template, helps to overrides through theme.
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @return  mixed
		 * @see woocommerce_template_loop_add_to_cart() in 'woocommerce/includes/wc-template-functions.php'
		 */
		if( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
			}

			$btn_class   = array( 'btn btn-size-mini' );
			$btn_class[] = $options['btn_type'] ?? 'btn-type-solid-ellipse';
			$btn_class[] = $options['btn_color'] ?? 'btn-color-black';
			$btn_class[] = $options['gradient_palette'] ?? 'orange-pulp';

			echo sprintf( '<div class="product-btn"><a href="%s" data-quantity="%s" class="%s" data-view-cart="%s" %s>%s%s</a></div>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
				esc_attr( isset( $args['class'] ) ? $args['class'] .' '. implode( ' ', $btn_class ) : '' ),
				esc_attr__( 'View Cart', 'octagon-elements-lite-for-elementor' ),
				isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
				$product->supports( 'ajax_add_to_cart' ) ? '<div class="loader"><div></div></div>' : '',
				esc_html( $product->add_to_cart_text() )
			);
		}
	}
}
