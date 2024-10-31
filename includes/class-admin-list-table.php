<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'OEE_List_Table' ) ) {

	class OEE_List_Table {

		/**
		 * Constructor.
		 */
		public function __construct() {

			// Load correct list table classes for current screen.
			add_action( 'current_screen', [ $this, 'setup_screen' ] );
			add_action( 'check_ajax_referer', [ $this, 'setup_screen' ] );
		}

		/**
		 * Looks at the current screen and loads the correct list table handler.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public function setup_screen() {
			global $list_table;

			$screen_id = false;

			if( function_exists( 'get_current_screen' ) ) {
				$screen    = get_current_screen();
				$screen_id = isset( $screen, $screen->id ) ? $screen->id : '';
			}

			if( ! empty( $_REQUEST['screen'] ) ) { // WPCS: input var ok.
				$screen_id = wc_clean( wp_unslash( $_REQUEST['screen'] ) ); // WPCS: input var ok, sanitization ok.
			}

			switch ( $screen_id ) {

				case 'edit-post':
					include_once OEE_PATH . 'includes/list-tables/class-admin-list-table-post.php';
					$list_table = new OEE_Post_List_Table();
				break;

				case 'edit-octagon_templates':
					include_once OEE_PATH . 'includes/list-tables/class-admin-list-table-templates.php';
					$list_table = new OEE_Template_List_Table();
				break;

				case 'edit-octagon_portfolio':
					include_once OEE_PATH . 'includes/list-tables/class-admin-list-table-portfolio.php';
					$list_table = new OEE_Portfolio_List_Table();
				break;

				case 'edit-octagon_member':
					include_once OEE_PATH . 'includes/list-tables/class-admin-list-table-member.php';
					$list_table = new OEE_Member_List_Table();
				break;

				case 'edit-octagon_testimonial':
					include_once OEE_PATH . 'includes/list-tables/class-admin-list-table-testimonial.php';
					$list_table = new OEE_Testimonial_List_Table();
				break;
			}

			// Ensure the table handler is only loaded once. Prevents multiple loads if a plugin calls check_ajax_referer many times.
			remove_action( 'current_screen', [ $this, 'setup_screen' ] );
			remove_action( 'check_ajax_referer', [ $this, 'setup_screen' ] );
		}
	}

	new OEE_List_Table();
}
