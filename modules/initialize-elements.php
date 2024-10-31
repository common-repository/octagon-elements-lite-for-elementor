<?php

/**
 *
 * @package octagon-elements-lite-for-elementor/modules
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.4
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

use \Elementor\Plugin as Plugin;

if( ! class_exists( 'OEE_Init_Elements' ) ) {

	class OEE_Init_Elements {

		/**
		 * Store active modules list
		 *
		 * @since 1.0
		 * @access public
		 * @var array
		 */
		public static $active_modules = [];
		
		/**
		 * Constructor.
		 * 
		 * @version  1.0 
		 * @since  1.0
		 *
		 */
		public function __construct(){

			self::active_modules_list();

			add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_elements' ] );
		}
		
		/**
		 * Initialize elements
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @return array
		 */
		public function init_elements() {
			
			$this->load_required_files();
			$this->register_elements();

		}
		
		/**
		 * Load required elements modules
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @return mixed
		 */
		public function load_required_files() {
			
			include_once OEE_PATH . '/includes/class-widget-base.php';

			if( ! empty( self::$active_modules ) ) {
				foreach( self::$active_modules as $key => $module ) {

					$path = $this->get_file_path( $module );

					if( $path ) {
						require_once( $path );
					}
				}
			}

		}
		
		/**
		 * Register elements
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @return mixed
		 */
		public function register_elements() {

			$widgets_manager = Plugin::instance()->widgets_manager;

			if( ! empty( self::$active_modules ) ) {
				foreach( self::$active_modules as $key => $module ) {

					$class = $this->get_module_class( $module );

					if( class_exists( $class ) ) {
						$widgets_manager->register_widget_type( new $class() );
					}

				}
			}

		}

		/**
		 * Get modules list
		 * 
		 * @version  1.4
		 * @since  1.0
		 * @return array
		 */
		public static function modules_list() {

			$modules = apply_filters( 'octagon_modules_list', array(
				esc_html__( 'General', 'octagon-elements-lite-for-elementor' ) => array(				
					'advance-button'      => esc_html__( 'Advance Button', 'octagon-elements-lite-for-elementor' ),
					'advance-counter'     => esc_html__( 'Advance Counter', 'octagon-elements-lite-for-elementor' ),
					'gradient-text'       => esc_html__( 'Gradient Text', 'octagon-elements-lite-for-elementor' ),
					'image-box'           => esc_html__( 'Image Box', 'octagon-elements-lite-for-elementor' ),
					'icon-box'            => esc_html__( 'Icon Box', 'octagon-elements-lite-for-elementor' ),
					'image-mask'          => esc_html__( 'Image Mask', 'octagon-elements-lite-for-elementor' ),
					'info-icons'          => esc_html__( 'Info Icons', 'octagon-elements-lite-for-elementor' ),
					'cards'               => esc_html__( 'Cards', 'octagon-elements-lite-for-elementor' ),
					'timeline'            => esc_html__( 'Timeline', 'octagon-elements-lite-for-elementor' ),
					'video-popup'         => esc_html__( 'Video Popup', 'octagon-elements-lite-for-elementor' ),
					'social-icons'        => esc_html__( 'Social Icons', 'octagon-elements-lite-for-elementor' ),
					'image-compare'       => esc_html__( 'Image Compare', 'octagon-elements-lite-for-elementor' ),
					'login-register-form' => esc_html__( 'Login & Register Form', 'octagon-elements-lite-for-elementor' ),
					'gallery-block'       => esc_html__( 'Gallery Block', 'octagon-elements-lite-for-elementor' )
				),
				esc_html__( 'Content Post Types', 'octagon-elements-lite-for-elementor' ) => array(
					'content-type'            => esc_html__( 'Content Type', 'octagon-elements-lite-for-elementor' ),
					'content-type-list'       => esc_html__( 'Content Type List', 'octagon-elements-lite-for-elementor' ),
					'content-type-slider'     => esc_html__( 'Content Type Slider', 'octagon-elements-lite-for-elementor' ),
					'portfolio'               => esc_html__( 'Portfolio', 'octagon-elements-lite-for-elementor' ),
					'portfolio-slider'        => esc_html__( 'Portfolio Slider', 'octagon-elements-lite-for-elementor' ),
					'portfolio-extend-slider' => esc_html__( 'Portfolio Extend Slider', 'octagon-elements-lite-for-elementor' ),
					'team'                    => esc_html__( 'Team', 'octagon-elements-lite-for-elementor' ),
					'team-slider'             => esc_html__( 'Team Slider', 'octagon-elements-lite-for-elementor' ),
					'testimonial-slider'      => esc_html__( 'Testimonial Slider', 'octagon-elements-lite-for-elementor' )
				),
				esc_html__( 'Header and Footer', 'octagon-elements-lite-for-elementor' ) => array(				
					'logo'            => esc_html__( 'Logo', 'octagon-elements-lite-for-elementor' ),
					'navigation-menu' => esc_html__( 'Navigation Menu', 'octagon-elements-lite-for-elementor' )
				),
				esc_html__( 'WooCommerce', 'octagon-elements-lite-for-elementor' ) => array(
					'products'            => esc_html__( 'Products', 'octagon-elements-lite-for-elementor' ),
					'products-slider'     => esc_html__( 'Products Slider', 'octagon-elements-lite-for-elementor' ),
					'products-list'       => esc_html__( 'Products List', 'octagon-elements-lite-for-elementor' ),
					'compare-products'    => esc_html__( 'Compare Products', 'octagon-elements-lite-for-elementor' ),
					'wishlist'            => esc_html__( 'Wishlist', 'octagon-elements-lite-for-elementor' ),
					'ajax-product-search' => esc_html__( 'Ajax Product Search', 'octagon-elements-lite-for-elementor' )
				)
			) );

			return $modules;
		}
		
		/**
		 * Set active modules list
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @return array
		 */
		public static function active_modules_list() {

			self::$active_modules = get_option( 'oee_modules', [] );

			return self::$active_modules;

		}
		
		/**
		 * Get file path based on modules
		 * 
		 * @version  1.4 
		 * @since  1.0
		 * @return mixed
		 */
		public function get_file_path( $module ) {

			$path = OEE_PATH .'/modules/'. $module .'.php';

			return file_exists( $path ) ? $path : false;

		}
		
		/**
		 * Get module register class name based on modules
		 * 
		 * @version  1.4 
		 * @since  1.0
		 * @return mixed
		 */
		public function get_module_class( $module ) {

			$class_name = 'OEE_'. octagon_change_case( $module, 'snake-pascal' ) .'_Module';

			return $class_name;

		}
				
	}
}

new OEE_Init_Elements();
