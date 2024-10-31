<?php

/**
 * Content Type
 *
 * @package octagon-elements-lite-for-elementor/modules
 * @author octagonwebstudio <octagonwebstudio@gmail.com>
 * @version 1.3
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

class OEE_Content_Type_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_content_type';
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
		return esc_html__( 'Content Type', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-post';
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
		return [ 'oee-content-type', 'oee-advance-button' ];
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
		return [ 'isotope', 'imagesloaded' ];
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
				'default' => 'masonry',
				'options' => [
					'masonry'              => esc_html__( 'Masonry', 'octagon-elements-lite-for-elementor' ),
					'post-content-overlap' => esc_html__( 'Post Content Overlap', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => $this->get_array( 'title_tag' )
			]
		);

		$this->add_control(
			'columns',
			[
				'label'   => esc_html__( 'Columns', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'col-md-4',
				'options' => [
					'col-md-6' => esc_html__( '2 Column', 'octagon-elements-lite-for-elementor' ),
					'col-md-4' => esc_html__( '3 Column', 'octagon-elements-lite-for-elementor' ),
					'col-md-3' => esc_html__( '4 Column', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'meta',
			[
				'label'   => esc_html__( 'Meta', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => [
					'none'     => esc_html__( 'None', 'octagon-elements-lite-for-elementor' ),
					'date'     => esc_html__( 'Date', 'octagon-elements-lite-for-elementor' ),
					'category' => esc_html__( 'Category', 'octagon-elements-lite-for-elementor' )
				],
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label'   => esc_html__( 'Excerpt', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'excerpt_limit',
			[
				'label'   => esc_html__( 'Excerpt Limit', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min' => 30,
				'max' => 400,
				'step' => 10,
				'default' => 100,
				'condition' => [
					'excerpt' => 'show'
				]
			]
		);

		$this->add_control(
			'dimension',
			[
				'label'   => esc_html__( 'Image Dimension', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::IMAGE_DIMENSIONS,
				'default' => [
					'width'  => '700',
					'height' => '500'
				]
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'   => esc_html__( 'Pagination', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => $this->get_array( 'pagination' )
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


		/* Content Inner Section: Query ---------------------------------------------- */

		$this->start_controls_section(
			'query_section',
			[
				'label' => esc_html__( 'Query', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'content_type',
			[
				'label'   => esc_html__( 'Content Type', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => octagon_post_type_list()
			]
		);

		$this->add_control(
			'taxonomy',
			[
				'label'   => esc_html__( 'Taxonomy', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => octagon_taxonomy_list()
			]
		);

		$this->add_control(
			'method',
			[
				'label'   => esc_html__( 'Method', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => esc_html__( 'Default', 'octagon-elements-lite-for-elementor' ),
					'id'       => esc_html__( 'ID', 'octagon-elements-lite-for-elementor' ),
					'terms'    => esc_html__( 'Terms', 'octagon-elements-lite-for-elementor' ),
					'author'   => esc_html__( 'Author', 'octagon-elements-lite-for-elementor' ),
					'popular'  => esc_html__( 'Popular', 'octagon-elements-lite-for-elementor' ),
					'featured' => esc_html__( 'Featured', 'octagon-elements-lite-for-elementor' )
				]
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => $this->get_array( 'order' )
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Orderby', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => $this->get_array( 'orderby' )
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Limit', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min' => -1,
				'max' => 20,
				'step' => 1,
				'default' => 6
			]
		);

		$this->add_control(
			'post_in',
			[
				'label'       => esc_html__( 'ID', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the id (integer), Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'condition' => [
					'method' => 'id'
				]
			]
		);

		$this->add_control(
			'terms_in',
			[
				'label'       => esc_html__( 'Terms', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the terms slug, Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'condition' => [
					'method' => 'terms'
				]
			]
		);

		$this->add_control(
			'author_in',
			[
				'label'       => esc_html__( 'Author', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the author username, Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'condition' => [
					'method' => 'author'
				]
			]
		);

		$this->add_control(
			'post_not_in',
			[
				'label'       => esc_html__( 'Exclude ID', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the id (integer), Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
			]
		);

		$this->add_control(
			'terms_not_in',
			[
				'label'       => esc_html__( 'Exclude Terms', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the terms slug, Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
			]
		);

		$this->add_control(
			'author_not_in',
			[
				'label'       => esc_html__( 'Exclude Author', 'octagon-elements-lite-for-elementor' ),
				'description' => esc_html__( 'Type the author username, Explode it with commas.', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text'
			]
		);

		$this->add_control(
			'offset',
			[
				'label'   => esc_html__( 'Offset Count', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::NUMBER
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
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'default'     => esc_html__( 'Read More', 'octagon-elements-lite-for-elementor' ),
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


		/* Content Inner Section: Load More ------------------------------------------ */

		$this->start_controls_section(
			'loadmore_section',
			[
				'label' => esc_html__( 'Load More', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'loadmore_text',
			[
				'label'       => esc_html__( 'Button Text', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'text',
				'default'     => esc_html__( 'Load More', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'loadmore_btn_type',
			[
				'label'   => esc_html__( 'Button Type', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-type-solid-ellipse',
				'options' => $this->get_array( 'btn_type' )
			]
		);

		$this->add_control(
			'loadmore_btn_color',
			[
				'label'   => esc_html__( 'Button Color', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-color-black',
				'options' => $this->get_array( 'btn_color' )
			]
		);

		$this->add_control(
			'loadmore_btn_gradient_palette',
			[
				'label'   => esc_html__( 'Gradient Palette', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'orange-pulp',
				'options' => $this->get_array( 'gradient_palette' ),
				'condition' => [
					'loadmore_btn_color' => 'btn-color-gradient-palette'
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
					'{{WRAPPER}} .post' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		

		$this->add_control(
			'box_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post' => 'border: 1px solid {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .post'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Meta ------------------------------------------------- */

		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => esc_html__( 'Meta', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'selector' => '{{WRAPPER}} .meta-group a'
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_2
				],
				'selectors' => [
					'{{WRAPPER}} .meta-group a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .meta-group a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'meta_text_shadow',
				'selector' => '{{WRAPPER}} .meta-group a'
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
				'selector' => '{{WRAPPER}} .title a'
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
					'{{WRAPPER}} .title a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .title a'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Excerpt ---------------------------------------------- */

		$this->start_controls_section(
			'section_style_excerpt',
			[
				'label' => esc_html__( 'Excerpt', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .excerpt'
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_3
				],
				'selectors' => [
					'{{WRAPPER}} .excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'excerpt_text_shadow',
				'selector' => '{{WRAPPER}} .excerpt'
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


		/* Style Inner Section: Load More -------------------------------------------- */
		
		$this->start_controls_section(
			'section_style_loadmore',
			[
				'label' => esc_html__( 'Load More', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'loadmore_btn_typography',
				'selector' => '{{WRAPPER}} .btn-loadmore a.btn'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'loadmore_btn_shadow',
				'selector' => '{{WRAPPER}} .btn-loadmore a.btn'
			]
		);

		$this->add_responsive_control(
			'loadmore_btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .btn-loadmore a.btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'loadmore_btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .btn-loadmore a.btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_loadmore_button_style' );

		$this->start_controls_tab(
			'tab_loadmore_button_normal',
			[
				'label' => esc_html__( 'Normal', 'octagon-elements-lite-for-elementor' ),
			]
		);

		$this->add_control(
			'loadmore_btn_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .btn-loadmore a.btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'loadmore_btn_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-loadmore a.btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'loadmore_btn_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-loadmore a.btn' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .btn-loadmore a.btn.btn-type-line-collapse:after' => 'background: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'loadmore_btn_box_shadow',
				'selector' => '{{WRAPPER}} .btn-loadmore a.btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_loadmore_button_hover',
			[
				'label' => esc_html__( 'Hover', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'hover_loadmore_btn_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-loadmore a.btn:hover, {{WRAPPER}} .btn-loadmore a.btn:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .btn-loadmore a.btn:hover svg, {{WRAPPER}} .btn-loadmore a.btn:focus svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'hover_loadmore_btn_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-loadmore a.btn:hover, {{WRAPPER}} .btn-loadmore a.btn:focus' => 'background-color: {{VALUE}};'
				],
			]
		);		

		$this->add_control(
			'hover_loadmore_btn_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-loadmore a.btn:hover, {{WRAPPER}} .btn-loadmore a.btn:focus' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .btn-loadmore a.btn.btn-type-line-collapse:hover:after, {{WRAPPER}} .btn-loadmore a.btn.btn-type-line-collapse:focus:after' => 'background: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'hover_loadmore_btn_box_shadow',
				'selector' => '{{WRAPPER}} .btn-loadmore a.btn:hover, {{WRAPPER}} .btn-loadmore a.btn:focus'
			]
		);

		$this->add_control(
			'hover_loadmore_btn_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		/* Style Inner Section: Page Number ------------------------------------------ */

		$this->start_controls_section(
			'section_style_page_number',
			[
				'label' => esc_html__( 'Page Number', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'page_number_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul.page-numbers li *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'page_number_margin',
			[
				'label'      => esc_html__( 'Margin', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pagination ul.page-numbers li *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'page_number_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pagination ul.page-numbers li *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'page_number_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul.page-numbers li *' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'page_number_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul.page-numbers li *' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'page_number_current_color',
			[
				'label'     => esc_html__( 'Current Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul.page-numbers li .page-numbers.current' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'page_number_current_background_color',
			[
				'label'     => esc_html__( 'Current Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul.page-numbers li .page-numbers.current' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'page_number_current_border_color',
			[
				'label' => esc_html__( 'Current Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul.page-numbers li .page-numbers.current' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Next/Previous ---------------------------------------- */

		$this->start_controls_section(
			'section_style_next_previous',
			[
				'label' => esc_html__( 'Next/Previous', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'next_previous_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul li.next a, {{WRAPPER}} .pagination ul li.previous a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'next_previous_margin',
			[
				'label'      => esc_html__( 'Margin', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pagination ul li.next a, {{WRAPPER}} .pagination ul li.previous a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'next_previous_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pagination ul li.next a, {{WRAPPER}} .pagination ul li.previous a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'next_previous_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul li.next a, {{WRAPPER}} .pagination ul li.previous a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'next_previous_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination ul li.next a, {{WRAPPER}} .pagination ul li.previous a' => 'border-color: {{VALUE}};'
				],
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

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_content_type_render_attribute', [] );
		

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
		do_action( 'oee_content_type_render_attributes' );

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
		$this->get_query();

		echo oee_get_shortcode_template( 'content-type', $this );

	}

	/**
	 * Returns WP Query arguemnts
	 * 
	 * @version 1.0
	 * @since  1.0
	 * @return array
	 */
	public function get_query() {

		$settings = $this->get_settings_for_display();

		$method        = $settings['method'] ?? 'default';
		$content_type  = $settings['content_type'] ?? 'post';
		$taxonomy      = $settings['taxonomy'] ?? 'category';
		$limit         = $settings['limit'] ?? 6;
		$order         = $settings['order'] ?? 'desc';
		$orderby       = $settings['orderby'] ?? 'date';
		$post_in       = $settings['post_in'] ?? '';
		$terms_in      = $settings['terms_in'] ?? '';
		$author_in     = $settings['author_in'] ?? '';
		$post_not_in   = $settings['post_not_in'] ?? '';
		$terms_not_in  = $settings['terms_not_in'] ?? '';
		$author_not_in = $settings['author_not_in'] ?? '';
		$offset        = $settings['offset'] ?? '';

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

		$args = array(
			'post_type'           => $content_type,
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $limit,
			'paged'               => $paged,
			'order'               => $order,
			'orderby'             => $orderby
		);

		if( '' != $post_not_in ) {
			$post_not_in_array = explode( ',', $post_not_in );

			$args['post__not_in'] = $post_not_in_array;
		}

		if( '' != $offset ) {
			$args['offset'] = $offset;
		}

		if( '' != $terms_not_in ) {
			$terms_not_in_array = explode( ',', $terms_not_in );

			$args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $terms_not_in_array,
				'operator' => 'NOT IN'
			);
		}

		if( '' != $author_not_in ) {
			$author_not_in_array = explode( ',', $author_not_in );

			foreach( $author_not_in_array as $key => $username ) {
				if ( username_exists( $username ) ) {
					$user_obj = get_user_by( 'login', $username );
					$user_not_in[] = $user_obj->ID;
				}
			}

			$args['author__not_in'] = $user_not_in;
		}

		if( '' != $post_in && 'id' == $method ) {
			$post_in_array = explode( ',', $post_in );

			$args['post__in'] = $post_in_array;
		}
		elseif( '' != $terms_in && 'terms' == $method ) {
			$terms_in_array = explode( ',', $terms_in );

			$args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $terms_in_array,
				'operator' => 'IN'
			);
		}
		elseif( '' != $author_in && 'author' == $method ) {
			$author_in_array = explode( ',', $author_in );

			foreach( $author_in_array as $key => $username ) {
				if ( username_exists( $username ) ) {
					$user_obj = get_user_by( 'login', $username );
					$user_in[] = $user_obj->ID;
				}					
			}

			$args['author__in'] = isset( $user_in ) ? $user_in : '';
		}
		elseif( 'popular' == $method ) {
			$args['orderby'] = 'comment_count';
		}
		elseif( 'featured' == $method ) {
			$args['meta_query'][] = array(
				'key'   => 'featured_post',
				'value' => 'featured'
			);
		}

		$this->args  = $args;
		$this->paged = $paged;

		return $this->args;

	}

}