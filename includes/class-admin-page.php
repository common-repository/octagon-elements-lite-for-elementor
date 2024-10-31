<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;
	
if( class_exists( 'Octagon_Core_Admin_Page' ) && ! class_exists( 'OEE_Admin_Page' ) ) {

	class OEE_Admin_Page extends Octagon_Core_Admin_Page {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_filter( 'plugin_row_meta', [ $this, 'plugin_row_meta' ], 10, 2 );
			add_action( 'admin_menu', [ $this, 'admin_menu' ], 99 );
			
		}

		/**
		 * Modify the plugin row links
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @param  array 	$links 	Plugin row links
		 * @param  string 	$file 	Plugin folder base name
		 * @access public
		 */
		public static function plugin_row_meta( $links, $file ) {

			if( OEE_BASENAME === $file ) {
				$links['video-tut'] = '<a href="//www.youtube.com/channel/UCZKSopOEW-ivQRpaMlz8uEQ">' . esc_html__( 'Video Tutorial', 'octagon-elements-lite-for-elementor' ) . '</a>';
				$links['knowledgebase'] = '<a href="//doc.octagonwebstudio.com/octagon-elements-lite-for-elementor/">' . esc_html__( 'Knowledgebase', 'octagon-elements-lite-for-elementor' ) . '</a>';
				$links['support']   = '<a href="mailto:octagonwebstudio@gmail.com">' . esc_html__( 'Premium Support', 'octagon-elements-lite-for-elementor' ) . '</a>';
			}

			return $links;
		}

		/**
		 * Admin Menu
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public function admin_menu() {
			add_submenu_page( 'octagon-intro', esc_html_x( 'Modules', 'admin-menu', 'octagon-elements-lite-for-elementor' ), esc_html_x( 'Modules', 'admin-menu', 'octagon-elements-lite-for-elementor' ), 'administrator', 'octagon-modules', [ $this, 'modules' ] );
			add_submenu_page( 'octagon-intro', esc_html_x( 'Settings', 'admin-menu', 'octagon-elements-lite-for-elementor' ), esc_html_x( 'Settings', 'admin-menu', 'octagon-elements-lite-for-elementor' ), 'administrator', 'octagon-settings', [ $this, 'settings' ] );
		}

		/**
		 * Modules
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public function modules() {
			include_once OEE_PATH . '/views/html-modules.php';
		}

		/**
		 * Settings
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public function settings() {
			include_once OEE_PATH . '/views/html-settings.php';
		}

	}

	new OEE_Admin_Page;

}
