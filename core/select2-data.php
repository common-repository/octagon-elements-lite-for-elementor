<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.2
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

class OEE_Select2_Data {

	/**
	 * Constructor.
	 */
	public function __construct() {		

		add_action( 'wp_ajax_all_singular_posts',  [ __CLASS__, 'all_singular_posts' ] );
		add_action( 'wp_ajax_nopriv_all_singular_posts', [ __CLASS__, 'all_singular_posts' ] );

		add_action( 'wp_ajax_oee_select2_datas',  [ $this, 'select2_datas' ] );
		add_action( 'wp_ajax_nopriv_oee_select2_datas', [ $this, 'select2_datas' ] );
	}

	/**
	 * Return list of singular posts
	 * 
	 * @version  1.2 
	 * @since 1.0
	 * @access public
	 */
	public static function all_singular_posts() {

		$q = isset( $_GET['q'] ) ? sanitize_text_field( $_GET['q'] ) : '';

		$build = [];

		$post_types = octagon_post_type_list();

		$i = 0; foreach( $post_types as $name => $label ) {

			$post_list = get_posts( 
				array(
					'post_type'   => $name,
					'numberposts' => -1,
					'orderby'     => 'date',
					'sort_order'  => 'desc',
					's'           => $q
				)
			);

			if( ! empty( $post_list ) ) {
				$build[$i]['text'] = $label;

				foreach( $post_list as $child => $post ) {
					$build[$i]['children'][$child]['id'] = $post->ID;
					$build[$i]['children'][$child]['text'] = $post->post_title;
				}
			}		

		$i++; }

		echo json_encode( array( 'items' => array_values( $build ) ) );

		die();
		
	}

	/**
	 * Return select2 selected data as it's required format
	 * 
	 * @version  1.2 
	 * @since 1.0
	 * @access public
	 */
	public function select2_datas() {

		$build = [];

		$id       = isset( $_GET['id'] ) ? absint( $_GET['id'] ) : '';
		$key      = isset( $_GET['key'] ) ? sanitize_text_field( $_GET['key'] ) : '';
		$callback = isset( $_GET['callback'] ) ? sanitize_text_field( $_GET['callback'] ) : '';

		$value = get_post_meta( $id, $key, true );

		if( ! empty( $value ) ) {

			if( 'all_singular_posts' == $callback ) {
				$post_types = octagon_post_type_list();

				$post_list = get_posts( 
					array(
						'post_type'   => array_keys( $post_types ),
						'numberposts' => -1,
						'orderby'     => 'date',
						'sort_order'  => 'desc',
						'post__in'    => $value
					)
				);

				foreach( $post_list as $key => $post ) {
					$build[$key]['id'] = $post->ID;
					$build[$key]['text'] = $post->post_title;
				}
			}

		}			

		echo json_encode( $build );

		die();
		
	}
}

new OEE_Select2_Data();
