<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.1
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core_Custom_CSS' ) ) {
	return;
}

$primary_color    = get_option( 'oee_primary_color', false );

echo '.btn.btn-type-outline-rect.btn-color-primary,
	.btn.btn-type-outline-round.btn-color-primary,
	.btn.btn-type-outline-ellipse.btn-color-primary,
	.btn.btn-type-no-bg.btn-color-primary,
	.btn.btn-type-simple.btn-color-primary,
	.btn.btn-type-half-line.btn-color-primary,
	.btn.btn-type-line-collapse.btn-color-primary,
	.btn.btn-type-line-tr.btn-color-primary,
	.btn.btn-type-line-tl.btn-color-primary,
	.btn.btn-type-line-br.btn-color-primary,
	.btn.btn-type-line-bl.btn-color-primary,
	.pagination ul li .current,
	.product-icons li a {';

	echo 'color: '. esc_html( $primary_color ) .';';

echo '}';


echo '.btn.btn-type-solid-rect.btn-color-primary,
	.btn.btn-type-solid-round.btn-color-primary,
	.btn.btn-type-solid-ellipse.btn-color-primary,
	.btn.btn-type-half-line.btn-color-primary:after,
	.btn.btn-type-line-collapse.btn-color-primary:after,
	.btn.btn-type-line-tr.btn-color-primary:before,
	.btn.btn-type-line-tl.btn-color-primary:before,
	.btn.btn-type-line-br.btn-color-primary:before,
	.btn.btn-type-line-bl.btn-color-primary:before,
	.btn.btn-type-line-tr.btn-color-primary:after,
	.btn.btn-type-line-tl.btn-color-primary:after,
	.btn.btn-type-line-br.btn-color-primary:after,
	.btn.btn-type-line-bl.btn-color-primary:after,
	.swiper-pagination-bullet,
	.style2 .products .product .product-loop-footer .product-btn a:before {';

	echo 'background: '. esc_html( $primary_color ) .';';

echo '}';

