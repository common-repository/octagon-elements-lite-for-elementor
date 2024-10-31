<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes/list-tables
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.2
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

class OEE_Testimonial_List_Table {

	/**
	 * Post type.
	 *
	 * @var string
	 */
	protected $list_table_type = 'octagon_testimonial';

	
	public function __construct() {
		add_filter( 'disable_months_dropdown', '__return_true' );
		add_filter( 'manage_'. $this->list_table_type .'_posts_columns', [ $this, 'posts_columns' ] );
		add_action( 'manage_'. $this->list_table_type .'_posts_custom_column', [ $this, 'custom_column_table_content' ], 10, 2 );
		add_action( 'restrict_manage_posts', [ $this, 'restrict_manage_posts' ] );
		add_filter( 'parse_query', [ $this, 'parse_query' ] );
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
			'cb'     => '<input type="checkbox" />',
			'thumb'  => '<span class="wp-list-table-icon thumb">'. esc_html__( 'Thumb', 'octagon-elements-lite-for-elementor' ) .'</span>',
			'title'    => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
			'rating' => esc_html__( 'Rating', 'octagon-elements-lite-for-elementor' )
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

			case 'rating':
				$rating = get_post_meta( $post_id, 'client_rating', true );

				if( '1' == $rating ) {
					esc_html_e( 'Bad', 'octagon-elements-lite-for-elementor' );
				}
				else if( '2' == $rating ) {
					esc_html_e( 'OK', 'octagon-elements-lite-for-elementor' );
				}
				else if( '3' == $rating ) {
					esc_html_e( 'Average', 'octagon-elements-lite-for-elementor' );
				}
				else if( '4' == $rating ) {
					esc_html_e( 'Good', 'octagon-elements-lite-for-elementor' );
				}
				else if( '5' == $rating ) {
					esc_html_e( 'Better', 'octagon-elements-lite-for-elementor' );
				}
			break;

		}

	}

	/**
	 * Add custom dropdown filter
	 * 
	 * @version  1.2 
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
				'selected'           => isset( $wp_query->query_vars['octagon_testimonial_job'] ) ? $wp_query->query_vars['octagon_testimonial_job'] : '',
				'show_option_none'   => esc_html__( 'Filter by jobs', 'octagon-elements-lite-for-elementor' ),
				'option_none_value'  => '',
				'value_field'        => 'slug',
				'taxonomy'           => 'octagon_testimonial_job',
				'name'               => 'octagon_testimonial_job',
				'class'              => 'dropdown_octagon_testimonial_job'
			);

			if ( 'order' === $args['orderby'] ) {
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'order';
			}

			wp_dropdown_categories( $args );

			$rating = isset( $_GET['client_rating'] ) ? sanitize_text_field( $_GET['client_rating'] ) : '0';

			echo '<select name="client_rating">';
				echo '<option value="0">'. esc_html__( 'Filter by rating', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="1" '. selected( $rating, '1' ) .'>'. esc_html__( 'Bad', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="2" '. selected( $rating, '2' ) .'>'. esc_html__( 'OK', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="3" '. selected( $rating, '3' ) .'>'. esc_html__( 'Average', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="4" '. selected( $rating, '4' ) .'>'. esc_html__( 'Good', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="5" '. selected( $rating, '5' ) .'>'. esc_html__( 'Better', 'octagon-elements-lite-for-elementor' ) .'</option>';
			echo '</select>';
		}

	}

	/**
	 * Parse Query
	 * 
	 * @version  1.2 
	 * @since 1.0
	 * @access public
	 */
	public function parse_query( $query ) {

		$qv = &$query->query_vars;
	    $qv['meta_query'] = [];

	    if( isset( $_GET['client_rating'] ) && ! empty( $_GET['client_rating'] ) ) {
			$qv['meta_query'][] = array(
				'field'   => 'client_rating',
				'value'   => sanitize_text_field( $_GET['client_rating'] ),
				'compare' => '='
			);
	    }

	}

}
