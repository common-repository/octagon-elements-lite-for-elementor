<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( class_exists( 'Octagon_Core_Enqueue_Fonts' ) && ! class_exists( 'OEE_Enqueue_Fonts' ) ) {

	class OEE_Enqueue_Fonts extends Octagon_Core_Enqueue_Fonts {

		public function __construct() {
			add_filter( 'octagon_enqueue_fonts_list', [ $this, 'fonts_list' ], 10, 1 );			
		}

		/**
		 * Returns fonts set array
		 * 
		 * @version  1.0 
		 * @since  1.0
		 * @param  array $fonts    Fonts array set
		 * @access public
		 * @return array
		 */
		public function fonts_list( $fonts ) {

			// Advance Typography
			$fonts[] = get_theme_mod( 'content_type_title', [] );

			$fonts = array_filter( $fonts );

			return $fonts;

		}

	}

	new OEE_Enqueue_Fonts;

}
