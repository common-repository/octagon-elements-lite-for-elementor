<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( class_exists( 'Octagon_Core_Post_Row_Actions' ) && ! class_exists( 'OEE_Post_Row_Actions' ) ) {

	class OEE_Post_Row_Actions extends Octagon_Core_Post_Row_Actions {

		public function __construct() {			
			add_filter( 'octagon_duplicate_post_redirect', [ $this, 'duplicate_post_redirect'], 10, 3 );
		}

		/**
		 * Duplicate page redirect URL
		 * If the old post is using elementor edit mode, it redirects in to elementor front end
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  string 	$redirect_url 	Redirect url
		 * @param  int 	$old_post_id 		Post ID
		 * @param  int 	$new_post_id 		Post ID
		 * @return string
		 */
		public function duplicate_post_redirect( $redirect_url = '', $old_post_id = '', $new_post_id = '' ) {

			$action = ! ! get_post_meta( $old_post_id, '_elementor_edit_mode', true );

			if( $action ) {
				return admin_url( 'post.php?action=edit&post='. $new_post_id .'&action=elementor' );
			}
			else {
				return $redirect_url;
			}			

		}

	}

	new OEE_Post_Row_Actions;

}
