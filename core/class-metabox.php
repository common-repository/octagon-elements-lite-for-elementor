<?php
/**
 *
 * @package octagon-elements-lite-for-elementor/core
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.4
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'Octagon_Core_Metabox' ) ) {

	class Octagon_Core_Metabox {

		public function __construct( $args ) {

			$this->args = $args;

			add_action( 'add_meta_boxes', [ $this, 'register_metabox' ], 10, 2 );
			add_action( 'save_post', [ $this,'save_metabox' ] );
			
		}

		/**
         * Register a Meta box
         * 
         * @version 1.0 
         * @since 1.0
         * @access public
         */
		public function register_metabox() {				

			$this->fields = $this->args['fields'];

			foreach( $this->args['content_types'] as $key => $types ) {

				add_meta_box( 
					$this->args['id'],
					$this->args['title'],
					[ $this, 'metabox_content' ],
			        $types,
			        $this->args['context'],
			        $this->args['priority']
			    );

			}
			
		}

		/**
         * Print a Meta box content
         * 
         * @version 1.4 
         * @since 1.0
         * @access public
         * @return mixed
         */
		public function metabox_content( $post ) {

			// We'll use this nonce field later on when saving.
    		wp_nonce_field( 'meta_box_nonce', 'meta_box_nonce' );

			$nav = $nav_html = $content_html = '';

			$this->post_id = $post->ID;

			$field_groups = $this->fields;
			$field_groups_count = count( $field_groups );

			$i = 0; foreach( $field_groups as $key => $group ) {

				$active = ( 0 == $i ) ? 'active' : '';

				if( 1 < $field_groups_count ) {
					$nav .= sprintf( 
						'<li class="tabmenu %3$s" data-tab="%2$s">%1$s</li>',
						esc_html( $key ),
						esc_attr( octagon_change_case( $key ) ),
						esc_attr( $active )
					);
				}

				$content_html .= sprintf( 
					'<div class="group %s %s">
						%s
					</div>',
					esc_attr( octagon_change_case( $key ) ),
					esc_attr( $active ),
					$this->field_groups( $group )
				);
				
			$i++; }

			if( '' != $nav ) {
				$nav_html .= sprintf( 
					'<div class="metabox-nav">
						<ul>%s</ul>
					</div>',
					$nav
				);
			}

			echo sprintf( 
				'<div class="metabox-cover">
					%s
					<div class="metabox-groups">
						%s
					</div>
				</div>',
				$nav_html,
				$content_html
			);
			
		}

		/**
         * It generates the all the fields group
         * 
         * @version 1.0 
         * @since 1.0
         * @access public
         * @return mixed
         */
		private function field_groups( $group ) {

			$field_html = '';

			foreach( $group as $key => $field ) {
				$field_html .= $this->field_set( $field );
			}

			return $field_html;
			
		}

		/**
         * It helps to generate the field set and it calls the each fields based on type
         * 
         * @version 1.4 
         * @since 1.0
         * @access public
         * @return mixed
         */
		private function field_set( $field = [], $set_value = '' ) {

			$id          = isset( $field['id'] ) ? $field['id'] : '';
			$class       = isset( $field['class'] ) ? $field['class'] : '';
			$title       = isset( $field['title'] ) ? $field['title'] : esc_html__( 'Title', 'octagon-elements-lite-for-elementor' );
			$description = isset( $field['description'] ) ? $field['description'] : '';
			$type        = isset( $field['type'] ) ? $field['type'] : '';

			return sprintf( 
				'<div class="field field-%3$s %1$s" data-id="%2$s" data-type="%3$s">
					<div class="left-side"><h3 class="field-title">%4$s</h3>%5$s</div>
					<div class="right-side">%6$s</div>
				</div>',
				esc_attr( octagon_change_case( $class ) ),
				esc_attr( $id ),
				esc_attr( $type ),
				esc_html( $title ),
				! empty( $description ) ? '<p class="field-description">'. esc_html( $description ) .'</p>' : '',
				$this->{$field['type']}( $field, $set_value )
			);
			
		}

		/**
         * Return text fields
         * ( content, tel, email, url )
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function text( $field = [], $set_value = '' ) {

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$in_type = isset( $field['in_type'] ) ? $field['in_type'] : 'content';
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			return sprintf( 
				'<input type="text" name="%s" value="%s" class="textfield %s">',
				esc_attr( $id ),
				esc_attr( $value ),
				esc_attr( $class )
			);
			
		}

		/**
         * Return textarea fields
         * ( allow_html, no_html )
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function textarea( $field = [], $set_value = '' ) {

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$in_type = isset( $field['in_type'] ) ? $field['in_type'] : 'allow_html';
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			if( 'allow_html' == $in_type ) {
				$value = wp_kses( $value, octagon_allowed_html_tags() );
			}
			elseif( 'no_html' == $in_type ) {
				$value = esc_html( $value );
			}

			return sprintf( 
				'<textarea type="text" name="%s" class="textarea %s %s">%s</textarea>',
				esc_attr( $id ),				
				esc_attr( $in_type ),
				esc_attr( $class ),
				$value
			);
			
		}

		/**
         * Return number fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function number( $field = [], $set_value = '' ) {

			$id    = isset( $field['id'] ) ? $field['id'] : '';
			$class = isset( $field['class'] ) ? $field['class'] : '';
			$min   = isset( $field['min'] ) ? $field['min'] : 0;
			$max   = isset( $field['max'] ) ? $field['max'] : 10;
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			return sprintf( 
				'<input type="number" name="%1$s" value="%2$s" min="%3$s" max="%4$s" class="textfield %5$s">',
				esc_attr( $id ),
				esc_attr( $value ),
				esc_attr( $min ),
				esc_attr( $max ),
				esc_attr( $class )
			);
			
		}

		/**
         * Return toggle fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function toggle( $field = [], $set_value = '' ) {

			$options_html = '';

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			if( ! empty( $options ) ) {
				foreach( $options as $option => $label ) {

					$options_html .= sprintf( 
						'<span data-value="%1$s" class="%3$s">%2$s</span>',
						esc_attr( $option ),
						esc_html( $label ),							
						esc_attr( $this->get_toggle_attr( $value, $option ) )
					);

				}

				return sprintf( 
					'<div class="toggle">
						<input type="hidden" name="%1$s" value="%3$s" class="toggle-input %4$s">%2$s
					</div>',
					esc_attr( $id ),
					wp_kses( $options_html, array( 'span' => array( 'class' => [], 'data-value' => [] ) ) ),
					esc_attr( $value ),
					esc_attr( $class )
				);
			}
			
			return $options_html;
			
		}

		/**
         * Return radio image fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function radio_image( $field = [], $set_value = '' ) {

			$options_html = '';

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			if( ! empty( $options ) ) {
				foreach( $options as $option => $img_src ) {

					$options_html .= sprintf( 
						'<span data-value="%1$s" class="%3$s"><img src="%2$s"></span>',
						esc_attr( $option ),
						esc_url( $img_src ),							
						esc_attr( $this->get_radio_image_attr( $value, $option ) )
					);

				}

				return sprintf( 
					'<div class="radio-image">
						<input type="hidden" name="%1$s" value="%3$s" class="radio-image-input %4$s">%2$s
					</div>',
					esc_attr( $id ),
					wp_kses( $options_html, array( 'span' => array( 'class' => [], 'data-value' => [] ), 'img' => array( 'src' => [] ) ) ),
					esc_attr( $value ),
					esc_attr( $class )
				);
			}
			
			return $options_html;
			
		}

		/**
         * Return color fields
         * ( hex, alpha )
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function color( $field = [], $set_value = '' ) {

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$in_type = isset( $field['in_type'] ) ? $field['in_type'] : 'hex';
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			return sprintf( 
				'<input type="text" name="%s" value="%s" data-alpha="%s" class="color-field %s">',
				esc_attr( $id ),
				esc_attr( $value ),
				( 'alpha' == $in_type ) ? true : false,
				esc_attr( $class )
			);
			
		}

		/**
         * Return media upload fields
         * ( image, audio, video,text, application )
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function media_upload( $field = [], $set_value = '' ) {

			$id             = isset( $field['id'] ) ? $field['id'] : '';
			$class          = isset( $field['class'] ) ? $field['class'] : '';
			$in_type        = isset( $field['in_type'] ) ? $field['in_type'] : 'image';
			$allow_multiple = isset( $field['allow_multiple'] ) ? $field['allow_multiple'] : false;
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			$preview_html = ( ! empty( $value ) ) ? octagon_get_media_preview( $value, $in_type ) : '';
			

			return sprintf( 
				'<div class="custom-media-upload %1$s" data-type="%1$s" data-allow-multiple="%2$s">
					<input type="hidden" name="%3$s" value="%4$s" class="%5$s %6$s">
					<div class="media-lists">
						%7$s
					</div>
					<a href="#" class="custom-media-upload-btn button button-primary button-medium">%8$s</a>
				</div>',
				esc_attr( $in_type ),
				esc_attr( $allow_multiple ),
				esc_attr( $id ),
				esc_attr( $value ),				
				esc_attr( 'media-upload-'.$in_type ),
				esc_attr( $class ),
				wp_kses( $preview_html, array( 'div' => array( 'class' => [] ), 'img' => array( 'src' => [] ), 'span' => array( 'class' => [], 'data-id' => [] ) ) ),
				esc_html__( 'Upload', 'octagon-elements-lite-for-elementor' )
			);
			
		}

		/**
         * Return radio fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function radio( $field = [], $set_value = '' ) {

			$options_html = '';

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			if( ! empty( $options ) ) {
				foreach( $options as $option => $label ) {

					$options_html .= sprintf( 
						'<p class="radio-field"><input id="%3$s" type="radio" name="%1$s" value="%2$s" class="radio %6$s" %5$s><label for="%3$s">%4$s</label></p>',
						esc_attr( $id ),
						esc_attr( $option ),
						esc_attr( $id . $option ),
						esc_html( $label ),							
						esc_attr( checked( $value, $option, false ) ),
						esc_attr( $class )
					);
				}
			}
			
			return $options_html;
			
		}

		/**
         * Return select fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function select( $field = [], $set_value = '' ) {

			$options_html = '';

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			if( ! empty( $options ) ) {
				foreach( $options as $option => $label ) {

					$options_html .= sprintf( 
						'<option value="%1$s" %3$s>%2$s</option>',
						esc_attr( $option ),
						esc_html( $label ),							
						esc_attr( selected( $value, $option, false ) )
					);

				}

				return sprintf( 
					'<select name="%1$s" class="select %3$s">%2$s</select>',
					esc_attr( $id ),
					wp_kses( $options_html, array( 'option' => array( 'value' => [], 'selected' => [] ) ) ),
					esc_attr( $class )
				);
			}
			
			return $options_html;
			
		}

		/**
         * Return select2 fields
         * ( static, ajax )
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function select2( $field = [], $set_value = '' ) {

			$options_html = '';

			$key            = isset( $field['id'] ) ? $field['id'] : '';
			$allow_multiple = isset( $field['allow_multiple'] ) ? $field['allow_multiple'] : false;
			$id             = ( $allow_multiple ) ? $key .'[]' : $key;
			$class          = isset( $field['class'] ) ? $field['class'] : '';
			$in_type        = isset( $field['in_type'] ) ? $field['in_type'] : 'static';
			$callback       = isset( $field['callback'] ) ? $field['callback'] : '';
			$options        = isset( $field['options'] ) ? $field['options'] : [];
			$value          = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			if( 'static' == $in_type && ! empty( $options ) ) {

				foreach( $options as $option => $label ) {

					$options_html .= sprintf( 
						'<option value="%1$s">%2$s</option>',
						esc_attr( $option ),
						esc_html( $label )
					);

				}

				return sprintf( 
					"<select name='%s' class='select select2 %s' data-type='%s' data-allow-multiple='%s' data-selected='%s'>%s</select>",
					esc_attr( $id ),
					esc_attr( $class ),
					esc_attr( $in_type ),
					esc_attr( $allow_multiple ),
					json_encode( $value ),
					$options_html
				);

			}
			else if( 'ajax' == $in_type && ! empty( $callback ) ) {

				return sprintf( 
					"<select name='%s' class='select select2 %s' data-post-id='%s' data-key='%s' data-type='%s' data-allow-multiple='%s' data-callback='%s'></select>",
					esc_attr( $id ),
					esc_attr( $class ),
					esc_attr( $this->post_id ),
					esc_attr( $key ),
					esc_attr( $in_type ),
					esc_attr( $allow_multiple ),
					esc_attr( $callback )
				);

			}
			
			return false;
			
		}

		/**
         * Return checkbox fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function checkbox( $field = [], $set_value = '' ) {

			$options_html = '';

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			if( ! empty( $options ) ) {
				foreach( $options as $option => $label ) {

					$options_html .= sprintf( 
						'<p class="checkbox-field"><input id="%3$s" type="checkbox" name="%1$s[]" value="%2$s" class="checkbox %6$s" %5$s><label for="%3$s">%4$s</label></p>',
						esc_attr( $id ),
						esc_attr( $option ),
						esc_attr( $id . $option ),
						esc_html( $label ),							
						esc_attr( $this->get_checkbox_attr( $value, $option ) ),
						esc_attr( $class )
					);
				}
			}
			
			return $options_html;
			
		}

		/**
         * Return background fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function background( $field = [], $set_value = '' ) {

			$background_html = '';

			$id             = isset( $field['id'] ) ? $field['id'] : '';
			$class          = isset( $field['class'] ) ? $field['class'] : '';
			$allow_property = isset( $field['allow_property'] ) ? $field['allow_property'] : array( 'image', 'çolor', 'repeat', 'position', 'size', 'attachment' );
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			$value['image']      = isset( $value['image'] ) ? $value['image'] : '';
			$value['color']      = isset( $value['color'] ) ? $value['color'] : '';
			$value['repeat']     = isset( $value['repeat'] ) ? $value['repeat'] : 'no-repeat';
			$value['position']   = isset( $value['position'] ) ? $value['position'] : 'left top';
			$value['size']       = isset( $value['size'] ) ? $value['size'] : '';
			$value['attachment'] = isset( $value['attachment'] ) ? $value['attachment'] : '';

			$preview_html = ( ! empty( $value ) ) ? octagon_get_media_preview( $value['image'], 'image' ) : '';			

			if( in_array( 'color', $allow_property ) ) {
				$background_html .= sprintf( 
					'<div class="background-field"><input type="text" name="%s[color]" value="%s" data-alpha="true" class="color-field %s"></div>',
					esc_attr( $id ),
					esc_attr( $value['color'] ),
					esc_attr( $class )
				);
			}

			if( in_array( 'image', $allow_property ) ) {
				$background_html .= sprintf( 
					'<div class="background-field custom-media-upload image" data-type="image" data-allow-multiple="false">
						<input type="hidden" name="%s[image]" value="%s" class="media-upload-image %s">
						<div class="media-lists">
							%s
						</div>
						<a href="#" class="custom-media-upload-btn button button-primary button-medium">%s</a>
					</div>',
					esc_attr( $id ),
					esc_attr( $value['image'] ),
					esc_attr( $class ),
					wp_kses( $preview_html, array( 'div' => array( 'class' => [] ), 'img' => array( 'src' => [] ), 'span' => array( 'class' => [], 'data-id' => [] ) ) ),
					esc_html__( 'Upload', 'octagon-elements-lite-for-elementor' )
				);
			}

			if( in_array( 'repeat', $allow_property ) ) {
				$background_html .= sprintf( 
					'<div class="background-field">
						<select name="%1$s[repeat]" class="select %2$s">
							<option value="no-repeat" '. esc_attr( selected( $value['repeat'], 'no-repeat', false ) ) .'>'. esc_html__( 'No Repeat', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="repeat" '. esc_attr( selected( $value['repeat'], 'repeat', false ) ) .'>'. esc_html__( 'Repeat', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="repeat-x" '. esc_attr( selected( $value['repeat'], 'repeat-x', false ) ) .'>'. esc_html__( 'Repeat X', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="repeat-y" '. esc_attr( selected( $value['repeat'], 'repeat-y', false ) ) .'>'. esc_html__( 'Repeat Y', 'octagon-elements-lite-for-elementor' ) .'</option>
						</select>
					</div>',
					esc_attr( $id ),
					esc_attr( $class )
				);
			}

			if( in_array( 'position', $allow_property ) ) {
				$background_html .= sprintf( 
					'<div class="background-field">
						<select name="%1$s[position]" class="select %2$s">
							<option value="left top" '. esc_attr( selected( $value['position'], 'left top', false ) ) .'>'. esc_html__( 'Left Top', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="left center" '. esc_attr( selected( $value['position'], 'left center', false ) ) .'>'. esc_html__( 'Left Center', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="left bottom" '. esc_attr( selected( $value['position'], 'left bottom', false ) ) .'>'. esc_html__( 'Left Bottom', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="right top" '. esc_attr( selected( $value['position'], 'right top', false ) ) .'>'. esc_html__( 'Right Top', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="right center" '. esc_attr( selected( $value['position'], 'right center', false ) ) .'>'. esc_html__( 'Right Center', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="right bottom" '. esc_attr( selected( $value['position'], 'right bottom', false ) ) .'>'. esc_html__( 'Right Bottom', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="center top" '. esc_attr( selected( $value['position'], 'center top', false ) ) .'>'. esc_html__( 'Center Top', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="center center" '. esc_attr( selected( $value['position'], 'center center', false ) ) .'>'. esc_html__( 'Center Center', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="center bottom" '. esc_attr( selected( $value['position'], 'center bottom', false ) ) .'>'. esc_html__( 'Center Bottom', 'octagon-elements-lite-for-elementor' ) .'</option>
						</select>
					</div>',
					esc_attr( $id ),
					esc_attr( $class )
				);
			}

			if( in_array( 'size', $allow_property ) ) {
				$background_html .= sprintf( 
					'<div class="background-field">
						<select name="%1$s[size]" class="select %2$s">
							<option value="auto" '. esc_attr( selected( $value['size'], 'auto', false ) ) .'>'. esc_html__( 'Auto', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="cover" '. esc_attr( selected( $value['size'], 'cover', false ) ) .'>'. esc_html__( 'Cover', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="contain" '. esc_attr( selected( $value['size'], 'contain', false ) ) .'>'. esc_html__( 'Contain', 'octagon-elements-lite-for-elementor' ) .'</option>
						</select>
					</div>',
					esc_attr( $id ),
					esc_attr( $class )
				);
			}

			if( in_array( 'attachment', $allow_property ) ) {
				$background_html .= sprintf( 
					'<div class="background-field">
						<select name="%1$s[attachment]" class="select %2$s">
							<option value="scroll" '. esc_attr( selected( $value['attachment'], 'scroll', false ) ) .'>'. esc_html__( 'Scroll', 'octagon-elements-lite-for-elementor' ) .'</option>
							<option value="fixed" '. esc_attr( selected( $value['attachment'], 'fixed', false ) ) .'>'. esc_html__( 'Fixed', 'octagon-elements-lite-for-elementor' ) .'</option>
						</select>
					</div>',
					esc_attr( $id ),
					esc_attr( $class )
				);
			}

			

			return $background_html;
			
		}

		/**
         * Return icon picker fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function icon_picker( $field = [], $set_value = '' ) {

			$id      = isset( $field['id'] ) ? $field['id'] : '';
			$class   = isset( $field['class'] ) ? $field['class'] : '';
			$value   = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			return sprintf( 
				'<div class="icon-picker-field">
					<span class="js-icon-picker-close-window icon-picker-close dashicons dashicons-no-alt"></span>
					<span class="current-icon %2$s"></span>
					<input type="text" name="%1$s" value="%2$s" class="textfield icon-picker-textfield %3$s">
					<div class="icons-lists"></div>
					<a href="#" class="js-icon-picker-btn button button-primary button-medium">%4$s</a>
				</div>',
				esc_attr( $id ),
				esc_attr( $value ),
				esc_attr( $class ),
				esc_html__( 'Choose Icon', 'octagon-elements-lite-for-elementor' )
			);
			
		}

		/**
         * Build repeatable fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function repeatable( $field = [], $set_value = '' ) {

			$id          = isset( $field['id'] ) ? $field['id'] : '';
			$class       = isset( $field['class'] ) ? $field['class'] : '';
			$title       = isset( $field['title'] ) ? $field['title'] : esc_html__( 'Title', 'octagon-elements-lite-for-elementor' );
			$description = isset( $field['description'] ) ? $field['description'] : esc_html__( 'Some description', 'octagon-elements-lite-for-elementor' );
			$options     = isset( $field['options'] ) ? $field['options'] : [];
			$group_value = ( '' == $set_value ) ? $this->get_post_meta( $this->post_id, $field ) : $set_value;

			return sprintf( 
				'<div class="repeatable-fields">
					<div class="repeatable-field-template">
						<div class="field-group"><a href="#" class="remove-repeatable-field button button-primary">x</a>%s</div>
						</div>
					<div class="field-set">%s</div>
					<a href="#" class="toggle-repeatable-field button button-primary">'. esc_html__( 'Expand', 'octagon-elements-lite-for-elementor' ) .'</a>
					<a href="#" class="add-repeatable-field button button-primary" data-index="'. esc_attr( $id ) .'">'. esc_html__( 'Add', 'octagon-elements-lite-for-elementor' ) .'</a>
				</div>',
				$this->repeatable_field_template( $options ),
				$this->repeatable_group_field( $group_value, $field )
			);			
			
		}

		/**
         * Return repeatable fields template, it helps to retrieve the content
         * using JS and print into the repeatable section
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function repeatable_field_template( $options ) {

			$field_html = '';

			foreach( $options as $key => $field ) {
				$field_html .= $this->field_set( $field );
			}

			return $field_html;
			
		}

		/**
         * Return repeatable group of fields
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function repeatable_group_field( $group_value, $field ) {

			$id          = isset( $field['id'] ) ? $field['id'] : '';
			$options     = isset( $field['options'] ) ? $field['options'] : [];

			$field_html = '';

			if( isset( $group_value ) && ! empty( $group_value ) ) {

				foreach( $group_value as $index => $value ) {

					$field_html .= '<div class="field-group">';
						$field_html .= '<a href="#" class="remove-repeatable-field button button-primary">x</a>';
						$field_html .= $this->repeatable_field_set( $id, $index, $group_value, $options );
					$field_html .= '</div>';

				}

			}

			return $field_html;
			
		}

		/**
         * Return repeatable fields set
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function repeatable_field_set( $id, $index, $group_value, $options ) {

			$field_html = '';

			foreach( $options as $key => $field ) {

				$value = isset( $group_value[$index][$field['id']] ) ? $group_value[$index][$field['id']] : '';

				$field['id'] = $id . '['. $index .']['.$field['id'].']';

				$field_html .= $this->field_set( $field, $value );
			}

			return $field_html;
			
		}

		/**
         * Return the check box value wheather it's checked or not
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return string
         */
		private function get_checkbox_attr( $value, $option ) {

			$attr = in_array( $option, $value ) ? 'checked' : '';
			
			return $attr;
		}

		/**
         * Return the toggle value wheather it's active or not
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return string
         */
		private function get_toggle_attr( $value, $option ) {

			$attr = ( $value == $option ) ? 'active' : 'in-active';
			
			return $attr;
		}

		/**
         * Return the radio image value wheather it's active or not
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return string
         */
		private function get_radio_image_attr( $value, $option ) {

			$attr = ( $value == $option ) ? 'active' : 'in-active';
			
			return $attr;
		}

		/**
         * Return the post meta value, if it's empty|NULL it returns the default value
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         * @return mixed
         */
		private function get_post_meta( $post_id, $field ) {

			$default = isset( $field['default'] ) ? $field['default'] : '';

			$value   = get_post_meta( $post_id, $field['id'], true );
			$value   = ( '' == $value || null == $value ) ? $default : $value;
			
			return $value;
		}

		/**
         * It calls the save function depends on field type
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		public function save_metabox( $post ) {

			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			// if our nonce isn't there, or we can't verify it
    		if( ! isset( $_POST['meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'meta_box_nonce' ) ) {
    			return;
    		}

			foreach( $this->args['fields'] as $key => $set ) {

				foreach( $set as $key => $field ) {
					$this->{'save_'.$field['type']}( $post, $field );
				}

			}
			
		}

		/**
         * Save text field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_text( $post, $field ) {

			$in_type = isset( $field['in_type'] ) ? $field['in_type'] : 'content';
			$value   = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $in_type ) ) {

				$value = $this->sanitize( $value, $in_type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save textarea field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_textarea( $post, $field ) {

			$in_type = isset( $field['in_type'] ) ? $field['in_type'] : 'allow_html';
			$value = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			$value = $this->sanitize( $value, $in_type );

			update_post_meta( $post, $field['id'], $value );
			
		}

		/**
         * Save number field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_number( $post, $field ) {

			$type = isset( $field['type'] ) ? $field['type'] : 'number';
			$value = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $type ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save toggle field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_toggle( $post, $field ) {

			$type    = isset( $field['type'] ) ? $field['type'] : 'toggle';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $type, $options ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save radio image field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_radio_image( $post, $field ) {

			$type    = isset( $field['type'] ) ? $field['type'] : 'radio_image';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $type, $options ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save color field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_color( $post, $field ) {

			$in_type = isset( $field['in_type'] ) ? $field['in_type'] : 'hex';
			$value   = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $in_type ) ) {

				$value = $this->sanitize( $value, $in_type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save media upload field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_media_upload( $post, $field ) {

			$in_type  = isset( $field['in_type'] ) ? $field['in_type'] : 'image';
			$value = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $in_type ) ) {

				$value = $this->sanitize( $value, $in_type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save radio button field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_radio( $post, $field ) {

			$type    = isset( $field['type'] ) ? $field['type'] : 'radio';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $type, $options ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save checkbox field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_checkbox( $post, $field ) {
			
			$type    = isset( $field['type'] ) ? $field['type'] : 'checkbox';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $type, $options ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save select field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_select( $post, $field ) {
			
			$type    = isset( $field['type'] ) ? $field['type'] : 'select';
			$options = isset( $field['options'] ) ? $field['options'] : [];
			$value   = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $type, $options ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save select2 field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_select2( $post, $field ) {
			
			$type           = isset( $field['type'] ) ? $field['type'] : 'select2';
			$in_type        = isset( $field['in_type'] ) ? $field['in_type'] : 'static';
			$allow_multiple = isset( $field['allow_multiple'] ) ? $field['allow_multiple'] : false;
			$options        = isset( $field['options'] ) ? $field['options'] : [];
			$value          = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			$type = sprintf( '%s_%s%s',
				$type,
				$in_type,
				( $allow_multiple ) ? '_multiple' : ''
			);

			if( $this->validate( $value, $type, $options ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );

			}
			
		}

		/**
         * Save background field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_background( $post, $field ) {
			
			$type  = isset( $field['type'] ) ? $field['type'] : 'background';
			$value = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $type ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save icon picker field
         * 
         * @version 1.0 
         * @since 1.0
         * @access private
         */
		private function save_icon_picker( $post, $field ) {
			
			$type  = isset( $field['type'] ) ? $field['type'] : 'icon_picker';
			$value = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';

			if( $this->validate( $value, $type ) ) {

				$value = $this->sanitize( $value, $type );

				update_post_meta( $post, $field['id'], $value );
			}
			
		}

		/**
         * Save repeatable field
         * 
         * @version 1.3 
         * @since 1.0
         * @access private
         */
		private function save_repeatable( $post, $field ) {

			$sanitized_value = [];
			
			$value = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';
			$group = isset( $field['options'] ) ? $field['options'] : [];

			if( ! empty( $value ) ) {

				foreach( $value as $random_key => $val ) {

					foreach( $group as $key => $set ) {

						$type    = isset( $set['in_type'] ) ? $set['in_type'] : $set['type'];
						$options = isset( $set['options'] ) ? $set['options'] : [];

						if( $this->validate( $value[$random_key][$set['id']], $type, $options ) ) {
							$sanitized_value[$random_key][$set['id']] = $this->sanitize( $value[$random_key][$set['id']], $type );
						}
						
					}
					
				}

			}

			update_post_meta( $post, $field['id'], $sanitized_value );
			
		}

		/**
         * It validate all the values depends on field type|in_type
         * 
         * @version 1.3 
         * @since 1.0
         * @access private
         */
		private function validate( $value = '', $case = '', $options = [] ) {

			switch( $case ) {

				case 'email':
					return is_email( $value ) ? $value : false;
				break;

				case 'url':
					return ( esc_url_raw( $value ) === $value ) ? $value : false;
				break;

				case 'number':
				case 'image':
				case 'audio':
				case 'video':
				case 'text':
				case 'application':
					return is_numeric( $value ) ? $value : false;
				break;

				case 'tel':
					return ( preg_match( '/^[+]?[0-9() -]*$/', $value ) ) ? $value : false;
				break;

				case 'background':
				case 'select2_ajax_multiple':
					return is_array( $value ) ? $value : false;
				break;

				case 'toggle':
				case 'radio_image':
				case 'radio':
				case 'select':
				case 'select2_static':
					return ( array_key_exists( $value, $options ) ) ? $value : false;
				break;

				case 'checkbox':
				case 'select2_static_multiple':
					return ! empty( $value ) ? octagon_in_array_all( $value, array_keys( $options ) ) : true;
				break;

				case 'content':
				case 'hex':
				case 'alpha':
				case 'icon_picker':
				case 'select2_ajax':
					return is_string( $value ) ? $value : false;
				break;
				
				default:
					return $value;
				break;
			}
			
		}

		/**
         * It helps to return the sanitize value depends on field type|in_type
         * 
         * @version 1.3 
         * @since 1.0
         * @access private
         */
		private function sanitize( $value, $case ) {

			switch( $case ) {

				case 'content':
				case 'tel':
				case 'alpha':
				case 'toggle':
				case 'radio_image':
				case 'radio':
				case 'select':
				case 'select2_static':
				case 'select2_ajax':				
					return sanitize_text_field( $value );
				break;

				case 'number':
				case 'image':
				case 'audio':
				case 'video':
				case 'text':
				case 'application':
					return absint( $value );

				case 'background':
				case 'checkbox':
				case 'select2_static_multiple':
				case 'select2_ajax_multiple':
					return ! empty( $value ) ? array_map( 'sanitize_text_field', wp_unslash( $value ) ) : [];
				break;

				case 'email':
					return sanitize_email( $value );
				break;

				case 'url':
					return esc_url_raw( $value );
				break;

				case 'hex':
					return sanitize_hex_color( $value );
				break;

				case 'allow_html':
					return wp_kses( $value, octagon_allowed_html_tags() );
				break;

				case 'no_html':
					return wp_filter_nohtml_kses( $value );
				break;

				case 'icon_picker':
					return sanitize_html_class( $value );
				break;
				
				default:
				break;
			}
			
		}

	}

}
