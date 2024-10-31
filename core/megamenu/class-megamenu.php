<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/megamenu
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;
	
if( ! class_exists( 'Octagon_Megamenu' ) ) {

	include_once plugin_dir_path( __FILE__ ) . '/class-walker-nav-menu.php';
	include_once plugin_dir_path( __FILE__ ) . '/class-walker-nav-menu-edit.php';

	class Octagon_Megamenu {

		public function __construct() {
			add_action( 'wp_setup_nav_menu_item', [ $this, 'custom_nav_fields' ], 10, 1 );
			add_action( 'wp_update_nav_menu_item', [ $this, 'custom_nav_update' ], 10, 3 );
			add_filter( 'wp_edit_nav_menu_walker', [ $this, 'custom_nav_edit_walker' ], 10, 2 );
		}

		/**
		 * Custom navigation fields
		 * 
		 * @since  1.0
		 * @param  object  $menu_item Menu Item
		 * @return object
		 */
		public function custom_nav_fields( $menu_item ) {

			$fields = $this->get_fields();

			foreach( $fields as $key => $value ) {

				$current_value = get_post_meta( $menu_item->ID, $value['key'], true );
				$current_value = isset( $current_value ) || ( '' != $current_value ) || ( null != $current_value ) ? $current_value : $value['default'];

				$menu_item->{ str_replace( '_menu_item_', '', $value['key'] ) } = get_post_meta( $menu_item->ID, $value['key'], true );
			}

			return $menu_item;

		}

		/**
		 * Update custom navigation fields
		 * 
		 * @since  1.0
		 * @param  int 		$menu_id 			Menu ID
		 * @param  string 	$menu_item_db_id 	Menu Item Database ID
		 * @param  object 	$menu_item_data 	Menu Item
		 * @return object
		 */
		public function custom_nav_update( $menu_id, $menu_item_db_id, $menu_item_data ) {

			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				return;
			}

			$fields = $this->get_fields();

			foreach( $fields as $key => $value ) {

				if ( isset( $_POST[ $value['id'] ][ $menu_item_db_id ] ) && ! empty( $_POST[ $value['id'] ][ $menu_item_db_id ] ) ) {
					$result = $_POST[ $value['id'] ][ $menu_item_db_id ];
				}
				else {
					$result = $value['default'];
				}

				update_post_meta( $menu_item_db_id, $value['key'], $result );

			}

		}

		/**
		 * Additional custom navigation fields
		 * 
		 * @since  1.0
		 * @return array
		 */
		public static function get_fields() {

			$fields = array(
				'disable_link' => array(
					'id'      => 'menu-item-disable-link',
					'key'     => '_menu_item_disable_link',
					'default' => false
				),
				'align' => array(
					'id'      => 'menu-item-align',
					'key'     => '_menu_item_align',
					'default' => 'left'
				),
				'megamenu' => array(
					'id'      => 'menu-item-megamenu',
					'key'     => '_menu_item_megamenu',
					'default' => false
				),
				'columns' => array(
					'id'      => 'menu-item-columns',
					'key'     => '_menu_item_columns',
					'default' => '4'
				),
				'background' => array(
					'id'      => 'menu-item-background',
					'key'     => '_menu_item_background',
					'default' => ''
				),
				'hide_title' => array(
					'id'      => 'menu-item-hide-title',
					'key'     => '_menu_item_hide_title',
					'default' => false
				),
				'act_as_title' => array(
					'id'      => 'menu-item-act-as-title',
					'key'     => '_menu_item_act_as_title',
					'default' => false
				),
				'widget_area' => array(
					'id'      => 'menu-item-widget-area',
					'key'     => '_menu_item_widget_area',
					'default' => '0'
				),
				'icon' => array(
					'id'      => 'menu-item-icon',
					'key'     => '_menu_item_icon',
					'default' => ''
				),
				'batch' => array(
					'id'      => 'menu-item-batch',
					'key'     => '_menu_item_batch',
					'default' => ''
				),
				'batch_bg_color' => array(
					'id'      => 'menu-item-batch-bg-color',
					'key'     => '_menu_item_batch_bg_color',
					'default' => ''
				),
				'batch_color' => array(
					'id'      => 'menu-item-batch-color',
					'key'     => '_menu_item_batch_color',
					'default' => ''
				)
			);

			return $fields;
		}

		/**
		 * Relace custom navigation edit walker
		 * 
		 * @since  1.0
		 * @param  string 	$walker 	Wlaker Class
		 * @param  int 		$menu_id 	Menu ID
		 * @return string
		 */
		public function custom_nav_edit_walker( $walker, $menu_id ) {
			return 'Octagon_Walker_Nav_Menu_Edit';
		}

	}

	new Octagon_Megamenu();

}