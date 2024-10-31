<?php

/**
 * Navigation Menu
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
use \Elementor\Core\Schemes\Typography as Schemes_Typography;
use \Elementor\Core\Schemes\Color as Schemes_Color;

class OEE_Navigation_Menu_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_navigation_menu';
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
		return esc_html__( 'Navigation Menu', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-navigation';
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
		return [ 'oee-navigation-menu' ];
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
			'menu',
			[
				'label'   => esc_html__( 'Menu', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => array_merge( array( '0' => esc_html__( 'Select a Menu', 'octagon-elements-lite-for-elementor' ) ), octagon_nav_menu_list() )
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'octagon-elements-lite-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'octagon-elements-lite-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .main-menu ul' => 'float: {{VAUE}};'
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

		/* Style Inner Section: Menu ------------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_menu',
			[
				'label' => esc_html__( 'Menu', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .main-menu > ul > li > .menu-link'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'menu_shadow',
				'selector' => '{{WRAPPER}} .main-menu > ul > li > .menu-link'
			]
		);

		$this->add_responsive_control(
			'menu_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-menu > ul > li > .menu-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'menu_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-menu > ul > li > .menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->start_controls_tabs( 'tabs_menu_style' );

		$this->start_controls_tab(
			'tab_menu_normal',
			[
				'label' => esc_html__( 'Normal', 'octagon-elements-lite-for-elementor' ),
			]
		);

		$this->add_control(
			'menu_normal_color',
			[
				'label' => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-menu > ul > li > .menu-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_normal_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu > ul > li > .menu-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_normal_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu > ul > li > .menu-link' => 'border: 1px solid {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'menu_normal_box_shadow',
				'selector' => '{{WRAPPER}} .main-menu > ul > li > .menu-link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_hover',
			[
				'label' => esc_html__( 'Hover', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'menu_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu > ul > li > .menu-link:hover, {{WRAPPER}} .main-menu > ul > li > .menu-link:focus' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'menu_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu > ul > li > .menu-link:hover, {{WRAPPER}} .main-menu > ul > li > .menu-link:focus' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'menu_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu > ul > li > .menu-link:hover, {{WRAPPER}} .main-menu > ul > li > .menu-link:focus' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'menu_hover_box_shadow',
				'selector' => '{{WRAPPER}} .main-menu > ul > li > .menu-link:hover, {{WRAPPER}} .main-menu > ul > li > .menu-link:focus'
			]
		);

		$this->add_control(
			'menu_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		/* Style Inner Section: Sub Menu --------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_sub_menu',
			[
				'label' => esc_html__( 'Sub Menu', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_menu_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .main-menu .sub-menu li .menu-link'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'sub_menu_shadow',
				'selector' => '{{WRAPPER}} .main-menu .sub-menu li .menu-link'
			]
		);

		$this->add_responsive_control(
			'sub_menu_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-menu .sub-menu li .menu-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'sub_menu_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-menu .sub-menu li .menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->start_controls_tabs( 'tabs_sub_menu_style' );

		$this->start_controls_tab(
			'tab_sub_menu_normal',
			[
				'label' => esc_html__( 'Normal', 'octagon-elements-lite-for-elementor' ),
			]
		);

		$this->add_control(
			'sub_menu_normal_color',
			[
				'label' => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-menu .sub-menu li .menu-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_menu_normal_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .sub-menu li .menu-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_menu_normal_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .sub-menu li .menu-link' => 'border: 1px solid {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'sub_menu_normal_box_shadow',
				'selector' => '{{WRAPPER}} .main-menu .sub-menu li .menu-link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sub_menu_hover',
			[
				'label' => esc_html__( 'Hover', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'sub_menu_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .sub-menu li .menu-link:hover, {{WRAPPER}} .main-menu .sub-menu li .menu-link:focus' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'sub_menu_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .sub-menu li .menu-link:hover, {{WRAPPER}} .main-menu .sub-menu li .menu-link:focus' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'sub_menu_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .sub-menu li .menu-link:hover, {{WRAPPER}} .main-menu .sub-menu li .menu-link:focus' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'sub_menu_hover_box_shadow',
				'selector' => '{{WRAPPER}} .main-menu .sub-menu li .menu-link:hover, {{WRAPPER}} .main-menu .sub-menu li .menu-link:focus'
			]
		);

		$this->add_control(
			'sub_menu_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		/* Style Inner Section: Mega Menu Title -------------------------------------- */
		
		$this->start_controls_section(
			'section_style_mega_menu_title',
			[
				'label' => esc_html__( 'Mega Menu Title', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'mega_menu_title_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .main-menu .megamenu > ul.sub-menu > li > .menu-link, {{WRAPPER}} .main-menu .megamenu > ul.sub-menu .widget-title, {{WRAPPER}} .main-menu .megamenu > ul.sub-menu .act-as-title > .menu-link'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'mega_menu_title_shadow',
				'selector' => '{{WRAPPER}} .main-menu .megamenu > ul.sub-menu > li > .menu-link, {{WRAPPER}} .main-menu .megamenu > ul.sub-menu .widget-title, {{WRAPPER}} .main-menu .megamenu > ul.sub-menu .act-as-title > .menu-link'
			]
		);

		$this->add_responsive_control(
			'mega_menu_title_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu > ul.sub-menu > li > .menu-link, {{WRAPPER}} .main-menu .megamenu > ul.sub-menu .widget-title, {{WRAPPER}} .main-menu .megamenu > ul.sub-menu .act-as-title > .menu-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'mega_menu_title_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu > ul.sub-menu > li > .menu-link, {{WRAPPER}} .main-menu .megamenu > ul.sub-menu .widget-title, {{WRAPPER}} .main-menu .megamenu > ul.sub-menu .act-as-title > .menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Mega Menu Link --------------------------------------- */
		
		$this->start_controls_section(
			'section_style_mega_menu_link',
			[
				'label' => esc_html__( 'Mega Menu Link', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'mega_menu_link_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'mega_menu_link_shadow',
				'selector' => '{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title'
			]
		);

		$this->add_responsive_control(
			'mega_menu_link_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'mega_menu_link_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->start_controls_tabs( 'tabs_mega_menu_link_style' );

		$this->start_controls_tab(
			'tab_mega_menu_link_normal',
			[
				'label' => esc_html__( 'Normal', 'octagon-elements-lite-for-elementor' ),
			]
		);

		$this->add_control(
			'mega_menu_link_normal_color',
			[
				'label' => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mega_menu_link_normal_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mega_menu_link_normal_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title' => 'border: 1px solid {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'mega_menu_link_normal_box_shadow',
				'selector' => '{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_mega_menu_link_hover',
			[
				'label' => esc_html__( 'Hover', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'mega_menu_link_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span:hover,{{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a:focus, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span:focus,{{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title:focus' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'mega_menu_link_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span:hover,{{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a:focus, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span:focus,{{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title:focus' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'mega_menu_link_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span:hover,{{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a:focus, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span:focus,{{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title:focus' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'mega_menu_link_hover_box_shadow',
				'selector' => '{{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title:hover, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > a:focus, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li > span:focus, {{WRAPPER}} .main-menu .megamenu ul.sub-menu li.act-as-title:focus'
			]
		);

		$this->add_control(
			'mega_menu_link_hover_animation',
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

		$attributes['wrapper']['class'][] = 'octagon-elements navigation-menu';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_navigation_menu_render_attribute', $attributes );
		

		// Add render attributes
		$this->add_render_attribute( $attributes );

		/**
		 * Render attributes based on {module}_render_attributes
		 *
		 * Fires before rendering elements content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_navigation_menu_render_attributes' );

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

		echo oee_get_shortcode_template( 'navigation-menu', $this );

	}

}