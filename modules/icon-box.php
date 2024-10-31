<?php

/**
 * Icon Box
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

class OEE_Icon_Box_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_icon_box';
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
		return esc_html__( 'Icon Box', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-icon-box';
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
		return [ 'oee-icon-box', 'oee-advance-button' ];
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
			'style',
			[
				'label'   => esc_html__( 'Style', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'separate',
				'options' => [
					'separate' => esc_html__( 'Separate', 'octagon-elements-lite-for-elementor' ),
					'collapse' => esc_html__( 'Collapse', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label'   => esc_html__( 'Alignment', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'left'   => esc_html__( 'Left', 'octagon-elements-lite-for-elementor' ),
					'right'  => esc_html__( 'Right', 'octagon-elements-lite-for-elementor' ),
					'center' => esc_html__( 'Center', 'octagon-elements-lite-for-elementor' )
				]
			]
		);

		$this->add_control(
			'type',
			[
				'label'   => esc_html__( 'Type', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => esc_html_x( 'Icon', 'octagon-elements-lite-for-elementor' ),
					'image' => esc_html_x( 'Image', 'octagon-elements-lite-for-elementor' )
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::ICONS,
				'condition' => [
					'type' => 'icon'
				]
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'type' => 'image'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'large',
				'separator' => 'none',
				'condition' => [
					'type' => 'image',
					'image[value]!' => ''
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label'      => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => esc_html__( 'Default Title', 'octagon-elements-lite-for-elementor' ),
				'input_type' => 'text'
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'p'    => 'P',
					'span' => 'Span'
				],
				'condition' => [
					'title[value]!' => ''
				]
			]
		);

		$this->add_control(
			'desc',
			[
				'label'      => esc_html__( 'Description', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXTAREA,
				'default'    => esc_html__( 'Enter the short description to explain what is this all about?', 'octagon-elements-lite-for-elementor' ),
				'input_type' => 'text'
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


		/* Content Inner Section: Button --------------------------------------------- */

		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__( 'Button', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'show_btn',
			[
				'label'   => esc_html__( 'Show Button?', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show' => esc_html__( 'Show', 'octagon-elements-lite-for-elementor' ),
					'hide' => esc_html__( 'Hide', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'default'     => esc_html__( 'Click Me', 'octagon-elements-lite-for-elementor' ),
				'condition' => [
					'show_btn' => 'show'
				],
				'condition' => [
					'show_btn' => 'show'
				]
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
				'condition' => [
					'show_btn' => 'show'
				]
			]
		);

		$this->add_control(
			'btn_size',
			[
				'label'   => esc_html__( 'Button Size', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-size-mini',
				'options' => $this->get_array( 'btn_size' ),
				'condition' => [
					'show_btn' => 'show'
				]
			]
		);

		$this->add_control(
			'btn_type',
			[
				'label'   => esc_html__( 'Button Type', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-type-solid-ellipse',
				'options' => $this->get_array( 'btn_type' ),
				'condition' => [
					'show_btn' => 'show'
				]
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'   => esc_html__( 'Button Color', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-color-black',
				'options' => $this->get_array( 'btn_color' ),
				'condition' => [
					'show_btn' => 'show'
				]
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
					'show_btn'  => 'show',
					'btn_color' => 'btn-color-gradient-palette'
				]
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label' => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::ICONS,
				'condition' => [
					'show_btn' => 'show'
				]
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
					'show_btn'         => 'show',
					'btn_icon[value]!' => ''
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
					'show_btn'         => 'show',
					'btn_icon[value]!' => ''
				]
			]
		);

		$this->end_controls_section();


		/* ---------------------------------------------------------------------------
		 * Section: Style
		------------------------------------------------------------------------------ */

		/* Style Inner Section: Box -------------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__( 'Box', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'box_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		

		$this->add_control(
			'box_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'border: 1px solid {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .icon-box'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Icon ------------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_1
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon-wrap i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i' => 'border: 1px solid {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon-wrap i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'icon_text_shadow',
				'selector' => '{{WRAPPER}} .icon-wrap i'
			]
		);	

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .icon-wrap i'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Title ------------------------------------------------ */

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .icon-box-title'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_1
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .icon-box-title'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Description ------------------------------------------ */

		$this->start_controls_section(
			'section_style_description',
			[
				'label' => esc_html__( 'Description', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .description'
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} .description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'description_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'description_text_shadow',
				'selector' => '{{WRAPPER}} .description'
			]
		);

		$this->end_controls_section();


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
				'name'     => 'btn_shadow',
				'selector' => '{{WRAPPER}} a.btn'
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'label'     => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} a.btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
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
				'label'     => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.btn:hover, {{WRAPPER}} a.btn:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} a.btn:hover svg, {{WRAPPER}} a.btn:focus svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'hover_btn_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
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

		$attributes['wrapper']['class'][] = 'octagon-elements icon-box';
		$attributes['wrapper']['class'][] = 'icon-box-'. $settings['alignment'];
		$attributes['wrapper']['class'][] = 'type-'. $settings['type'];
		$attributes['wrapper']['class'][] = $settings['style'] ?? 'separate';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		if ( ! empty( $settings['link']['url'] ) ) {

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

		$attributes['title']['class'][] = 'icon-box-title';

		$attributes['desc']['class'][] = 'description';

		$attributes['btn_text']['class'][] = 'octagon-button-text';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_icon_box_render_attribute', $attributes );

		// Add render attributes
		$this->add_render_attribute( $attributes );

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'desc', 'none' );
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
		do_action( 'oee_icon_box_render_attributes' );

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
		var printIcon = '';

		view.addRenderAttribute( 'wrapper', {
			'class': [ 'octagon-elements', 'icon-box', settings.style, 'icon-box-'+ settings.alignment, 'type-'+ settings.type, settings.ex_class ]
		} );

		view.addRenderAttribute( 'title', {
			'class': [ 'icon-box-title' ]
		} );

		view.addRenderAttribute( 'desc', {
			'class': [ 'description' ]
		} );

		view.addInlineEditingAttributes( 'title', 'none' );
		
		view.addInlineEditingAttributes( 'desc', 'none' );

		view.addInlineEditingAttributes( 'btn_text', 'none' );
		
		if( 'icon' == settings.type ) {
			var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
			iconHTML = iconHTML.value;
		}
		else if( 'image' == settings.type ) {

			if( settings.image.url ) {
				var image = {
					id: settings.image.id,
					url: settings.image.url,
					size: settings.image_size,
					dimension: settings.image_custom_dimension,
					model: view.getEditModel()
				};

				var image_url = elementor.imagesManager.getImageUrl( image );

				if ( ! image_url ) {
					return;
				}
			}

			var iconHTML = '<img src="'+ image_url +'">';
		}
		
		if( iconHTML ) {
			printIcon = '<div class="icon-wrap">'+iconHTML+'</div>';
		}		

		var btnIconHTML = elementor.helpers.renderIcon( view, settings.btn_icon, { 'aria-hidden': true }, 'i' , 'object' );
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
		do_action( 'oee_icon_box_live_attributes' );
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

		$settings = $this->get_settings_for_display();

		echo oee_get_shortcode_template( 'icon-box', $this );

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

		echo oee_get_live_template( 'icon-box' );
	}

	/**
	 * Render icon.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function render_icon() {

		$settings = $this->get_settings_for_display();
		?>

		<div class="icon-wrap">
			<?php 
			if( 'icon' == $settings['type'] && ! empty( $settings['icon']['value'] ) ) :
				Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
			elseif( 'image' == $settings['type'] ) :
				echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image' );
			endif;
			?>
		</div> <!-- .icon-wrap -->

		<?php
	}

	/**
	 * Render button.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function render_btn() {

		$settings = $this->get_settings_for_display();

		if( 'show' == $settings['show_btn'] ) :
			?>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<span>

					<?php 
					if( ! empty( $settings['btn_icon']['value'] ) && 'left' == $settings['icon_position'] ) :
						Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
					endif;

					if( ! $settings['only_icon'] ) :
						?>
						<span <?php echo $this->get_render_attribute_string( 'btn_text' ); ?>><?php echo esc_html( $settings['btn_text'] ); ?></span>
						<?php 
					endif;

					if( ! empty( $settings['btn_icon']['value'] ) && 'right' == $settings['icon_position'] ) :
						Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
					endif;
					?>
				</span>
			</a>
			<?php
		endif; 
	}

}