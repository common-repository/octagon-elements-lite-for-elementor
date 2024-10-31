<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core' ) ) {

	class Octagon_Core {

		/**
		 * Core Version.
		 *
		 */
		public $version = '1.0';

		/**
		 * The single instance of the class.
		 *
		 * @since 1.0
		 */
		protected static $_instance = null;

		/**
		 * Plugin Core Instance.
		 *
		 * Ensures only one instance of Core is loaded or can be loaded.
		 *
		 * @since 1.0
		 * @static
		 * @return Core - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Constructor.
		 */
		public function __construct() {

			$this->define_constants();
			$this->includes();

			do_action( 'octagon_core_loaded' );
			
		}

		/**
		 * Define Constants.
		 */
		private function define_constants() {
			$this->define( 'OCTAGON_CORE_VERSION', $this->version );
			$this->define( 'OCTAGON_CORE_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'OCTAGON_CORE_URL', plugin_dir_url( __FILE__ ) );
		}

		/**
		 * Include required files
		 * 
		 * @since  1.0
		 */
		public function includes() {

			include_once OCTAGON_CORE_PATH . '/vendor/wp-less/wp-less.php';

			include_once OCTAGON_CORE_PATH . 'select2-data.php';

			include_once OCTAGON_CORE_PATH . 'class-admin-page.php';
			include_once OCTAGON_CORE_PATH . 'class-custom-css.php';
			include_once OCTAGON_CORE_PATH . 'class-image-crop.php';
			include_once OCTAGON_CORE_PATH . 'helper-functions.php';
			include_once OCTAGON_CORE_PATH . 'theme-functions.php';
			include_once OCTAGON_CORE_PATH . 'theme-hooks.php';
			include_once OCTAGON_CORE_PATH . 'class-enqueue-fonts.php';
			include_once OCTAGON_CORE_PATH . 'class-enqueue-scripts.php';
			include_once OCTAGON_CORE_PATH . 'megamenu/class-megamenu.php';
			include_once OCTAGON_CORE_PATH . 'class-sidebar.php';
			include_once OCTAGON_CORE_PATH . 'class-post-type.php';
			include_once OCTAGON_CORE_PATH . 'class-post-row-actions.php';
			include_once OCTAGON_CORE_PATH . 'class-taxonomy-image.php';
			include_once OCTAGON_CORE_PATH . 'class-metabox.php';
			include_once OCTAGON_CORE_PATH . 'template-builder/class-template-builder.php';
			include_once OCTAGON_CORE_PATH . 'icon-manager/class-icon-manager.php';
			
		}

		/**
		 * Define constant if not set.
		 *
		 * @param string      $name  Constant name.
		 * @param string|bool $value Constant value.
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}
	}
}

/**
 * Main instance.
 *
 * Returns the main instance of Core.
 *
 * @since  1.0
 * @return Octagon_Core
 */
function OWS() {
	return Octagon_Core::instance();
}

// Global for backwards compatibility.
$GLOBALS['OWS'] = OWS();
