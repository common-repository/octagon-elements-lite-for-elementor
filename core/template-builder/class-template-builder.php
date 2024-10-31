<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/template-builder
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core_Template_Builder' ) ) {

	class Octagon_Core_Template_Builder {

		public static $template_data = [];

		public static $template_type = '';

		private static $id = false;

		private static $post_type = 'post';

		private static $taxonomy = 'category';

		public $registered_post_types = [];

		private static $registered_taxonomy = [];

		public function __construct() {

			$this->init_content_type();
			add_action( 'admin_init', [ $this, 'init_metabox' ], 10 );

			add_action( 'init', [ $this, 'add_builder_support' ], 10 );

			add_action( 'save_post', [ $this, 'save_meta_in_options' ], 99, 1 );
			add_action( 'wp', [ $this, 'render_template' ] );

			add_filter( 'single_template', [ $this, 'single_template' ] );
			
		}

		/**
		 * Register Template Posttype
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function init_content_type() {

			$post_types = array(
				'id'       => 'octagon_templates',
				'name'     => esc_html__( 'My Templates', 'octagon-elements-lite-for-elementor' ),
				'singular' => esc_html__( 'Template', 'octagon-elements-lite-for-elementor' ),
				'labels'   => array(
					'all_items' => esc_html__( 'My Templates', 'octagon-elements-lite-for-elementor' ),
				),
				'options'  => array(
					'menu_icon'    => 'dashicons-star-half',
					'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
					'has_archive'  => 'testimonial-archive',
					'show_in_menu' => 'octagon-intro'
				)
			);

			new Octagon_Core_Post_type( $post_types );

		}

		/**
		 * Register Template Metabox
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function init_metabox() {

			$singular = octagon_post_type_list();

			$taxonomy = octagon_taxonomy_list();

			$fields[] = array(
				'id'          => 'oee_template_type',
				'title'       => esc_html__( 'Type', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Choose type.', 'octagon-elements-lite-for-elementor' ),
				'type'        => 'select',
				'default'     => 'header',
				'options'     => array(
					'header' => esc_html__( 'Header', 'octagon-elements-lite-for-elementor' ),
					'footer' => esc_html__( 'Footer', 'octagon-elements-lite-for-elementor' )
				),
				'class'       => ''
			);

			$options = array(
				'all'             => esc_html__( 'Entire Site', 'octagon-elements-lite-for-elementor' ),
				'front'           => esc_html__( 'Front Page', 'octagon-elements-lite-for-elementor' ),
				'home'            => esc_html__( 'Home', 'octagon-elements-lite-for-elementor' ),
				'search'          => esc_html__( 'Search', 'octagon-elements-lite-for-elementor' ),
				'pages'           => esc_html__( 'All Pages', 'octagon-elements-lite-for-elementor' ),
				'all_singular'    => esc_html__( 'All Singular Posts', 'octagon-elements-lite-for-elementor' ),
				'singular'        => esc_html__( 'Specific Singular Posts', 'octagon-elements-lite-for-elementor' ),
				'singular_id'     => esc_html__( 'Singular ID', 'octagon-elements-lite-for-elementor' ),
				'404'             => esc_html__( 'Error 404', 'octagon-elements-lite-for-elementor' ),
				'all_archives'    => esc_html__( 'All Archives', 'octagon-elements-lite-for-elementor' ),
				'custom_archives' => esc_html__( 'Custom Archives', 'octagon-elements-lite-for-elementor' )
			);

			$fields[] = array(
				'id'             => 'oee_template_condition',
				'title'          => esc_html__( 'Condition', 'octagon-elements-lite-for-elementor' ),
				'description'    => esc_html__( 'Choose condition.', 'octagon-elements-lite-for-elementor' ),
				'type'           => 'select',
				'default'        => 'all',
				'options'        => $options,
				'class'          => ''
			);

			$fields[] = array(
				'id'             => 'oee_template_condition_singular',
				'title'          => esc_html__( 'Condition Singular', 'octagon-elements-lite-for-elementor' ),
				'description'    => esc_html__( 'Choose a singular condition.', 'octagon-elements-lite-for-elementor' ),
				'type'           => 'select2',
				'in_type'        => 'static',
				'allow_multiple' => 'true',
				'options'        => $singular,
				'class'          => ''
			);

			$fields[] = array(
				'id'             => 'oee_template_condition_custom_archives',
				'title'          => esc_html__( 'Condition Custom Archives', 'octagon-elements-lite-for-elementor' ),
				'description'    => esc_html__( 'Choose a specific archives.', 'octagon-elements-lite-for-elementor' ),
				'type'           => 'select2',
				'in_type'        => 'static',
				'allow_multiple' => 'true',
				'options'        => $taxonomy,
				'class'          => ''
			);

			$fields[] = array(
				'id'             => 'oee_template_condition_singular_id',
				'title'          => esc_html__( 'Singular Post ID', 'octagon-elements-lite-for-elementor' ),
				'description'    => esc_html__( 'Choose a specific post ID\'s.', 'octagon-elements-lite-for-elementor' ),
				'type'           => 'select2',
				'in_type'        => 'ajax',
				'callback'       => 'all_singular_posts',
				'allow_multiple' => 'true',
				'class'          => ''
			);

			$fields[] = array(
				'id'          => 'oee_template_state',
				'title'       => esc_html__( 'State', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Do you want active this?.', 'octagon-elements-lite-for-elementor' ),
				'type'        => 'toggle',
				'default'     => 'inactive',
				'options'     => array(
					'active'    => esc_html__( 'Active', 'octagon-elements-lite-for-elementor' ),
					'inactive' => esc_html__( 'Inactive', 'octagon-elements-lite-for-elementor' )
				),
				'class'       => ''
			);

			$template_field[ esc_html__( 'General', 'octagon-elements-lite-for-elementor' ) ] = $fields;

			new Octagon_Core_Metabox( array(
				'id'            => 'octagon_templates_metabox',
				'title'         => esc_html__( 'Conditions', 'octagon-elements-lite-for-elementor' ),
				'content_types' => array( 'octagon_templates' ),
				'show_on_cb'    => true,
				'context'       => 'normal',
				'priority'      => 'high',
				'classes'       => '',
				'fields'		=> $template_field
			) );

		}

		/**
		 * Add builder to Template post type on default
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function add_builder_support() {
			add_post_type_support( 'octagon_templates', 'elementor' );
		}

		/**
		 * Render template
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public static function render_template() {

			$header = self::get_template_id( 'header' );
			$footer = self::get_template_id( 'footer' );

			if( $header || $footer ) {
				add_action( 'get_header', [ $this, 'get_header' ], 99, 1 );
				add_action( 'get_footer', [ $this, 'get_footer' ], 99, 1 );
			}
			
		}

		/**
		 * Replace header template
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  string 	$name 	Header template name
		 * @access public
		 */
		public function get_header( $name ) {

			require plugin_dir_path( __FILE__ ) . '/views/theme-support-header.php';

			$templates = [];
			$name = (string) $name;
			if( '' !== $name ) {
				$templates[] = "header-{$name}.php";
			}

			$templates[] = 'header.php';

			// Avoid running wp_head hooks again
			remove_all_actions( 'wp_head' );
			ob_start();
			// It cause a `require_once` so, in the get_header it self it will not be required again.
			locate_template( $templates, true );
			ob_get_clean();
			
		}

		/**
		 * Replace footer template
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  string 	$name 	Footer template name
		 * @access public
		 */
		public function get_footer( $name ) {

			require plugin_dir_path( __FILE__ ) . '/views/theme-support-footer.php';

			$templates = [];
			$name = (string) $name;
			if( '' !== $name ) {
				$templates[] = "footer-{$name}.php";
			}

			$templates[] = 'footer.php';

			ob_start();
			// It cause a `require_once` so, in the get_header it self it will not be required again.
			locate_template( $templates, true );
			ob_get_clean();
			
		}

		/**
		 * Render template content
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  string 	$template_id 	Custom template post ID
		 * @access public
		 */
		public static function render_content( $template_id ) {

			$elementor = \Elementor\Plugin::instance();
			return $elementor->frontend->get_builder_content_for_display( $template_id );
			
		}

		/**
		 * Single template for octagon template, it loads on elementor front end
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  string 	$template 	Single template
		 * @access public
		 * @return string
		 */
		public function single_template( $template ) {

			if( is_singular( 'octagon_templates' ) ) {
				return OEE_PATH . '/canvas/canvas.php';
			}

			return $template;
		}

		/**
		 * Retrieve template ID
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  string 	$type 	Template type( header, footer )
		 * @access public
		 * @return array|bool
		 */
		public static function get_template_id( $type = 'header' ) {

			$match_found = false;

			self::$id = self::get_id();
			self::$post_type = self::get_post_type();
			self::$taxonomy = self::get_taxonomy();

			self::$template_data = get_option( 'oee_templates', [] );
			self::$template_type = ! empty( self::$template_data[$type] ) ? self::$template_data[$type] : [];

			if( is_archive() ) {
				if( array_key_exists( self::$taxonomy, self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type][self::$taxonomy];
				}
				else if( array_key_exists( 'all_archives', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['all_archives'];
				}
				else if( array_key_exists( 'all', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['all'];
				}
			}
			else if( is_search() ) {
				if( array_key_exists( 'search', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['search'];
				}
				else if( array_key_exists( 'all', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['all'];
				}
			}
			else if( is_home() ) {
				if( array_key_exists( 'home', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['home'];
				}
				else if( array_key_exists( self::$id, self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type][self::$id];
				}
				else if( array_key_exists( 'pages', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['pages'];
				}
				else if( array_key_exists( 'all', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['all'];
				}
			}
			else if( is_page() ) {
				if( array_key_exists( self::$id, self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type][self::$id];
				}
				else if( array_key_exists( 'pages', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['pages'];
				}
				else if( array_key_exists( 'all', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['all'];
				}
			}			
			else if( is_singular() ) {

				if( array_key_exists( self::$id, self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type][self::$id];
				}
				else if( array_key_exists( self::$post_type, self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type][self::$post_type];
				}
				else if( array_key_exists( 'all_singular', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['all_singular'];
				}
				else if( array_key_exists( 'all', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['all'];
				}
			}
			else if( is_404() ) {
				if( array_key_exists( '404', self::$template_type ) ) {
					$match_found[$type] = self::$template_data[$type]['404'];
				}
			}

			return $match_found;
			
		}

		/**
		 * Retreive Post ID
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 * @return string|int
		 */
		public static function get_id() {
		
			if( in_the_loop() ) {
				self::$id = get_the_ID();
			}
			elseif( is_archive() || is_search() ) {
				self::$id = false;
			}
			elseif( is_home() ) {
				self::$id = get_option( 'page_for_posts' );
			}
			else {
				global $wp_query;
				self::$id = $wp_query->get_queried_object_id();
			}

			return self::$id;

		}

		/**
		 * Return post type
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 * @return string
		 */
		public static function get_post_type() {		
			self::$post_type = get_post_type( self::get_id() );

			return self::$post_type;
		}

		/**
		 * Return taxonomy
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 * @return string
		 */
		public static function get_taxonomy() {		
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

			self::$taxonomy = ( null != $term ) ? $term->slug : '';

			return self::$taxonomy;
		}

		/**
		 * Register Template Post type
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function save_meta_in_options( $post_id ) {

			$build = [];

			$args = array(
				'numberposts'         => -1,
				'post_type'           => 'octagon_templates',
				'ignore_sticky_posts' => true,
				'order'               => 'asc',
				'post_status'         => 'publish'
		    );

			$posts = get_posts( $args );

			if( ! empty( $posts ) ) {

				foreach( $posts as $key => $post ) {

					$type                      = get_post_meta( $post->ID, 'oee_template_type', true );
					$state                     = get_post_meta( $post->ID, 'oee_template_state', true );
					$condition                 = get_post_meta( $post->ID, 'oee_template_condition', true );
					$condition_singular        = get_post_meta( $post->ID, 'oee_template_condition_singular', true );
					$condition_custom_archives = get_post_meta( $post->ID, 'oee_template_condition_custom_archives', true );
					$condition_singular_id     = get_post_meta( $post->ID, 'oee_template_condition_singular_id', true );

					if( 'inactive' == $state ) {
						continue;
					}

					if( 'all' == $condition || 'front' == $condition || 'home' == $condition || 'pages' == $condition || 'all_singular' == $condition || '404' == $condition || 'all_archives' == $condition ) {
						$build[$type][$condition] = $post->ID;
					}
					else if( 'singular' == $condition ) {
						foreach( $condition_singular as $key => $post_type ) {
							$build[$type][$post_type] = $post->ID;
						}					
					}
					else if( 'custom_archives' == $condition ) {
						foreach( $condition_custom_archives as $key => $taxonomy ) {
							$build[$type][$taxonomy] = $post->ID;
						}
					}
					else if( 'singular_id' == $condition ) {
						foreach( $condition_singular_id as $key => $id ) {
							$build[$type][$id] = $post->ID;
						}					
					}
					
				}

				update_option( 'oee_templates', $build );
			}			

		}

	}

	new Octagon_Core_Template_Builder;

}
