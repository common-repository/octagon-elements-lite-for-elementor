<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core/icon-manager
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core_Regenerate_Files' ) ) {

	class Octagon_Core_Regenerate_Files extends Octagon_Core_Icon_Manager {

		public $custom_icons = array();

		/**
		 * Generate css/json file for custom icons and upload into the 'wp_upload_dir'
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function init() {

			$this->custom_icons = get_option( 'octagon_custom_icons', true );

			$this->regenerate_css();
			$this->regenerate_json();
		}

		/**
		 * Generate icon css file
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function regenerate_css() {

			if( ! function_exists( 'WP_Filesystem' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			WP_Filesystem();

			global $wp_filesystem;			

			if( ! empty( $this->custom_icons ) ) {

				foreach( $this->custom_icons as $key => $data ) {

					$has_cached = get_option( $data['dir'] .'-css-has-cached' );

					if( $has_cached ) {
						continue;
					}

					$css_file = self::upload_dir() . $data['dir'] .'/icons.css';

					// Print the generated css
					$css  = "/**\n";
					$css .= " * Do not touch this file! This file created by PHP\n";
					$css .= " * Last modified time: ". date( 'M d Y, h:s:i' ) ."\n";
					$css .= " */\n\n\n";
					$css .= "@font-face {\n";
					$css .= "\tfont-family: '" . strtolower( $data['name'] ) . "';\n";
					$css .= "\tsrc: url('" . $data['font_base_url'] . $data['css'] . ".eot?');\n";
					$css .= "\tsrc: url('" . $data['font_base_url'] . $data['css'] . ".eot?#iefix') format('embedded-opentype'),\n";
					$css .= "\t\turl('" . $data['font_base_url'] . $data['css'] . ".woff2?') format('woff2'),\n";
					$css .= "\t\turl('" . $data['font_base_url'] . $data['css'] . ".woff?') format('woff'),\n";
					$css .= "\t\turl('" . $data['font_base_url'] . $data['css'] . ".ttf?') format('truetype'),\n";
					$css .= "\t\turl('" . $data['font_base_url'] . $data['css'] . '.svg?#' . $data['css'] . "') format('svg');\n";
					$css .= "\tfont-weight: normal;\n";
					$css .= "\tfont-style: normal;\n";
					$css .= "}\n";

					$css .= "[class^='". $data['name'] ."']:before, [class*='". $data['name'] ."']:before {\n";
					$css .= "\tfont-family: '". $data['name'] ."' !important;\n";
					$css .= "\tfont-style: normal !important;\n";
					$css .= "\tfont-weight: normal !important;\n";
					$css .= "\tfont-variant: normal !important;\n";
					$css .= "\ttext-transform: none !important;\n";
					$css .= "\tspeak: none;\n";
					$css .= "\tline-height: 1;\n";
					$css .= "\t-webkit-font-smoothing: antialiased;\n";
					$css .= "\t-moz-osx-font-smoothing: grayscale;\n";
					$css .= "}\n";

					$icons = $this->parse_css( $data['css_url'] );

					if( ! empty( $icons ) && is_array( $icons ) ) {
						foreach( $icons as $icon_name => $code ) {
							$css .= '.' . $data['name'] . '-' . $icon_name . ":before { content: '\\" . $code . "'; }\n";
						}
					}

					if( ! $wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE ) ) {
						update_option( $data['dir'] .'-css-has-cached', false );
					}
					else {
						update_option( $data['dir'] .'-css-has-cached', true );
					}
				}
			}

		}

		/**
		 * Generate icon json file, it's necessary for importing icons to a elementor
		 * 
		 * @version  1.0
		 * @since  1.0
		 * @access public
		 */
		public function regenerate_json() {

			if( ! function_exists( 'WP_Filesystem' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			WP_Filesystem();

			global $wp_filesystem;			

			if( ! empty( $this->custom_icons ) ) {

				foreach( $this->custom_icons as $key => $data ) {

					$has_cached = get_option( $data['dir'] .'-json-has-cached' );

					if( $has_cached ) {
						continue;
					}

					$json_file = self::upload_dir() . $data['dir'] .'/icons.json';

					// Print the generated json
					$json = json_encode( ['icons' => $data['icons'] ] );					

					if( ! $wp_filesystem->put_contents( $json_file, $json, FS_CHMOD_FILE ) ) {
						update_option( $data['dir'] .'-json-has-cached', false );
					}
					else {
						update_option( $data['dir'] .'-json-has-cached', true );
					}
				}
			}
		}

	}

}
