<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core_Taxonomy_Image' ) ) {

	class Octagon_Core_Taxonomy_Image {

		public function __construct() {
			add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );			
		}
		
		/**
		 * Hooks for adding/editing cutom taxonomy fields
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param int $attachment_id  Attachment ID
		 * @access public
		 * @return mixed
		 */
		public function theme_setup() {

			$taxonomy_image_lists = apply_filters( 'octagon_taxonomy_image_lists', array( 'category' ) );

			foreach( $taxonomy_image_lists as $key => $taxonomy ) {
				add_action( $taxonomy.'_add_form_fields', [ $this, 'add_field' ], 10, 2 );
				add_action( $taxonomy.'_edit_form_fields', [ $this, 'edit_field' ], 10, 2 );
				add_action( 'edited_'.$taxonomy, [ $this, 'save_taxonomy_fields' ], 10, 2 );  
				add_action( 'create_'.$taxonomy, [ $this, 'save_taxonomy_fields' ], 10, 2 );
			}

		}

		/**
		 * Taxonomy image field
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * @access public
		 * @return mixed
		 */
		public function add_field( $term ) {
			?>

			<div class="custom-media-upload image" data-type="image" data-allow-multiple="false">
				<input type="hidden" name="taxonomy_options['image_id']" value="" class="media-upload-image">
				<div class="media-lists"></div>
				<a href="#" class="custom-media-upload-btn button button-primary button-medium"><?php esc_html_e( 'Upload', 'octagon-elements-lite-for-elementor' ); ?></a>
			</div>

			<?php
		}

		/**
		 * Taxonomy image field in edit.php
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param object $term  Term object
		 * @access public
		 * @return mixed
		 */
		public function edit_field( $term ) {

			$term_id = $term->term_id;		 
			
			$term_meta    = get_option( 'taxonomy_options'.$term_id );
			$image_id     = isset( $term_meta['image_id'] ) ? $term_meta['image_id'] : '';
			$preview_html = ( ! empty( $image_id ) ) ? $this->get_media_preview( $image_id, 'image' ) : '';

			?>

			<tr class="form-field">
				<th scope="row"><label><?php esc_html_e( 'Taxonomy Image', 'octagon-elements-lite-for-elementor' ); ?></label></th>
				<td>
					<div class="custom-media-upload image" data-type="image" data-allow-multiple="false">
						<input type="hidden" name="taxonomy_options[image_id]" value="<?php echo esc_attr( $image_id ); ?>" class="media-upload-image">
						<div class="media-lists"><?php echo wp_kses( $preview_html, array( 'div' => array( 'class' => [] ), 'img' => array( 'src' => [] ), 'span' => array( 'class' => [], 'data-id' => [] ) ) ); ?></div>
						<a href="#" class="custom-media-upload-btn button button-primary button-medium"><?php esc_html_e( 'Upload', 'octagon-elements-lite-for-elementor' ); ?></a>
					</div>
				</td>
			</tr>

			<?php
		}

		/**
		 * Save additional taxonomy image field
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param int $term_id  Term ID
		 * @access public
		 */
		public function save_taxonomy_fields( $term_id ) {

			if( isset( $_POST['taxonomy_options'] ) ) {

				$cat_keys = array_keys( $_POST['taxonomy_options'] );

				foreach( $cat_keys as $key ) {
					if( 'image_id' == $key ) {
						$taxonomy_options[$key] = isset( $_POST['taxonomy_options'][$key] ) ? absint( $_POST['taxonomy_options'][$key] ) : '';
					}					
				}

				update_option( 'taxonomy_options'.$term_id, $taxonomy_options );
			}

		}

		/**
		 * Get taxonomy image media preview on page load
		 * 
		 * @version 1.0 
		 * @since 1.0
		 * @param int $attachment_id  Attachment ID
		 * @access public
		 * @return mixed
		 */
		public function get_media_preview( $attachment_id ) {

			$html = '';

			if( ! empty( $attachment_id ) ) {

				$attachment_id = explode( ',', $attachment_id );

				foreach( $attachment_id as $key => $id ) {

					$image = wp_get_attachment_image_src( $id, 'thumbnail', false );
					$html .= '<div class="media">';
						$html .= '<img src="'. esc_url( $image[0] ) .'">';
						$html .= '<span class="remove-icon remove-custom-media" data-id="'. esc_attr( $id ) .'">x</span>';
					$html .= '</div>';

				}

			}

			return $html;

		}

	}

	new Octagon_Core_Taxonomy_Image;

}
