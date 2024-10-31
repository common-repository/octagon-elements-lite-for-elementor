<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.4
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'OEE_Enqueue_scripts' ) ) {

	class OEE_Enqueue_scripts {

		public function __construct() {

			add_action( 'wp_enqueue_scripts', [ $this, 'register_style' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 99 );
			add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_handlers' ], 99 );
			
		}

		/**
		 * Register style
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function register_style() {

			/* ---------------------------------------------------------------------------
			 * LESS
			------------------------------------------------------------------------------ */

			$enqueue_data = $this->get_modules_enqueue_data();

			foreach( $enqueue_data as $id => $data ) {

				if( $data['css'] ) {

					$ver = $data['css']['ver'] ?? '1.0';
					$dep = $data['css']['dep'] ?? [];

					wp_register_style( $id, $data['css']['url'], $dep, $ver, 'all' );
				}			

			}

		}

		/**
		 * Enqueue scripts
		 * 
		 * @version  1.4 
		 * @since  1.0
		 * @access public
		 */
		public function enqueue_scripts() {

			/* ---------------------------------------------------------------------------
			 * JQuery
			------------------------------------------------------------------------------ */

			wp_enqueue_script( 'oee-scripts', OEE_URL .'assets/js/scripts.js', array( 'jquery', 'octagon-core-tools' ), '1.4', true );
		}

		/**
		 * Enqueue elementor frontend handlers, it helps to render the JS framework properly in front end
		 * 
		 * @version  1.4 
		 * @since  1.0
		 * @access public
		 */
		public function enqueue_handlers() {

			/* ---------------------------------------------------------------------------
			 * JQuery
			------------------------------------------------------------------------------ */

			wp_enqueue_script( 'oee-frontend', OEE_URL .'assets/js/frontend.js', [ 'elementor-frontend-modules', 'elementor-dialog', 'elementor-waypoints' ], '1.4', true );
		}

		/**
		 * List of shortcodes less file path
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function get_modules_enqueue_data() {

			$module_enqueue_data = [
				'oee-advance-button' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/advance-button.less'
					]
				],
				'oee-advance-counter' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/advance-counter.less'
					]
				],
				'oee-content-type' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/content-type.less'
					]
				],
				'oee-content-type-list' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/content-type-list.less'
					]
				],
				'oee-content-type-slider' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/content-type-slider.less'
					]
				],
				'oee-gradient-text' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/gradient-text.less'
					]
				],
				'oee-image-box' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/image-box.less'
					]
				],
				'oee-icon-box' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/icon-box.less'
					]
				],
				'oee-image-mask' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/image-mask.less'
					]
				],
				'oee-info-icons' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/info-icons.less'
					]
				],
				'oee-cards' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/cards.less'
					]
				],
				'oee-timeline' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/timeline.less'
					]
				],
				'oee-portfolio' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/portfolio.less'
					]
				],
				'oee-portfolio-slider' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/portfolio-slider.less'
					]
				],
				'oee-portfolio-extend-slider' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/portfolio-extend-slider.less'
					]
				],
				'oee-team' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/team.less'
					]
				],
				'oee-team-slider' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/team-slider.less'
					]
				],
				'oee-testimonial-slider' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/testimonial-slider.less'
					]
				],
				'oee-video-popup' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/video-popup.less'
					]
				],
				'oee-products' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/products.less'
					]
				],
				'oee-products-list' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/products-list.less'
					]
				],
				'oee-products-slider' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/products-slider.less'
					]
				],
				'oee-compare-products' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/compare-products.less'
					]
				],
				'oee-wishlist' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/wishlist.less'
					]
				],
				'oee-ajax-product-search' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/ajax-product-search.less'
					]
				],
				'oee-navigation-menu' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/navigation-menu.less'
					]
				],
				'oee-social-icons' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/social-icons.less'
					]
				],
				'oee-login-register-form' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/login-register-form.less'
					]
				],
				'oee-gallery-block' => [
					'css'  => [
						'ver'  => '1.0',
						'url'  => OEE_URL .'assets/less/shortcodes/gallery-block.less'
					]
				]
			];

			return apply_filters( 'oee_enqueue_data', $module_enqueue_data );
		}

	}

	new OEE_Enqueue_scripts;

}
