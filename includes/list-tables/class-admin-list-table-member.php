<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes/list-tables
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

class OEE_Member_List_Table {

	/**
	 * Post type.
	 *
	 * @var string
	 */
	protected $list_table_type = 'octagon_member';

	
	public function __construct() {
		add_filter( 'disable_months_dropdown', '__return_true' );
		add_filter( 'manage_'. $this->list_table_type .'_posts_columns', [ $this, 'posts_columns' ] );
		add_action( 'manage_'. $this->list_table_type .'_posts_custom_column', [ $this, 'custom_column_table_content' ], 10, 2 );
		add_action( 'restrict_manage_posts', [ $this, 'restrict_manage_posts' ] );
	}

	/**
	 * Add post columns
	 * 
	 * @version 1.0 
	 * @since 1.0
	 * @access public
	 * @return array
	 */
	public function posts_columns( $columns ) {

	    $new_columns = array(
			'cb'      => '<input type="checkbox" />',
			'thumb'   => '<span class="wp-list-table-icon thumb">'. esc_html__( 'Thumb', 'octagon-elements-lite-for-elementor' ) .'</span>',
			'title'   => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
			'email'   => esc_html__( 'Email', 'octagon-elements-lite-for-elementor' ),
			'website' => esc_html__( 'Website', 'octagon-elements-lite-for-elementor' ),
		);

		return array_merge( $new_columns, $columns );
	}

	/**
	 * Insert custom column content
	 * 
	 * @version 1.0 
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

			case 'email':
				$email = get_post_meta( $post_id, 'email', true );
				echo sprintf( '<a href="mailto:%1$s">%1$s</a>', sanitize_email( $email ) );
			break;

			case 'website':
				$website = get_post_meta( $post_id, 'website', true );
				echo sprintf( '<a href="%1$s" target="_blank">%1$s</a>', esc_url_raw( $website ) );
			break;

		}

	}

	/**
	 * Add custom dropdown filter
	 * 
	 * @version 1.0 
	 * @since 1.0
	 * @access public
	 */
	public function restrict_manage_posts() {

		global $wpdb;

		$screen = get_current_screen();

		if ( $screen->post_type == $this->list_table_type ) {

			global $wp_query;

			$args = array(
				'pad_counts'         => 1,
				'show_count'         => 1,
				'hierarchical'       => 1,
				'hide_empty'         => 1,
				'show_uncategorized' => 1,
				'orderby'            => 'name',
				'selected'           => isset( $wp_query->query_vars['octagon_member_job'] ) ? $wp_query->query_vars['octagon_member_job'] : '',
				'show_option_none'   => esc_html__( 'Filter by jobs', 'octagon-elements-lite-for-elementor' ),
				'option_none_value'  => '',
				'value_field'        => 'slug',
				'taxonomy'           => 'octagon_member_job',
				'name'               => 'octagon_member_job',
				'class'              => 'dropdown_octagon_member_job'
			);

			if ( 'order' === $args['orderby'] ) {
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'order';
			}

			wp_dropdown_categories( $args );
		}

	}

}