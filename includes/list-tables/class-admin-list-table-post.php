<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes/list-tables
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

class OEE_Post_List_Table {

	/**
	 * Post type.
	 *
	 * @var string
	 */
	protected $list_table_type = 'post';

	
	public function __construct() {
		add_filter( 'manage_'. $this->list_table_type .'_posts_columns', [ $this, 'posts_columns' ] );
		add_action( 'manage_'. $this->list_table_type .'_posts_custom_column', [ $this, 'custom_column_table_content' ], 10, 2 );

		add_action( 'admin_action_feature_post', [ $this, 'feature_post' ] );
	}

	/**
	 * Add post columns
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return array
	 */
	public function posts_columns( $columns ) {

		$new_columns = array(
			'cb'       => '<input type="checkbox" />',
			'thumb'    => '<span class="wp-list-table-icon thumb">'. esc_html__( 'Thumb', 'octagon-elements-lite-for-elementor' ) .'</span>',
			'title'    => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
			'featured' => '<span class="wp-list-table-icon featured">'. esc_html__( 'Featured', 'octagon-elements-lite-for-elementor' ) .'</span>',
		);

		return array_merge( $new_columns, $columns );
	}

	/**
	 * Insert custom column content
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function custom_column_table_content( $column, $post_id ) {

		switch ( $column ) {

			case 'thumb':
				$thumbnail = octagon_get_meta( $post_id, 'thumbnail', '' );
				$thumbnail = ! empty( $thumbnail ) ? $thumbnail : get_post_thumbnail_id();
				echo octagon_get_cropped_image( $thumbnail, 60, 60, true );
			break;

			case 'featured':
				$featured = get_post_meta( $post_id, 'featured_post', true );
				$class = ( '' == $featured || NULL == $featured || 'not-featured' == $featured ) ? 'dashicons-star-empty' : 'dashicons-star-filled';

				echo '<a href="' . wp_nonce_url( admin_url( 'edit.php?post_type='. $this->list_table_type .'&action=feature_post&amp;post=' . $post_id ), 'feature-post_' . $post_id ) . '"><span class="dashicons '. esc_attr( $class) .'"></span></a>';
			break;

		}

	}

	/**
	 * Update feature post meta value via AJAX call
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function feature_post() {

		$post_type = function_exists( 'octagon_get_current_post_type' ) ? octagon_get_current_post_type() : '';

		if( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] )  || ( isset($_REQUEST['action'] ) && 'feature_post' == $_REQUEST['action'] ) ) ) {
			wp_die('No post to feature has been supplied!');
		}

		$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] );

		check_admin_referer( 'feature-post_' . $post_id );

		if( isset( $post_id ) && NULL != $post_id ) {

			$featured = get_post_meta( $post_id, 'featured_post', true );
			$featured = ( '' == $featured || NULL == $featured || 'not-featured' == $featured ) ? 'featured' : 'not-featured';

			update_post_meta( $post_id, 'featured_post', $featured );

			wp_redirect( admin_url( 'edit.php?post_type='. $post_type ) );
			exit;

		}
		else {
			wp_die( 'Choose feature post failed, could not find a post: ' . $post_id );
		}
	}

}
