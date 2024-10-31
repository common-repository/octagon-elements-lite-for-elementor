<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.4
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core_Enqueue_scripts' ) ) {

	class Octagon_Core_Enqueue_scripts {

		public function __construct() {

			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );			
			
		}

		/**
		 * Enqueue Scripts
		 * 
		 * @version  1.4 
		 * @since 1.0
		 * @access public
		 */
		public function enqueue_scripts() {

			/* ---------------------------------------------------------------------------
			 * CSS
			------------------------------------------------------------------------------ */

			wp_enqueue_style( 'bootstrap', OCTAGON_CORE_URL . 'library/css/bootstrap.min.css', [], '3.3.7', 'all' );
			wp_enqueue_style( 'icon-basic', OCTAGON_CORE_URL . 'assets/css/icon-basic.css', [], '1.0', 'all' );
			wp_enqueue_style( 'icon-social', OCTAGON_CORE_URL . 'assets/css/icon-social.css', [], '1.0', 'all' );
			wp_enqueue_style( 'octagon', OCTAGON_CORE_URL . 'assets/css/octagon.css', [], '1.4', 'all' );
			wp_enqueue_style( 'octagon-gradient-palette', OCTAGON_CORE_URL . 'assets/css/gradient-palette.css', [], '1.1', 'all' );
			
			wp_register_style( 'magnific-popup', OCTAGON_CORE_URL . 'library/css/magnific-popup.min.css', [], '1.1.0', 'all' );
			wp_register_style( 'image-compare-viewer', OCTAGON_CORE_URL . 'library/css/image-compare-viewer.min.css', [], '1.0', 'all' );


			/* ---------------------------------------------------------------------------
			 * JQuery
			------------------------------------------------------------------------------ */

			wp_register_script( 'magnific-popup', OCTAGON_CORE_URL . 'library/js/magnific-popup.min.js', array( 'jquery' ), '1.1.0' , false );
			wp_register_script( 'imagesloaded', OCTAGON_CORE_URL . 'library/js/imagesloaded.min.js', array( 'jquery' ), '4.1.4', false );
			wp_register_script( 'isotope', OCTAGON_CORE_URL . 'library/js/isotope.min.js', array( 'jquery' ), '3.0.6', false );
			wp_register_script( 'shuffle', OCTAGON_CORE_URL . 'library/js/shuffle.min.js', array( 'jquery' ), '3.0.6', false );
			wp_register_script( 'image-compare-viewer', OCTAGON_CORE_URL . 'library/js/image-compare-viewer.min.js', array( 'jquery' ), '1.0', false );
			wp_register_script( 'slide-nav', OCTAGON_CORE_URL . 'library/js/slide-nav.min.js', array( 'jquery' ), '1.0.1', false );

			wp_register_script( 'octagon-core-tools', OCTAGON_CORE_URL . 'assets/js/tools.js', array( 'jquery' ), '1.0', true );

			// Localize scripts
			$object = array( 
				'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
				'root_url' => esc_url( home_url( '/' ) )
			);

			octagon_concatenate_localize_scripts( 'octagon-core-tools', 'octagon_localize', $object );
		}

		/**
		 * Admin Enqueue Scripts
		 * 
		 * @version  1.4 
		 * @since 1.0
		 * @access public
		 */
		public function admin_enqueue_scripts( $hook ) {

			if( is_customize_preview() ) { /* TODO: Remove this check, once added the correct hook check */
				return;
			}

			/* ---------------------------------------------------------------------------
			 * CSS
			------------------------------------------------------------------------------ */

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'select2', OCTAGON_CORE_URL . 'library/css/select2.min.css', [] , '1.0', 'all' );
			
			wp_enqueue_style( 'octagon-core-admin', OCTAGON_CORE_URL . 'assets/css/admin.css', [] , '1.3', 'all' );
			wp_enqueue_style( 'octagon-icon', OCTAGON_CORE_URL . 'assets/css/octagon-icon.css', [] , '1.0', 'all' );


			/* ---------------------------------------------------------------------------
			 * JQuery
			------------------------------------------------------------------------------ */

			wp_enqueue_script( 'wp-color-picker-alpha', OCTAGON_CORE_URL . 'library/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '2.1.3', true );
			wp_enqueue_script( 'select2', OCTAGON_CORE_URL . 'library/js/select2.min.js', [], '2.1.3', true );

			wp_enqueue_script( 'octagon-core-icon-manager', OCTAGON_CORE_URL . 'assets/js/icon-manager.js', [], '1.0', true );

			wp_enqueue_script( 'octagon-core-icon-picker', OCTAGON_CORE_URL . 'assets/js/icon-picker.js', [], '1.0', true );
			wp_enqueue_script( 'octagon-core-sidebar', OCTAGON_CORE_URL . 'assets/js/sidebar.js', [], '1.1', true );

			wp_enqueue_media();
			wp_enqueue_script( 'octagon-core-media-upload', OCTAGON_CORE_URL . 'assets/js/custom-media-upload.js', [], '1.0', true );
			
			wp_enqueue_script( 'octagon-core-admin', OCTAGON_CORE_URL . 'assets/js/admin.js' , array( 'jquery' ), '1.4' );

			wp_localize_script( 'jquery', 'octagon_core_obj',
				array( 
					'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) )
				)
			);

		}

	}

	new Octagon_Core_Enqueue_scripts;

}
