<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

use \Elementor\Widget_Base;
	
if( ! class_exists( 'OEE_Widget_Base' ) ) {

	abstract class OEE_Widget_Base extends Widget_Base {

		/**
		 * Set render attributes.
		 * 
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @version  1.0 
		 * @since 1.0
		 * @access protected
		 */
		protected function set_render_attributes() {

			$settings = $this->get_settings_for_display();

			/**
			 * Returns render attributes array based on {module}_render_attribute
			 *
			 * @version  1.0 
			 * @since 1.0
			 * 
			 */
			$attributes = apply_filters( $this->get_name().'_render_attribute', [], $settings );

			// Add render attributes
			$this->add_render_attribute( $attributes );

			/**
			 * Render attributes based on {module}_render_attributes
			 *
			 * Fires before rendering elements content.
			 * 
			 * @version  1.0 
			 * @since 1.0
			 * 
			 */
			do_action( $this->get_name().'_render_attributes' );

		}

		/**
		 * Set live attributes.
		 *
		 * @version  1.0 
		 * @since 1.0
		 * @access protected
		 */
		protected function set_live_attributes() {

			/**
			 * Render attributes based on {module}_live_attributes
			 *
			 * Fires before rendering live template content.
			 * 
			 * @version  1.0 
			 * @since 1.0
			 * 
			 */
			do_action( $this->get_name().'_live_attributes' );
		}

		/**
		 * Return array.
		 *
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 * @return array
		 */
		public function get_array( $key = '' ) {

			$array = [
				'show' => [
					'show' => esc_html__( 'Show', 'octagon-elements-lite-for-elementor' ),
					'hide' => esc_html__( 'Hide', 'octagon-elements-lite-for-elementor' )
				],
				'enable' => [
					'enable'  => esc_html__( 'Enable', 'octagon-elements-lite-for-elementor' ),
					'disable' => esc_html__( 'Disable', 'octagon-elements-lite-for-elementor' )
				],
				'true' => [
					'true'  => esc_html__( 'True', 'octagon-elements-lite-for-elementor' ),
					'false' => esc_html__( 'False', 'octagon-elements-lite-for-elementor' )
				],
				'title_tag' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'p'    => 'P',
					'span' => 'Span'
				],
				'btn_size' => [
					'btn-size-mini'   => esc_html__( 'Mini', 'octagon-elements-lite-for-elementor' ),
					'btn-size-small'  => esc_html__( 'Small', 'octagon-elements-lite-for-elementor' ),
					'btn-size-medium' => esc_html__( 'Medium', 'octagon-elements-lite-for-elementor' ),
					'btn-size-large'  => esc_html__( 'Large', 'octagon-elements-lite-for-elementor' ),
					'btn-size-full'   => esc_html__( 'Full', 'octagon-elements-lite-for-elementor' )
				],
				'btn_type' => [
					'btn-type-solid-rect'      => esc_html__( 'Solid Rectangle', 'octagon-elements-lite-for-elementor' ),
					'btn-type-solid-round'     => esc_html__( 'Solid Round', 'octagon-elements-lite-for-elementor' ),
					'btn-type-solid-ellipse'   => esc_html__( 'Solid Ellipse', 'octagon-elements-lite-for-elementor' ),
					'btn-type-outline-rect'    => esc_html__( 'Outline Rectangle', 'octagon-elements-lite-for-elementor' ),
					'btn-type-outline-round'   => esc_html__( 'Outline Round', 'octagon-elements-lite-for-elementor' ),
					'btn-type-outline-ellipse' => esc_html__( 'Outline Ellipse', 'octagon-elements-lite-for-elementor' ),
					'btn-type-no-bg'           => esc_html__( 'No Background', 'octagon-elements-lite-for-elementor' ),
					'btn-type-simple'          => esc_html__( 'Simple', 'octagon-elements-lite-for-elementor' ),
					'btn-type-half-line'       => esc_html__( 'Half Line', 'octagon-elements-lite-for-elementor' ),
					'btn-type-line-collapse'   => esc_html__( 'Line Collapse', 'octagon-elements-lite-for-elementor' ),
					'btn-type-line-tr'         => esc_html__( 'Line Top Right', 'octagon-elements-lite-for-elementor' ),
					'btn-type-line-tl'         => esc_html__( 'Line Top Left', 'octagon-elements-lite-for-elementor' ),
					'btn-type-line-br'         => esc_html__( 'Line Bottom Right', 'octagon-elements-lite-for-elementor' ),
					'btn-type-line-bl'         => esc_html__( 'Line Bottom Left', 'octagon-elements-lite-for-elementor' )
				],
				'btn_color' => [
					'btn-color-black'            => esc_html__( 'Black', 'octagon-elements-lite-for-elementor' ),
					'btn-color-white'            => esc_html__( 'White', 'octagon-elements-lite-for-elementor' ),
					'btn-color-primary'          => esc_html__( 'Primary', 'octagon-elements-lite-for-elementor' ),
					'btn-color-gradient'         => esc_html__( 'Gradient', 'octagon-elements-lite-for-elementor' ),
					'btn-color-gradient-palette' => esc_html__( 'From Gradient Palette', 'octagon-elements-lite-for-elementor' )
				],
				'gradient_palette' => [
					'orange-pulp'      => esc_html__( 'Orange Pulp', 'octagon-elements-lite-for-elementor' ),
					'warm-flame'       => esc_html__( 'Warm Flame', 'octagon-elements-lite-for-elementor' ),
					'night-fade'       => esc_html__( 'Night Fade', 'octagon-elements-lite-for-elementor' ),
					'sunny-morning'    => esc_html__( 'Sunny Morning', 'octagon-elements-lite-for-elementor' ),
					'tempting-azure'   => esc_html__( 'Tempting Azure', 'octagon-elements-lite-for-elementor' ),
					'young-passion'    => esc_html__( 'Young Passion', 'octagon-elements-lite-for-elementor' ),
					'deep-blue'        => esc_html__( 'Deep Blue', 'octagon-elements-lite-for-elementor' ),
					'malibu-beach'     => esc_html__( 'Malibu Beach', 'octagon-elements-lite-for-elementor' ),
					'plum-plate'       => esc_html__( 'Plum Plate', 'octagon-elements-lite-for-elementor' ),
					'evarlasting-sky'  => esc_html__( 'Evarlasting Sky', 'octagon-elements-lite-for-elementor' ),
					'aqua-splash'      => esc_html__( 'Aqua Splash', 'octagon-elements-lite-for-elementor' ),
					'desert-hump'      => esc_html__( 'Desert Hump', 'octagon-elements-lite-for-elementor' ),
					'night-sky'        => esc_html__( 'Night Sky', 'octagon-elements-lite-for-elementor' ),
					'passionate-red'   => esc_html__( 'Passionate Red', 'octagon-elements-lite-for-elementor' ),
					'heavy-rain'       => esc_html__( 'Heavy Rain', 'octagon-elements-lite-for-elementor' ),
					'healthy-water'    => esc_html__( 'Healthy Water', 'octagon-elements-lite-for-elementor' ),
					'lily-meadow'      => esc_html__( 'Lily Meadow', 'octagon-elements-lite-for-elementor' ),
					'happy-memories'   => esc_html__( 'Happy Memories', 'octagon-elements-lite-for-elementor' ),
					'mountain-rock'    => esc_html__( 'Mountain Rock', 'octagon-elements-lite-for-elementor' ),
					'sea-shore'        => esc_html__( 'Sea Shore', 'octagon-elements-lite-for-elementor' ),
					'cheerful-caramel' => esc_html__( 'Cheerful Caramel', 'octagon-elements-lite-for-elementor' ),
					'spiky-naga'       => esc_html__( 'Spiky Naga', 'octagon-elements-lite-for-elementor' ),
					'love-kiss'        => esc_html__( 'Love Kiss', 'octagon-elements-lite-for-elementor' ),
					'lush'             => esc_html__( 'Lush', 'octagon-elements-lite-for-elementor' ),
					'landing-aircraft' => esc_html__( 'Landing Aircraft', 'octagon-elements-lite-for-elementor' ),
					'sand-strike'      => esc_html__( 'Sand Strike', 'octagon-elements-lite-for-elementor' ),
					'vicious-stance'   => esc_html__( 'Vicious Stance', 'octagon-elements-lite-for-elementor' ),
					'smart-indigo'     => esc_html__( 'Smart Indigo', 'octagon-elements-lite-for-elementor' ),
					'big-mango'        => esc_html__( 'Big Mango', 'octagon-elements-lite-for-elementor' ),
					'new-life'         => esc_html__( 'New Life', 'octagon-elements-lite-for-elementor' )
				],
				'pagination' => [
					'none'            => esc_html__( 'None', 'octagon-elements-lite-for-elementor' ),
					'loadmore'        => esc_html__( 'Loadmore', 'octagon-elements-lite-for-elementor' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'octagon-elements-lite-for-elementor' ),
					'number'          => esc_html__( 'Number', 'octagon-elements-lite-for-elementor' ),
					'next-prev'       => esc_html__( 'Next Previous', 'octagon-elements-lite-for-elementor' )
				],
				'order' => [
					'desc' => esc_html__( 'Descending Order', 'octagon-elements-lite-for-elementor' ),
					'asc'  => esc_html__( 'Ascending Order', 'octagon-elements-lite-for-elementor' )
				],
				'orderby' => [
					'date'          => esc_html__( 'Date', 'octagon-elements-lite-for-elementor' ),
					'ID'            => esc_html__( 'ID', 'octagon-elements-lite-for-elementor' ),
					'modified'      => esc_html__( 'Last Modified Date', 'octagon-elements-lite-for-elementor' ),
					'title'         => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
					'rand'          => esc_html__( 'Random Order', 'octagon-elements-lite-for-elementor' ),
					'post__in'      => esc_html__( 'Preserve ID Order', 'octagon-elements-lite-for-elementor' ),
					'post_name__in' => esc_html__( 'Preserve slug Order', 'octagon-elements-lite-for-elementor' )
				]
			];

			$array = apply_filters( 'octagon_get_array_lists', $array );

			return ! empty( $key ) && array_key_exists( $key, $array ) ? $array[$key] : false;
		}

	}

}
