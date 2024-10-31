<?php
/**
 * Plugin Name: Octagon Elements Lite for Elementor
 * Plugin URI: https://octagonwebstudio.com
 * Description: Tons of unique shortcodes elements with toggle feature.
 * Version: 1.4
 * Author: octagonwebstudio
 * Text Domain: octagon-elements-lite-for-elementor
 * Requires WP: 5.0
 * Requires PHP: 7.0
 * Domain Path: /languages/
*/

defined( 'ABSPATH' ) || exit;

if( defined( 'OEE_PRO' ) ) {
	return;
}
	
if( ! class_exists( 'OEE' ) ) {

	class OEE {

		/**
		 * Core Version.
		 *
		 */
		public $version = '1.4';

		/**
		 * Minimum Elementor Version
		 *
		 * @since 1.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.6';

		/**
		 * Minimum PHP Version
		 *
		 * @since 1.0
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const MINIMUM_PHP_VERSION = '7.0';

		/**
		 * The single instance of the class.
		 *
		 * @since 1.0
		 *
		 */
		protected static $_instance = null;

		/**
		 * Plugin Core Instance.
		 *
		 * Ensures only one instance of Core is loaded or can be loaded.
		 *
		 * @since 1.0
		 * @version  1.0
		 * @static
		 * @return Core - Main instance.
		 * 
		 */
		public static function instance() {
			if( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Constructor.
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function __construct() {

			$this->define_constants();
			$this->hooks();
			$this->init_core();
			$this->includes();
			$this->load_dynamic_css();

			do_action( 'oee_loaded' );
			
		}

		/**
		 * Define Constants.
		 * 
		 * @version  1.1
		 * @since  1.0
		 * @access private
		 */

		private function define_constants() {
			$this->define( 'OEE_LITE', true );
			$this->define( 'OEE_VERSION', $this->version );
			$this->define( 'OEE_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'OEE_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'OEE_URL', plugin_dir_url( __FILE__ ) );
		}

		/**
		 * Define constant if not set.
		 *
		 * @param string      $name  Constant name.
		 * @param string|bool $value Constant value.
		 * @access private
		 */
		private function define( $name, $value ) {
			if( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Include core
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function init_core() {
			include_once plugin_dir_path( __FILE__ ) . '/core/octagon-core.php';
		}

		/**
		 * Include required files
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function includes() {

			include_once OEE_PATH . '/includes/helper-functions.php';
			include_once OEE_PATH . '/includes/class-ajax-calls.php';
			include_once OEE_PATH . '/includes/init-content-types.php';
			include_once OEE_PATH . '/includes/init-meta-fields.php';
			include_once OEE_PATH . '/includes/class-enqueue-fonts.php';
			include_once OEE_PATH . '/includes/class-enqueue-scripts.php';
			include_once OEE_PATH . '/includes/class-icon-manager.php';
			include_once OEE_PATH . '/includes/class-admin-page.php';
			include_once OEE_PATH . '/includes/class-admin-list-table.php';
			include_once OEE_PATH . '/includes/class-post-row-actions.php';
			include_once OEE_PATH . '/builder/class-builder.php';
			include_once OEE_PATH . '/includes/woo-conditional-tags.php';
			
		}

		/**
		 * Load Dynamic CSS
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function load_dynamic_css() {

			if( class_exists( 'Octagon_Core_Custom_CSS' ) ) {

				$octagon_elements = new Octagon_Core_Custom_CSS(
					array(
						'cache-name' => 'octagon-elements',
						'file-path'  => OEE_PATH . '/includes/custom-styles.php'
					)
				);

			}			
			
		}

		/**
		 * Hook into actions and filters.
		 *
		 * @version  1.0 
		 * @since 1.0
		 * @access private
		 */
		private function hooks() {
			add_action( 'init', [ $this, 'install' ] );
			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'plugins_loaded', [ $this, 'check_compatability' ] );
			add_action( 'plugins_loaded', [ $this, 'initialize_elements' ] );

			add_action( 'body_class', array( $this, 'body_class' ) );
		}

		/**
		 * Plugin install
		 *
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function install() {
			self::set_default_modules();
			self::set_default_icons();
		}

		/**
		 * Initialize default modules
		 *
		 * @version  1.4 
		 * @since  1.0
		 * @access public
		 */
		public static function set_default_modules() {

			$active_modules = get_option( 'oee_modules', [] );

			$default_modules = apply_filters( 'oee_default_active_modules', [
				'advance-button',
				'advance-counter',
				'gradient-text',
				'image-box',
				'icon-box',
				'image-mask',
				'info-icons',
				'cards',
				'timeline',
				'video-popup',
				'social-icons',
				'image-compare',
				'login-register-form',
				'gallery-block',
				'content-type',
				'content-type-list',
				'content-type-slider',
				'portfolio',
				'portfolio-slider',
				'portfolio-extend-slider',
				'team',
				'team-slider',
				'testimonial-slider',
				'logo',
				'navigation-menu',
				'products',
				'products-slider',
				'products-list',
				'compare-products',
				'wishlist',
				'ajax-product-search'
			] );

			if( empty( $active_modules ) || ! $active_modules ) {
				update_option( 'oee_modules', $default_modules );
			}			
		}

		/**
		 * Initialize default pre defined icons pack
		 *
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public static function set_default_icons() {

			$active_icons = get_option( 'octagon_icon_set', [] );

			$default_icons = apply_filters( 'oee_default_active_icons', [
				'octagon-basic',
				'octagon-social'
			] );

			if( empty( $active_icons ) || ! $active_icons ) {
				update_option( 'octagon_icon_set', $default_icons );
			}			
		}

		/**
		 * Plugin localisation
		 *
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function i18n() {
		    load_plugin_textdomain( 'octagon-elements-lite-for-elementor', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Check compatibilty and raise notices
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function check_compatability() {

		    // Check if Elementor installed and activated
			if( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return;
			}

			// Check for required Elementor version
			if( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return;
			}

			// Check for required PHP version
			if( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return;
			}

		}

		/**
		 * Notice: Missing main plugin
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {

			if( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor */
				__( '%1$s is enabled but not effective. It requires %2$s in order to work.', 'octagon-elements-lite-for-elementor' ),
				'<strong>' . esc_html__( 'Octagon Elements for Elementor', 'octagon-elements-lite-for-elementor' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'octagon-elements-lite-for-elementor' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Notice: Minimum main plugin version not met
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {

			if( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				__( '%1$s requires %2$s version %3$s or greater.', 'octagon-elements-lite-for-elementor' ),
				'<strong>' . esc_html__( 'Octagon Elements for Elementor', 'octagon-elements-lite-for-elementor' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'octagon-elements-lite-for-elementor' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Notice: Minimum PHP version not met
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {

			if( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				__( '%1$s requires %2$s version %3$s or greater.', 'octagon-elements-lite-for-elementor' ),
				'<strong>' . esc_html__( 'Octagon Elements for Elementor', 'octagon-elements-lite-for-elementor' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'octagon-elements-lite-for-elementor' ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Include elements
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function initialize_elements() {
			include_once OEE_PATH . '/modules/initialize-elements.php';
		}

		/**
		 * Include elements
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @access public
		 */
		public function body_class( $class = [] ) {

			$gradient_palette = get_option( 'oee_gradient_palette', false );
			
			$class['gradient-palette'] = ( 'none' != $gradient_palette ) ? 'scheme-'.$gradient_palette : '';

			$class = apply_filters( 'oee_body_classes', $class );
			return $class;
		}
				
	}
}

/**
 * Main instance.
 *
 * Returns the main instance of Core.
 *
 * @version 1.0
 * @since  1.0
 * @return OEE
 */
if( ! function_exists( 'OEE' ) ) {
	function OEE() {
		return OEE::instance();
	}
}

$GLOBALS['oee'] = OEE();