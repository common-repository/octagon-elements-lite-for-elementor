<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/includes/list-tables
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.2
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

class OEE_Template_List_Table {

	/**
	 * Post type.
	 *
	 * @var string
	 */
	protected $list_table_type = 'octagon_templates';

	
	public function __construct() {
		add_filter( 'disable_months_dropdown', '__return_true' );
		add_filter( 'manage_'. $this->list_table_type .'_posts_columns', [ $this, 'posts_columns' ] );
		add_action( 'manage_'. $this->list_table_type .'_posts_custom_column', [ $this, 'custom_column_table_content' ], 10, 2 );
		add_action( 'restrict_manage_posts', [ $this, 'restrict_manage_posts' ] );
		add_filter( 'parse_query', [ $this, 'parse_query' ] );

		add_action( 'admin_action_ajax_state', array( $this, 'ajax_state' ) );
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
			'cb'        => '<input type="checkbox" />',
			'title'     => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
			'type'      => esc_html__( 'Type', 'octagon-elements-lite-for-elementor' ),
			'condition' => esc_html__( 'Condition', 'octagon-elements-lite-for-elementor' ),
			'state'     => esc_html__( 'State', 'octagon-elements-lite-for-elementor' )
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

		switch( $column ) {
			case 'type':
				$type = get_post_meta( $post_id, 'oee_template_type', true );
				echo esc_html( ucwords( $type ) );
			break;

			case 'condition':

				$condition                 = get_post_meta( $post_id, 'oee_template_condition', true );
				$condition_singular        = get_post_meta( $post_id, 'oee_template_condition_singular', true );
				$condition_custom_archives = get_post_meta( $post_id, 'oee_template_condition_custom_archives', true );
				$condition_singular_id     = get_post_meta( $post_id, 'oee_template_condition_singular_id', true );

				if( 'all' == $condition || 'front' == $condition || 'home' == $condition || 'pages' == $condition || 'all_singular' == $condition || '404' == $condition || 'all_archives' == $condition ) {
					
					echo sprintf( __( '<p class="condition"><span>%s</span></p>', 'octagon-elements-lite-for-elementor' ), esc_html( ucwords( str_replace( '_', ' ', $condition ) ) ) );

				}
				else if( 'singular' == $condition ) {

					$labels = [];

					foreach( $condition_singular as $key => $post_type ) {
						$post_type_obj = get_post_type_object( $post_type );
						$labels[] = ( null != $post_type_obj ) ? $post_type_obj->label : '';
					}

					echo sprintf( __( '<p class="condition"><strong>Singular Posts:</strong> <span>%s</span></p>', 'octagon-elements-lite-for-elementor' ), implode( '</span><span>', array_filter( $labels ) ) );					
				}
				else if( 'custom_archives' == $condition ) {

					foreach( $condition_custom_archives as $key => $taxonomy ) {
						$taxonomy_obj = get_taxonomy( $taxonomy );
						$labels[] = ( null != $taxonomy_obj ) ? $taxonomy_obj->label : '';
					}

					echo sprintf( __( '<p class="condition"><strong>Custom Archives:</strong> <span>%s</span></p>', 'octagon-elements-lite-for-elementor' ), implode( '</span><span>', array_filter( $labels ) ) );
				}
				else if( 'singular_id' == $condition ) {
					echo sprintf( __( '<p class="condition"><strong>Singular Post ID\'s:</strong> <span>%s</span></p>', 'octagon-elements-lite-for-elementor' ), implode( '</span><span>', $condition_singular_id ) );
				}
			break;

			case 'state':
				$state = get_post_meta( $post_id, 'oee_template_state', true );
				echo sprintf( '<a href="%1$s" class="wp-list-table-icon state %2$s" title="%3$s"><span>%3$s</span></a>', esc_url( wp_nonce_url( admin_url( 'edit.php?post_type='. $this->list_table_type .'&action=ajax_state&amp;post=' . $post_id ), 'state_' . $post_id ) ), esc_attr( $state ), esc_html( $state ) );
			break;
			
			default:
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

			$type = isset( $_GET['oee_template_type'] ) ? sanitize_text_field( $_GET['oee_template_type'] ) : '0';

			echo '<select name="oee_template_type">';
				echo '<option value="0">'. esc_html__( 'Filter by types', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="header" '. selected( $type, 'header' ) .'>'. esc_html__( 'Header', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="footer" '. selected( $type, 'footer' ) .'>'. esc_html__( 'Footer', 'octagon-elements-lite-for-elementor' ) .'</option>';
			echo '</select>';

			$condition = isset( $_GET['oee_template_condition'] ) ? sanitize_text_field( $_GET['oee_template_condition'] ) : '0';

			echo '<select name="oee_template_state">';
				echo '<option value="0">'. esc_html__( 'Filter by conditions', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="all" '. selected( $condition, 'all' ) .'>'. esc_html__( 'Entire Site', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="front" '. selected( $condition, 'all' ) .'>'. esc_html__( 'Front Page', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="home" '. selected( $condition, 'all' ) .'>'. esc_html__( 'Home', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="search" '. selected( $condition, 'all' ) .'>'. esc_html__( 'Search', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="pages" '. selected( $condition, 'all' ) .'>'. esc_html__( 'All Pages', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="all_singular" '. selected( $condition, 'all' ) .'>'. esc_html__( 'All Singular Posts', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="singular" '. selected( $condition, 'all' ) .'>'. esc_html__( 'Specific Singular Posts', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="singular_id" '. selected( $condition, 'all' ) .'>'. esc_html__( 'Singular ID', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="404" '. selected( $condition, 'all' ) .'>'. esc_html__( 'Error 404', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="all_archives" '. selected( $condition, 'all' ) .'>'. esc_html__( 'All Archives', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="custom_archives" '. selected( $condition, 'all' ) .'>'. esc_html__( 'Custom Archives', 'octagon-elements-lite-for-elementor' ) .'</option>';
			echo '</select>';

			$state = isset( $_GET['oee_template_state'] ) ? sanitize_text_field( $_GET['oee_template_state'] ) : '0';

			echo '<select name="oee_template_state">';
				echo '<option value="0">'. esc_html__( 'Filter by state', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="active" '. selected( $state, 'active' ) .'>'. esc_html__( 'Active', 'octagon-elements-lite-for-elementor' ) .'</option>';
				echo '<option value="in-active" '. selected( $state, 'in-active' ) .'>'. esc_html__( 'In Active', 'octagon-elements-lite-for-elementor' ) .'</option>';
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

	    if( ! empty( $_GET['oee_template_type'] ) ) {
			$qv['meta_query'][] = array(
				'field'   => 'oee_template_type',
				'value'   => sanitize_text_field( $_GET['oee_template_type'] ),
				'compare' => '='
			);
	    }

	    if( ! empty( $_GET['oee_template_condition'] ) ) {
			$qv['meta_query'][] = array(
				'field'   => 'oee_template_condition',
				'value'   => sanitize_text_field( $_GET['oee_template_condition'] ),
				'compare' => '='
			);
	    }

	    if( ! empty( $_GET['oee_template_state'] ) ) {
			$qv['meta_query'][] = array(
				'field'   => 'oee_template_state',
				'value'   => sanitize_text_field( $_GET['oee_template_state'] ),
				'compare' => '='
			);
	    }

	}

	/**
	 * Ajax callback for change/modify state
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function ajax_state() {

		if( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] )  || ( isset($_REQUEST['action'] ) && 'ajax_state' == $_REQUEST['action'] ) ) ) {
			wp_die('No post to feature has been supplied!');
		}

		$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] );

		check_admin_referer( 'state_' . $post_id );

		if( isset( $post_id ) && NULL != $post_id ) {

			$state = get_post_meta( $post_id, 'oee_template_state', true );
			$state = ( '' == $state || NULL == $state || 'inactive' == $state ) ? 'active' : 'inactive';

			update_post_meta( $post_id, 'oee_template_state', $state );

			wp_redirect( admin_url( 'edit.php?post_type='. $this->list_table_type ) );

			$template_builder = new Octagon_Core_Template_Builder();
			$template_builder->save_meta_in_theme_mod( $post_id );

			exit;

		}
		else {
			wp_die( 'Choose state failed, could not find a post: ' . $post_id );
		}
	}

}
