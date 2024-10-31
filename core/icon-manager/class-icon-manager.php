<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/icon-manager
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.4
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core_Icon_Manager' ) ) {

	class Octagon_Core_Icon_Manager {

		public static $upload = false;

		public static $upload_dir = false;

		public static $upload_url = false;

		public $css_files = [];

		static public $icons = [];

		public function __construct() {

			self::$upload = wp_upload_dir();

			add_action( 'admin_menu', [ $this, 'admin_menu' ], 99 );

			add_filter( 'upload_mimes', [ $this, 'upload_mimes' ], 10, 1 );

			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

			add_action( 'wp_ajax_icon_manager',  [ $this, 'print_icons' ] );
			add_action( 'wp_ajax_nopriv_icon_manager', [ $this, 'print_icons' ] );

			add_action( 'wp_ajax_regenerate_icon',  [ $this, 'regenerate_icon' ] );
			add_action( 'wp_ajax_delete_icon',  [ $this, 'delete_icon' ] );
			add_action( 'wp_ajax_render_available_icons',  [ $this, 'render_available_icons' ] );
			
		}

		/**
		 * Admin Menu
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function admin_menu() {
			add_submenu_page( 'octagon-intro', esc_html_x( 'Icon Manager', 'admin-menu', 'octagon-elements-lite-for-elementor' ), esc_html_x( 'Icon Manager', 'admin-menu', 'octagon-elements-lite-for-elementor' ), 'administrator', 'octagon-icon-manager', [ $this, 'icon_manager' ] );
		}
		
		/**
		 * Icon Manager admin page
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function icon_manager() {
			include_once OCTAGON_CORE_PATH . '/views/html-icon-manager.php';
		}

		/**
		 * Regenerate Icons
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function regenerate_icon() {

			$result = [];

			if( ! class_exists( 'ZipArchive' ) ) {
				$result['status_save'] = 'failedopen';
				echo json_encode( $result );
				die();
			}

			$archive = isset( $_POST['archive'] ) ? sanitize_text_field( $_POST['archive'] ) : '';

			if( ! empty( $archive ) ) {

				$zip = new ZipArchive;
				$res = $zip->open( get_attached_file( $archive ) );

				if( $res === true ) {

					if( $zip->locateName( basename( get_attached_file( $archive ), '.zip' ) .'/config.json' ) !== false ) {
    					$ex = $zip->extractTo( self::upload_dir() );
						$zip->close();
						if( $ex ) {
							$result = [
								'error'  => false,
								'status' => esc_html__( 'Icon Created successfully.', 'octagon-elements-lite-for-elementor' )
							];
						}
						else {
							$result = [
								'error'  => true,
								'status' => esc_html__( 'Extract failed.', 'octagon-elements-lite-for-elementor' )
							];
						}
    				}
    				else {
    					$result = [
							'error'  => true,
							'status' => esc_html__( 'Wrong archive uploaded.', 'octagon-elements-lite-for-elementor' )
						];
    				}
				}
				else {
					$result = [
						'error'  => true,
						'status' => esc_html__( 'Can\'t open the file.', 'octagon-elements-lite-for-elementor' )
					];
				}

				echo json_encode( $result );

				$data = $this->configure_icons_data();

				if( $data ) {

					if( ! class_exists( 'Octagon_Core_Regenerate_Files' ) ) {
						include_once OCTAGON_CORE_PATH . 'icon-manager/class-regenerate-files.php';
					}

					$regen = new Octagon_Core_Regenerate_Files();
					$regen->init();
				}

			}

			die();

		}

		/**
		 * Delete selected icon library
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function delete_icon() {

			$icon = isset( $_POST['icon'] ) ? sanitize_text_field( $_POST['icon'] ) : '';

			if( ! empty( $icon ) ) {
				$custom_icons = get_option( 'octagon_custom_icons', array() );

				if( array_key_exists( $icon, $custom_icons ) ) {

					self::delete_files( self::upload_dir() . $custom_icons[$icon]['dir'] );

					update_option( $custom_icons[$icon]['dir'] .'-css-has-cached', '' );
					update_option( $custom_icons[$icon]['dir'] .'-json-has-cached', '' );

					unset( $custom_icons[$icon] );
					update_option( 'octagon_custom_icons', $custom_icons );

					$result = [
						'error'  => false,
						'status' => esc_html__( 'Font deleted succesfully.', 'octagon-elements-lite-for-elementor' )
					];
				}
				else {
					$result = [
						'error'  => true,
						'status' => esc_html__( 'Library not exist.', 'octagon-elements-lite-for-elementor' )
					];
				}
			}
			else {
				$result = [
					'error'  => true,
					'status' => esc_html__( 'Please select the icon.', 'octagon-elements-lite-for-elementor' )
				];
			}

			echo json_encode( $result );

			die();

		}

		/**
		 * Return available icons
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function render_available_icons() {

			
			$active_icon_set = get_option( 'octagon_icon_set', [] );

			$custom_icon_set = get_option( 'octagon_custom_icons', array() );

			if( isset( $custom_icon_set ) ) : 
				foreach( $custom_icon_set as $key => $icons ) :

					if( ! file_exists( Octagon_Core_Icon_Manager::upload_dir() . $icons['dir'] .'/icons.css' ) ) :
						continue;
					endif;

					if( in_array( $key, $active_icon_set ) ) :
						$active = 'active';
						$in_active = 'in-active';
						$checked = 'checked="checked"';
					else :
						$active = 'in-active';
						$in_active = 'active';
						$checked = '';
					endif;
					?>

					<div class="toggle-switch custom-icons">
						<span class="remove-icon remove-custom-icon" data-id="<?php echo esc_attr( $key ); ?>"><div class="loader"><div></div></div>x</span>
						<p><?php echo esc_html( ucwords( $icons['name'] ) ); ?></p>
						<div class="toggle">
							<input type="checkbox" name="icon_set[]" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $checked ); ?>>
							<span data-value="<?php echo esc_attr( $key ); ?>" class="<?php echo esc_attr( $active ); ?>"><?php esc_html_e( 'Yes', 'octagon-elements-lite-for-elementor' ); ?></span>
							<span data-value="" class="<?php echo esc_attr( $in_active ); ?>"><?php esc_html_e( 'No', 'octagon-elements-lite-for-elementor' ); ?></span>
						</div>						
					</div>

					<?php
				endforeach;
			endif;

			die();

		}

		/**
		 * Configure icons data
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function configure_icons_data() {

			$data = [];

			$files = glob( self::upload_dir() . '/*/*.json' );

			if( ! empty( $files ) && is_array( $files ) ) {
				foreach ( $files as $key => $file ) {

					$data['dir'] = basename( dirname( $file ) );

					if( strpos( $file, 'config.json' ) !== false ) {

						$file_info = json_decode( file_get_contents( $file ) );
						
						$data['name']       = ! empty( $file_info->name ) ? strtolower( trim( $file_info->name ) ) : strtolower( $data['dir'] );
						$data['label']      = ucwords( str_replace( '-', ' ', $data['name'] ) );
						$data['prefix']     = ! empty( $file_info->css_prefix_text ) ? trim( $file_info->css_prefix_text ) : '';
						$data['css']        = ! empty( $file_info->name ) ? trim( $file_info->name ) : 'fontello';
						$data['label_icon'] = $data['name'] . '-' . $data['icons'][0];

						$glyphs = wp_list_pluck( $file_info->glyphs, 'css' );
						foreach( $glyphs as $key => $glyph ) {
							$icons[] = $data['prefix'] . $glyph;
						}

						$data['icons'] = $icons;
					}

					if( file_exists( self::upload_dir() . $data['dir'] . '/css/'. $data['css'] . '.css' ) ) {
						$data['css_url'] = self::upload_url() . $data['dir'] . '/css/'. $data['css'] . '.css';
					}

					if( is_dir( self::upload_dir() . $data['dir'] . '/font/' ) ) {
						$data['font_base_url'] = self::upload_url() . $data['dir'] . '/font/';
					}

					$this->save_data( $data );
					
				}

				return true;
			}
			
			return false;
			
		}

		/**
		 * Save font data in options
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  array 	$font_data 	Icon details( name, label, prefix, css_url, font_base_url )
		 * @access public
		 */
		public function save_data( $font_data = [] ) {

			$response = false;

			$custom_icons = get_option( 'octagon_custom_icons', array() );

			if( empty( $custom_icons ) || ! is_array( $custom_icons ) ) {
				$custom_icons = [];
			}

			if( array_key_exists( $font_data['name'], $custom_icons ) ) {
				$response['status'] = esc_html__( 'Font already exist.', 'octagon-elements-lite-for-elementor' );
				return $response;
			}
			else {
				$custom_icons[$font_data['name']] = $font_data;
				update_option( 'octagon_custom_icons', $custom_icons );
				$response['status'] = esc_html__( 'Font created succesfully.', 'octagon-elements-lite-for-elementor' );
			}

			return $response;
		}

		/**
		 * Returns icon class name and it's code parse from CSS file
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  string 	$file 	CSS file path
		 * @access public
		 */
		public function parse_css( $file = '' ) {

			if( ! function_exists( 'WP_Filesystem' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			WP_Filesystem();

			global $wp_filesystem;

			$css_source = $wp_filesystem->get_contents( $file );

			$icons = array();

			preg_match_all( "/\.(.*?):\w*?\s*?{?\s*?{\s*?\w*?:\s*?\'\\\\?(\w*?)\'.*?}/", $css_source, $matches, PREG_SET_ORDER, 0 );

			foreach( $matches as $match ) {
				$icons[ $match[1] ] = $match[2];
			}

			return $icons;

		}

		/**
		 * Returns icon set
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 * @return array
		 */
		public static function get_icon_set() {

			self::$icons = array(
				'octagon-basic' => array(
					'name'          => 'octagon-basic',
					'label'         => esc_html__( 'Octagon - Basic', 'octagon-elements-lite-for-elementor' ),
					'url'           => OCTAGON_CORE_URL .'assets/css/icon-basic.css',
					'enqueue'       => false,
					'prefix'        => 'oct-basic-',
					'displayPrefix' => 'oct-basic',
					'labelIcon'     => 'oct-basic-camera',
					'ver'           => '1.0',
					'fetchJson'     => OCTAGON_CORE_URL .'assets/js/icon-basic.js',
					'native'        => false
				),
				'octagon-social' => array(
					'name'          => 'octagon-social',
					'label'         => esc_html__( 'Octagon - Social', 'octagon-elements-lite-for-elementor' ),
					'url'           => OCTAGON_CORE_URL .'assets/css/icon-social.css',
					'enqueue'       => false,
					'prefix'        => 'oct-social-',
					'displayPrefix' => 'oct-social',
					'labelIcon'     => 'oct-social-facebook',
					'ver'           => '1.0',
					'fetchJson'     => OCTAGON_CORE_URL .'assets/js/icon-social.js',
					'native'        => false
				)
			);

			self::$icons = apply_filters( 'octagon_icons_list', self::$icons );

			// It helps to retrieve icons globally
			return self::$icons;
		}

		/**
		 * Adding exceptions for additional file types
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 * @return array
		 */
		public function upload_mimes( $mime_types = [] ) {
			$mime_types['zip'] = 'application/zip';
    		return $mime_types;
		}

		/**
		 * Helps to delete files and directory
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param  string	$target 	File/Folder path
		 * @access public
		 */
		public static function delete_files( $target = '' ) {
			if( is_dir( $target ) ) {
				$files = glob( $target . '*', GLOB_MARK );

				foreach( $files as $file ){
					self::delete_files( $file );      
				}
				rmdir( $target );
			}
			elseif( is_file( $target ) ) {
				unlink( $target );  
			}
		}

		/**
		 * Print icon select content
		 * 
		 * @version 1.2 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function print_icons() {

			$value = isset( $_POST['value'] ) ? sanitize_html_class( $_POST['value'] ) : '';
			
			$icons = $this->initialize_icons( $value );

			$allowed_html = array(
				'select' => array(),
				'option' => array(
					'value' => array()
				),
				'div' => array(
					'class' => array()
				),
				'i' => array(
					'class' => array()
				)
			);

			echo wp_kses( $icons, $allowed_html );

			die();
		}

		/**
		 * Return icon select content
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function initialize_icons( $css_files = [], $value = '' ) {

			$icon_set = $this->active_icon_set_data();

			$tab_list = $tab_content = $icons_html = '';

			$tab_list_open = '<select>';
			$tab_list_close = '</select>';

			$i = 0; foreach( $icon_set as $key => $data ) {

				$tab_list .= '<option value="'. esc_attr( $key ) .'">'. esc_html( $data['label'] ) .'</option>';

				$tab_content .= $this->get_icons( $i, $key, $data['url'], $value );

			$i++; }

			if( count( $icon_set ) > 1 ) {
				$icons_html .= $tab_list_open . $tab_list . $tab_list_close;
			}
			
			$icons_html .= $tab_content;

			return $icons_html;

		}

		/**
		 * Return icon select selected icons tab content
		 * 
		 * @version 1.4 
		 * @since 1.0
		 * @access public
		 * @return  mixed
		 */
		public function get_icons( $i = 0, $key = '', $file = '', $active_value = '' ) {

			if( empty( $file ) ) {
				return;
			}

			$active = ( 0 == $i ) ? 'active' : '';

			$tab_content = '<div class="'. esc_attr( octagon_change_case( $key ) .' icon-content '. $active ) .'">';

			$icons = $this->parse_css( $file );

			if( ! empty( $icons ) && is_array( $icons ) ) {

				foreach( $icons as $icon_class => $code ) {
					$active_class = ( $icon_class == $active_value ) ? 'active' : '';
					$tab_content .= '<i class="'. esc_attr( octagon_change_case( $icon_class )  .' '. $active_class ) .'"></i>';
				}
			}

			$tab_content .= '</div>';

			return $tab_content;

		}

		/**
		 * Retrieves active icons details
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 * @return array
		 */
		public function active_icon_set_data() {

			$icon_set = [];

			$active_icon_set = get_option( 'octagon_icon_set', [] );

			// Default Icons
			foreach( self::get_icon_set() as $id => $data ) {
				if( in_array( $id, $active_icon_set ) ) {
					$icon_set[$id]['id'] = $id;
					$icon_set[$id]['label'] = $data['label'];
					$icon_set[$id]['url'] = $data['url'];
				}
			}

			// Custom Icons
			$custom_icons = get_option( 'octagon_custom_icons', true );

			if( ! empty( $custom_icons ) && is_array( $custom_icons ) ) {
				foreach( $custom_icons as $id => $data ) {
					if( in_array( $id, $active_icon_set ) ) {
						$icon_set[$id]['id'] = $data['name'];
						$icon_set[$id]['label'] = $data['label'];
						$icon_set[$id]['url'] = self::upload_url() . $data['dir'] .'/icons.css';
					}
				}
			}			

			return $icon_set;
		}

		/**
		 * Enqueue CSS
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @access public
		 */
		public function enqueue_scripts() {

			$icon_set = $this->active_icon_set_data();

			foreach( $icon_set as $id => $data ) {
				wp_enqueue_style( $id, $data['url'], array() , '1.0', 'all' );
			}

		}

		/**
		 * Return Upload directory path
		 * 
		 * @version 1.0 
		 * @since  1.0
		 * @access public
		 * @return string
		 */
		public static function upload_dir() {
			return self::$upload['basedir'] .'/octagon/custom-icons/';
		}

		/**
		 * Return Upload directory url
		 * 
		 * @version 1.0 
		 * @since  1.0
		 * @access public
		 * @return string
		 */
		public static function upload_url() {
			return self::$upload['baseurl'] .'/octagon/custom-icons/';
		}

	}

	new Octagon_Core_Icon_Manager;

}
