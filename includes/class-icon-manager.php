<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( class_exists( 'Octagon_Core_Icon_Manager' ) && ! class_exists( 'OEE_Icon_Manager' ) ) {

	class OEE_Icon_Manager extends Octagon_Core_Icon_Manager {

		public function __construct() {
			add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'icon_manager_additional_tabs' ] );		
		}
		
		/**
		 * Returns the custom icons lists to elementor custom icons hook
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @return array
		 */
		public function icon_manager_additional_tabs( $settings ) {

			$active_icon_set = get_option( 'octagon_icon_set', [] );

			foreach( parent::get_icon_set() as $id => $icons ) {
				if( in_array( $id, $active_icon_set ) ) {
					$settings[$id] = $icons;
				}
			}

		    return $settings;

		}

	}

	new OEE_Icon_Manager;

}
