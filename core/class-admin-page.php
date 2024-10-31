<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;
	
if( ! class_exists( 'Octagon_Core_Admin_Page' ) ) {

	class Octagon_Core_Admin_Page {

		public $data = [];

		public $error = [];

		public $active_plugins = [];

		public function __construct() {
			add_action( 'admin_menu', [ $this, 'admin_menu' ], 9 );
			
		}

		/**
		 * Set variables
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function set_variable() {

			global $wpdb;

			$this->data['status']['homeurl']        = esc_url( home_url() );
			$this->data['status']['siteurl']        = esc_url( get_option( 'siteurl' ) );
			$this->data['status']['wp_version']     = get_bloginfo( 'version' );
			$this->data['status']['multisite']      = is_multisite() ? esc_html__( 'Yes', 'octagon-elements-lite-for-elementor' ) : esc_html__( 'No', 'octagon-elements-lite-for-elementor' );
			$this->data['status']['memory_limit']   = wp_convert_hr_to_bytes( @ini_get( 'memory_limit' ) );
			$this->data['status']['debug']          = ( WP_DEBUG === true ) ? esc_html__( 'Active', 'octagon-elements-lite-for-elementor' ) : esc_html__( 'Not Active', 'octagon-elements-lite-for-elementor' );
			$this->data['status']['language']       = get_locale();
			$this->data['status']['text_direction'] = is_rtl() ? 'RTL' : 'LTR';
			$this->data['status']['child_theme']    = is_child_theme() ? esc_html__( 'Active', 'octagon-elements-lite-for-elementor' ) : esc_html__( 'Not Active', 'octagon-elements-lite-for-elementor' );			
			$this->data['status']['server']         = function_exists( 'octagon_get_server_info' ) ? octagon_get_server_info() : '';
			$this->data['status']['mysql']          = $wpdb->db_version();
			$this->data['status']['php_version']    = phpversion();
			$this->data['status']['post_max_size']  = wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) );
			$this->data['status']['time_limit']     = ini_get( 'max_execution_time' );
			$this->data['status']['max_input_vars'] = ini_get( 'max_input_vars' );
			$this->data['status']['upload_size']    = size_format( wp_max_upload_size() );
			$this->data['status']['curl']           = extension_loaded( 'curl' ) ? esc_html__( 'Active', 'octagon-elements-lite-for-elementor' ) : esc_html__( 'Not Active', 'octagon-elements-lite-for-elementor' );
			$this->data['status']['dom']            = class_exists( 'DOMDocument' ) ? esc_html__( 'Active', 'octagon-elements-lite-for-elementor' ) : esc_html__( 'Not Active', 'octagon-elements-lite-for-elementor' );
			
			$this->data['override']                 = $this->template_file_check_notice();

		}

		/**
		 * Set status notice
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function set_notice() {

			/* Memory Limit */
			if( 134217728 <= $this->data['status']['memory_limit'] && 268435456 >= $this->data['status']['memory_limit'] ) {
				$this->data['notice']['memory_limit'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-orange">Good</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => ''
				);
			}
			elseif( 536870900 < $this->data['status']['memory_limit'] ) {
				$this->data['notice']['memory_limit'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => ''
				);
			}
			if( 134217727 > $this->data['status']['memory_limit'] ) {
				$this->data['notice']['memory_limit'] = array(
					'title' => esc_html__( 'Memory Limit:', 'octagon-elements-lite-for-elementor' ),
					'value' => size_format( $this->data['status']['memory_limit'] ),
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => wp_kses( __( 'Minimum <strong>128 MB</strong> is required, <strong>256 MB</strong> is recommended.', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ), 'strong' => [] ) )
				);

				$this->add_error_notice( 'status', $this->data['notice']['memory_limit'] );

			}

			/* PHP Version */
			if( version_compare( $this->data['status']['php_version'], '7.0', '<' ) ) {
				$this->data['notice']['php_version'] = array(
					'title' => esc_html__( 'PHP Version:', 'octagon-elements-lite-for-elementor' ),
					'value' => $this->data['status']['php_version'],
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - We recommend using PHP version 7.0 or above for greater performance and security.</span>', 'octagon-elements-lite-for-elementor' ), esc_html( $this->data['status']['php_version'] ) ), array( 'span' => array( 'class' => [] ) ) ),
				);

				$this->add_error_notice( 'status', $this->data['notice']['php_version'] );

			}
			else {
				$this->data['notice']['php_version'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => ''
				);
			}

			/* Post Max Size */
			if( 134217728 > $this->data['status']['post_max_size'] ) {
				$this->data['notice']['post_max_size'] = array(
					'title' => esc_html__( 'Post Max Size:', 'octagon-elements-lite-for-elementor' ),
					'value' => size_format( $this->data['status']['post_max_size'] ),
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => wp_kses( __( '<span class="list-info">Minimum <strong>128 MB</strong> is required, <strong>256 MB</strong> is recommended.</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ), 'strong' => [] ) )
				);

				$this->add_error_notice( 'status', $this->data['notice']['post_max_size'] );

			}
			elseif( 134217728 < $this->data['status']['post_max_size'] && 268435456 >= $this->data['status']['post_max_size'] ) {
				$this->data['notice']['post_max_size'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-orange">Good</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => ''
				);
			}
			elseif( 536870900 < $this->data['status']['post_max_size'] ) {
				$this->data['notice']['post_max_size'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => ''
				);
			}

			/* Time Limit */
			if( 120 > $this->data['status']['time_limit'] ) {
				$this->data['notice']['time_limit'] = array(
					'title' => esc_html__( 'Time Limit:', 'octagon-elements-lite-for-elementor' ),
					'value' => $this->data['status']['time_limit'],
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - is not enough to run this theme properly.</span>', 'octagon-elements-lite-for-elementor' ), esc_html( $this->data['status']['time_limit'] ) ), array( 'span' => array( 'class' => [] ) ) )
				);

				$this->add_error_notice( 'status', $this->data['notice']['time_limit'] );

			}
			elseif( 120 <= $this->data['status']['time_limit'] && 180 > $this->data['status']['time_limit'] ) {
				$this->data['notice']['time_limit'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-orange">Good</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - is OK, But <strong>180</strong> is recommended.</span>', 'octagon-elements-lite-for-elementor' ), esc_html( $this->data['status']['time_limit'] ) ), array( 'span' => array( 'class' => [] ), 'strong' => [] ) )
				);
			}
			elseif( 180 <= $this->data['status']['time_limit'] ) {
				$this->data['notice']['time_limit'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => ''
				);
			}

			/* Max Input Vars */
			if( 2500 > $this->data['status']['max_input_vars'] ) {
				$this->data['notice']['max_input_vars'] = array(
					'title' => esc_html__( 'Max Input Vars:', 'octagon-elements-lite-for-elementor' ),
					'value' => $this->data['status']['max_input_vars'],
					'batch' => wp_kses( __( '<span class="batch batch-red">Critical</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - is not enough to run this theme properly.</span>', 'octagon-elements-lite-for-elementor' ), esc_html( $this->data['status']['max_input_vars'] ) ), array( 'span' => array( 'class' => [] ) ) )
				);

				$this->add_error_notice( 'status', $this->data['notice']['max_input_vars'] );

			}
			elseif( 2500 <= $this->data['status']['max_input_vars'] && 5000 > $this->data['status']['max_input_vars'] ) {
				$this->data['notice']['max_input_vars'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-orange">Good</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => wp_kses( sprintf( __( '<span class="list-info">%s - is OK, But <strong>10000</strong> is recommended.</span>', 'octagon-elements-lite-for-elementor' ), esc_html( $this->data['status']['max_input_vars'] ) ), array( 'span' => array( 'class' => [] ), 'strong' => [] ) )
				);
			}
			elseif( 10000 <= $this->data['status']['max_input_vars'] ) {
				$this->data['notice']['max_input_vars'] = array(
					'batch' => wp_kses( __( '<span class="batch batch-green">Better</span>', 'octagon-elements-lite-for-elementor' ), array( 'span' => array( 'class' => [] ) ) ),
					'info'  => ''
				);
			}

		}

		/**
		 * Set error notice
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function add_error_notice( $key, $notice ) {

			$this->error[$key][] = $notice;

			return $this->error;

		}

		/**
		 * Scan the template files
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public static function scan_template_files( $template_path ) {
			$files  = @scandir( $template_path ); // @codingStandardsIgnoreLine.
			$result = [];

			if( ! empty( $files ) ) {
				foreach ( $files as $key => $value ) {

					if( ! in_array( $value, array( '.', '..' ), true ) ) {

						if( is_dir( $template_path . DIRECTORY_SEPARATOR . $value ) ) {
							$sub_files = self::scan_template_files( $template_path . DIRECTORY_SEPARATOR . $value );
							foreach ( $sub_files as $sub_file ) {
								$result[] = $value . DIRECTORY_SEPARATOR . $sub_file;
							}
						}
						else {
							$result[] = $value;
						}
					}
				}
			}
			return $result;
		}

		/**
		 * Get file version from doc blockr
		 * 
		 * @version 1.0
		 * @since  1.0
		 * @param  string	$file	Path to the file
		 * @access public
		 * @return string
		 */
		public static function get_file_version( $file ) {

			if( ! file_exists( $file ) ) {
				return '';
			}

			if( ! function_exists( 'WP_Filesystem' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			WP_Filesystem();

			global $wp_filesystem;

			$version = '';

			$fp = $wp_filesystem->get_contents( $file );

			// Line endings
			$file_data = str_replace( "\r", "\n", $fp );		

			if( preg_match( '/^[ \t\/*#@]*' . preg_quote( '@version', '/' ) . '(.*)$/mi', $file_data, $match ) && $match[1] ) {
				$version = _cleanup_header_comment( $match[1] );
			}

			return $version;
		}

		/**
		 * Scan the template files
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return array
		 */
		public function template_file_check_notice() {

			$override_files     = false;
			$outdated_templates = false;
			$scan_files         = self::scan_template_files( OEE_PATH . '/shortcodes/' );
			foreach ( $scan_files as $file ) {

				// $located = apply_filters( 'octagon_template', $file, $file, [], octagon_template_path(), octagon_plugin_path() . '/templates/' ); /* TODO: Set a plugin path, then uncomment the line */

				$located = false;

				if( file_exists( $located ) ) {
					$theme_file = $located;
				}
				else if( file_exists( get_stylesheet_directory() . '/shortcodes/' . $file ) ) {
					$theme_file = get_stylesheet_directory() . '/shortcodes/' . $file;
				}
				else if( file_exists( get_template_directory() . '/shortcodes/' . $file ) ) {
					$theme_file = get_template_directory() . '/shortcodes/' . $file;
				}
				else {
					$theme_file = false;
				}

				if ( ! empty( $theme_file ) ) {
					$core_version  = self::get_file_version( OEE_PATH . '/shortcodes/' . $file );
					$theme_version = self::get_file_version( $theme_file );
					if( $core_version && ( empty( $theme_version ) || version_compare( $theme_version, $core_version, '<' ) ) ) {
						if ( ! $outdated_templates ) {
							$outdated_templates = true;
						}
					}
					$override_files[] = array(
						'file'         => str_replace( WP_CONTENT_DIR . '/themes/', '', $theme_file ),
						'version'      => $theme_version,
						'core_version' => $core_version
					);
				}
			}

			return $override_files;
		}



		/**
		 * Admin Menu
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 */
		public function admin_menu() {

			$this->set_variable();
			$this->set_notice();

			add_menu_page( esc_html_x( 'Octagon', 'admin-menu', 'octagon-elements-lite-for-elementor' ), esc_html_x( 'Octagon', 'admin-menu', 'octagon-elements-lite-for-elementor' ), 'administrator', 'octagon-intro', [ $this, 'welcome' ], 'dashicons-admin-generic', 70 );
			
			add_submenu_page( 'octagon-intro', esc_html_x( 'Welcome', 'admin-menu', 'octagon-elements-lite-for-elementor' ), esc_html_x( 'Welcome', 'admin-menu', 'octagon-elements-lite-for-elementor' ), 'administrator', 'octagon-intro', [ $this, 'welcome' ] );
			add_submenu_page( 'octagon-intro', esc_html_x( 'Status', 'admin-menu', 'octagon-elements-lite-for-elementor' ), esc_html_x( 'Status', 'admin-menu', 'octagon-elements-lite-for-elementor' ), 'administrator', 'octagon-status', [ $this, 'status' ] );
			add_submenu_page( 'octagon-intro', esc_html_x( 'Sidebar', 'admin-menu', 'octagon-elements-lite-for-elementor' ), esc_html_x( 'Sidebar', 'admin-menu', 'octagon-elements-lite-for-elementor' ), 'administrator', 'octagon-sidebar', [ $this, 'sidebar' ] );
		}

		/**
		 * Welcome
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function welcome() {
			include_once OCTAGON_CORE_PATH . '/views/html-welcome.php';
		}

		/**
		 * Status
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function status() {
			include_once OCTAGON_CORE_PATH . '/views/html-system-status.php';
		}

		/**
		 * Custom Sidebar
		 * 
		 * @since  1.0
		 */
		public function sidebar() {
			include_once OCTAGON_CORE_PATH . '/views/html-sidebar.php';
		}

	}

	new Octagon_Core_Admin_Page;

}
