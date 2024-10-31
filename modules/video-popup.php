<?php

/**
 * Video Popup
 *
 * @package octagon-elements-lite-for-elementor/modules
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.0
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Icons_Manager;
use \Elementor\Core\Schemes\Typography as Schemes_Typography;
use \Elementor\Core\Schemes\Color as Schemes_Color;

class OEE_Video_Popup_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_video_popup';
	}

	/**
	 * Get element title.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Video Popup', 'octagon-elements-lite-for-elementor' );
	}

	/**
	 * Get element icon.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_icon() {
		return 'oee-play';
	}

	/**
	 * Get element categories belongs to.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return array
	 */
	public function get_categories() {
		return [ 'octagon' ];
	}	

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the element requires.
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return array
	 */
	public function get_style_depends() {
		return [ 'magnific-popup', 'oee-video-popup' ];
	}

	/**
	 * Get script dependencies.
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return array
	 */
	public function get_script_depends() {
		return [ 'magnific-popup' ];
	}

	/**
	 * Register element controls.
	 * 
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function _register_controls() {


		/* ---------------------------------------------------------------------------
		 * Section: Content
		------------------------------------------------------------------------------ */

		/* Content Inner Section: Content -------------------------------------------- */

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => esc_html__( 'Youtube/Vimeo Link', 'octagon-elements-lite-for-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'octagon-elements-lite-for-elementor' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true
				],
			]
		);

		$this->add_control(
			'trigger',
			[
				'label'   => esc_html__( 'Trigger', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'icon'  => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
					'text'  => esc_html__( 'Text', 'octagon-elements-lite-for-elementor' ),
					'image' => esc_html__( 'Image', 'octagon-elements-lite-for-elementor' )
				],
				'condition' => [
					'link[value]!' => ''
				]
			]
		);

		$this->add_control(
			'trigger_icon',
			[
				'label' => esc_html__( 'Trigger Icon', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::ICONS,
				'condition' => [
					'trigger' => 'icon',
					'link[value]!' => ''
				]
			]
		);

		$this->add_control(
			'trigger_text',
			[
				'label'      => esc_html__( 'Trigger Text', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'text',
				'default'    => esc_html__( 'Play', 'octagon-elements-lite-for-elementor' ),
				'condition' => [
					'trigger' => 'text',
					'link[value]!' => ''
				]
			]
		);

		$this->add_control(
			'trigger_image',
			[
				'label' => esc_html__( 'Trigger Image', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'trigger' => 'image',
					'link[value]!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'trigger_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'large',
				'separator' => 'none',
				'condition' => [
					'trigger' => 'image',
					'trigger_image[value]!' => '',
					'link[value]!' => ''
				]
			]
		);

		$this->add_control(
			'ex_class',
			[
				'label'       => esc_html__( 'Extra Class', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
			]
		);

		$this->end_controls_section();


		/* ---------------------------------------------------------------------------
		 * Section: Style
		------------------------------------------------------------------------------ */

		/* Style Inner Section: Trigger Text ----------------------------------------- */

		$this->start_controls_section(
			'section_style_text',
			[
				'label' => esc_html__( 'Trigger Text', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}} .magnify-video.text'
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} .magnify-video.text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .magnify-video.text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'text_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .magnify-video.text' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .magnify-video.text' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'text_text_shadow',
				'selector' => '{{WRAPPER}} .magnify-video.text'
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Set render attributes.
	 * 
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function set_render_attributes() {

		$settings = $this->get_settings_for_display();

		$attributes['wrapper']['class'][] = 'octagon-elements video-popup';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';


		$attributes['trigger']['class'][] = 'magnify-video';
		$attributes['trigger']['class'][] = $settings['trigger'] ?? 'icon';

		if( ! empty( $settings['link']['url'] ) ) {

			$attributes['trigger']['href'] = $settings['link']['url'];

			if( $settings['link']['is_external'] ) {			
				$attributes['trigger']['target'] = '_blank';
			}

			if( $settings['link']['nofollow'] ) {			
				$attributes['trigger']['rel'] = 'nofollow';
			}
		}

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_video_popup_render_attribute', $attributes );
		

		// Add render attributes
		$this->add_render_attribute( $attributes );

		$this->add_inline_editing_attributes( 'btn_text', 'none' );

		/**
		 * Render attributes based on {module}_render_attributes
		 *
		 * Fires before rendering elements content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_video_popup_render_attributes' );

	}

	/**
	 * Set live attributes.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function set_live_attributes() {
		?>

		<#
		
		var triggerHTML = '';

		view.addRenderAttribute( 'wrapper', {
			'class': [ 'octagon-elements', 'video-popup' ]
		} );

		if( settings.ex_class ) {
			view.addRenderAttribute( 'wrapper', {
				'class': settings.ex_class
			} );
		}

		view.addRenderAttribute( 'trigger', {
			'class': ['magnify-video']
		} );

		if( settings.trigger ) {
			view.addRenderAttribute( 'trigger', {
				'class': settings.trigger
			} );
		}

		if( settings.link.url ) {
			view.addRenderAttribute( 'trigger', {
				'href': settings.link.url
			} );

			if( settings.link.is_external ) {
				view.addRenderAttribute( 'trigger', {
					'href': '_blank'
				} );
			}

			if( settings.link.nofollow ) {
				view.addRenderAttribute( 'trigger', {
					'rel': 'nofollow'
				} );
			}
		}
		
		if( 'text' == settings.trigger ) {
			var triggerHTML = settings.trigger_text;
		}
		else if( 'icon' == settings.trigger ) {
			var triggerHTML = elementor.helpers.renderIcon( view, settings.trigger_icon, { 'aria-hidden': true }, 'i' , 'object' );
			triggerHTML = triggerHTML.value;
		}
		else if( 'image' == settings.trigger ) {

			if( settings.trigger_image.url ) {
				var image = {
					id: settings.trigger_image.id,
					url: settings.trigger_image.url,
					size: settings.trigger_image_size,
					dimension: settings.trigger_image_custom_dimension,
					model: view.getEditModel()
				};

				var image_url = elementor.imagesManager.getImageUrl( image );

				if( ! image_url ) {
					return;
				}
			}

			var triggerHTML = '<img src="'+ image_url +'">';
		}

		console.log( triggerHTML );

		#>

		<?php

		/**
		 * Render attributes based on {module}_live_attributes
		 *
		 * Fires before rendering live template content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_video_popup_live_attributes' );
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function render() {

		$this->set_render_attributes();

		echo oee_get_shortcode_template( 'video-popup', $this );

	}

	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 * 
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function _content_template() {

		$this->set_live_attributes();

		echo oee_get_live_template( 'video-popup' );
	}

	/**
	 * Render trigger.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function render_trigger() {

		$settings = $this->get_settings_for_display();

		if( ! empty( $settings['link'] ) ) :
			?>
			<a <?php echo $this->get_render_attribute_string( 'trigger' ); ?>>
				<?php
				if( 'text' == $settings['trigger'] ) :
					echo esc_html( $settings['trigger_text'] );
				elseif( 'image' == $settings['trigger'] ) :
					// $trigger_image = octagon_get_cropped_image( $settings['trigger_image'], 'full', 'full', false );

					// echo wp_kses( $trigger_image, array( 'img' => array( 'src' => [], 'alt' => [] ) ) );

					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'trigger_image' );
				else :
					if( ! empty( $settings['trigger_icon']['value'] ) ) :
						Icons_Manager::render_icon( $settings['trigger_icon'], [ 'aria-hidden' => 'true' ] );
					endif;
				endif;
				?>
			</a>
			<?php
		endif;
	}

}