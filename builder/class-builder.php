<?php
/**
 *
 * @package Octagon Elements for Elementor
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

use \Elementor\Controls_Manager;
	
if( ! class_exists( 'OEE_Builder' ) ) {

	class OEE_Builder {

		public function __construct() {	

			add_action( 'elementor/elements/categories_registered', [ $this, 'add_widget_categories' ] );
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_style' ] );

			$this->add_elements_controls();
		}

		/**
		 * Enqueue Style
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public function add_widget_categories( $elements_manager ) {

			$elements_manager->add_category(
				'octagon',
				[
					'title' => esc_html__( 'Octagon Elements', 'plugin-name' ),
					'icon'  => 'fa fa-plug'
				]
			);
		}

		/**
		 * Enqueue Style
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public function enqueue_style() {

			/* ---------------------------------------------------------------------------
			 * CSS
			------------------------------------------------------------------------------ */

			wp_enqueue_style( 'octagon-builder', OEE_URL . 'builder/css/builder.css', [], '1.0', 'all' );
			wp_enqueue_style( 'octagon-frontend', OEE_URL . 'builder/css/icon-frontend.css', [], '1.0', 'all' );
		}

		/**
		 * Add additional controls in Elementor defaults elements
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public function add_elements_controls() {
			
			add_action( 'elementor/element/section/section_layout/before_section_end', function( $element, $args ) {

				$element->start_injection( [
					'at' => 'after',
					'of' => 'overflow',
				] );

				$element->add_control(
					'background_type',
					[
						'label'        => esc_html__( 'Background Type', 'octagon-elements-lite-for-elementor' ),
						'type'         => Controls_Manager::SELECT,
						'options'      => [
							'none'  => esc_html_x( 'Not Set', 'octagon-elements-lite-for-elementor' ),
							'light' => esc_html_x( 'Light', 'octagon-elements-lite-for-elementor' ),
							'dark'  => esc_html_x( 'Dark', 'octagon-elements-lite-for-elementor' )
						],
						'default'      => 'none',
						'prefix_class' => 'bg-type-'
					]
				);

				$element->end_injection();

			}, 10, 2 );
		}

	}

	new OEE_Builder;

}
