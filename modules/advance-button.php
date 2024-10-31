<?php

/**
 * Advance Button
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
use \Elementor\Icons_Manager;
use \Elementor\Core\Schemes\Typography as Schemes_Typography;
use \Elementor\Core\Schemes\Color as Schemes_Color;

class OEE_Advance_Button_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_advance_button';
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
		return esc_html__( 'Advance Button', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-tap';
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
		return [ 'oee-advance-button' ];
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
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'default'     => esc_html__( 'Click Me', 'octagon-elements-lite-for-elementor' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => esc_html__( 'Link', 'octagon-elements-lite-for-elementor' ),
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
			'btn_size',
			[
				'label'   => esc_html__( 'Button Size', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-size-small',
				'options' => $this->get_array( 'btn_size' )
			]
		);

		$this->add_control(
			'btn_type',
			[
				'label'   => esc_html__( 'Button Type', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-type-solid-ellipse',
				'options' => $this->get_array( 'btn_type' )
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'   => esc_html__( 'Button Color', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-color-black',
				'options' => $this->get_array( 'btn_color' )
			]
		);

		$this->add_control(
			'gradient_palette',
			[
				'label'   => esc_html__( 'Gradient Palette', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'orange-pulp',
				'options' => $this->get_array( 'gradient_palette' ),
				'condition' => [
					'btn_color' => 'btn-color-gradient-palette'
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::ICONS
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label'   => esc_html__( 'Icon Position', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Left', 'octagon-elements-lite-for-elementor' ),
					'right' => esc_html__( 'Right', 'octagon-elements-lite-for-elementor' )
				],
				'condition' => [
					'icon[value]!' => ''
				]
			]
		);

		$this->add_control(
			'only_icon',
			[
				'label'        => esc_html__( 'Only Icon?', 'octagon-elements-lite-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'octagon-elements-lite-for-elementor' ),
				'label_off'    => esc_html__( 'No', 'octagon-elements-lite-for-elementor' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition' => [
					'icon[value]!' => ''
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

		/* Style Inner Section: Button ----------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.btn'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'btn_text_shadow',
				'selector' => '{{WRAPPER}} a.btn'
			]
		);



		$this->add_responsive_control(
			'btn_height',
			[
				'label' => esc_html__( 'Height', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} a.btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_line_height',
			[
				'label' => esc_html__( 'Line Height', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} a.btn' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_margin',
			[
				'label' => esc_html__( 'Margin', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'align-left'    => [
						'title' => esc_html__( 'Left', 'octagon-elements-lite-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'align-center' => [
						'title' => esc_html__( 'Center', 'octagon-elements-lite-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'align-right' => [
						'title' => esc_html__( 'Right', 'octagon-elements-lite-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					]
				]
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'octagon-elements-lite-for-elementor' ),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.btn' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} a.btn.btn-type-line-collapse:after' => 'background: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'btn_box_shadow',
				'selector' => '{{WRAPPER}} a.btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'hover_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.btn:hover, {{WRAPPER}} a.btn:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} a.btn:hover svg, {{WRAPPER}} a.btn:focus svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'hover_btn_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.btn:hover, {{WRAPPER}} a.btn:focus' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'hover_btn_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.btn:hover, {{WRAPPER}} a.btn:focus' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} a.btn.btn-type-line-collapse:hover:after, {{WRAPPER}} a.btn.btn-type-line-collapse:focus:after' => 'background: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'hover_btn_box_shadow',
				'selector' => '{{WRAPPER}} a.btn:hover, {{WRAPPER}} a.btn:focus'
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		/* Style Inner Section: Icon ------------------------------------------------- */

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Spacing', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.btn .octagon-align-icon-right i' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} a.btn .octagon-align-icon-left i' => 'padding-right: {{SIZE}}{{UNIT}};'
				]
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

		$attributes['wrapper']['class'][] = 'octagon-elements advance-btn';
		$attributes['wrapper']['class'][] = $settings['align'] ?? '';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';


		if( ! empty( $settings['link']['url'] ) ) {

			$attributes['button']['href'] = $settings['link']['url'];

			if( $settings['link']['is_external'] ) {			
				$attributes['button']['target'] = '_blank';
			}

			if( $settings['link']['nofollow'] ) {			
				$attributes['button']['rel'] = 'nofollow';
			}
		}

		$attributes['button']['class'][] = 'btn';
		$attributes['button']['class'][] = $settings['btn_size'] ?? 'btn-size-small';
		$attributes['button']['class'][] = $settings['btn_type'] ?? 'btn-type-solid-ellipse';
		$attributes['button']['class'][] = $settings['btn_color'] ?? 'btn-color-black';
		$attributes['button']['class'][] = ( 'btn-color-gradient-palette' == $settings['btn_color'] ) && isset( $settings['gradient_palette'] ) ? $settings['gradient_palette'] : '';
		
		$attributes['content-wrapper']['class'][] = 'octagon-button-content-wrapper';		
		$attributes['content-wrapper']['class'][] = 'octagon-align-icon-'. $settings['icon_position'];
		
		$attributes['btn_text']['class'][] = 'octagon-button-text';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_advance_button_render_attribute', $attributes );
		

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
		do_action( 'oee_advance_button_render_attributes' );

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
		view.addInlineEditingAttributes( 'btn_text', 'none' );
		var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
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
		do_action( 'oee_advance_button_live_attributes' );
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

		echo oee_get_shortcode_template( 'advance-button', $this );

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

		echo oee_get_live_template( 'advance-button' );
	}

	/**
	 * Render button text.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function render_text() {

		$settings = $this->get_settings_for_display();
		?>

		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>

			<?php 
			if( ! empty( $settings['icon']['value'] ) && 'left' == $settings['icon_position'] ) :
				Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
			endif;

			if( ! $settings['only_icon'] ) :
				?>
				<span <?php echo $this->get_render_attribute_string( 'btn_text' ); ?>><?php echo esc_html( $settings['btn_text'] ); ?></span>
				<?php 
			endif;

			if( ! empty( $settings['icon']['value'] ) && 'right' == $settings['icon_position'] ) :
				Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
			endif;
			?>
		</span>

		<?php
	}

}