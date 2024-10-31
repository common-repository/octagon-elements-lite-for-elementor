<?php

/**
 * Timeline
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
use \Elementor\Repeater;
use \Elementor\Core\Schemes\Typography as Schemes_Typography;
use \Elementor\Core\Schemes\Color as Schemes_Color;

class OEE_Timeline_Module extends OEE_Widget_Base {

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_timeline';
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
		return esc_html__( 'Timeline', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-timeline';
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
		return [ 'oee-timeline' ];
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
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p'  => 'P'
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'sub_title', [
				'label'       => esc_html__( 'Sub Title', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'On 25th Feb 2020', 'octagon-elements-lite-for-elementor' ),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Default Title', 'octagon-elements-lite-for-elementor' ),
				'label_block' => true
			]
		);

		$repeater->add_control(
			'desc', [
				'label'       => esc_html__( 'Description', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Enter the short description to explain what is this all about?', 'octagon-elements-lite-for-elementor' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'timeline',
			[
				'label'       => esc_html__( 'Timeline', 'octagon-elements-lite-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
					[
						'sub_title' => esc_html__( 'On 1975 – 1985', 'octagon-elements-lite-for-elementor' ),
						'title' => esc_html__( 'The Founding of Microsoft', 'octagon-elements-lite-for-elementor' ),
						'desc' => esc_html__( 'Microsoft is founded and starts out creating its first software products, such as the MS-DOS operating system.', 'octagon-elements-lite-for-elementor' )
					],
					[
						'sub_title' => esc_html__( 'On 1985 – 1994', 'octagon-elements-lite-for-elementor' ),
						'title' => esc_html__( 'Growing Microsoft', 'octagon-elements-lite-for-elementor' ),
						'desc' => esc_html__( 'Microsoft moves to Redmond, IPOs, launches Microsoft Office and its first GUI.', 'octagon-elements-lite-for-elementor' )
					],
					[
						'sub_title' => esc_html__( 'On 1995 – 2000', 'octagon-elements-lite-for-elementor' ),
						'title' => esc_html__( 'Stepping Stone', 'octagon-elements-lite-for-elementor' ),
						'desc' => esc_html__( 'Microsoft releases Windows 95 and Windows 98, both which become extremely popular.', 'octagon-elements-lite-for-elementor' )
					],
					[
						'sub_title' => esc_html__( 'On 2000 - Onwards', 'octagon-elements-lite-for-elementor' ),
						'title' => esc_html__( 'Modern Microsoft', 'octagon-elements-lite-for-elementor' ),
						'desc' => esc_html__( 'The desktop operating system market is collapsing, as is the market share of Windows-based programming languages among developers.', 'octagon-elements-lite-for-elementor' )
					]
				],
				'title_field' => '{{{ title }}}'
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
					'{{WRAPPER}} .timeline-set' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .timeline-set' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		

		$this->add_control(
			'box_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-set' => 'border: 1px solid {{VALUE}};',
					'{{WRAPPER}} .timeline .vertical-line' => 'background: {{VALUE}};',
					'{{WRAPPER}} .timeline-set:nth-child( odd ):after, {{WRAPPER}} .timeline-set:nth-child( even ):before' => 'background: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .timeline-set'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Sub Title -------------------------------------------- */

		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .sub-title'
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_2
				],
				'selectors' => [
					'{{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'sub_title_text_shadow',
				'selector' => '{{WRAPPER}} .sub-title'
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
				'selector' => '{{WRAPPER}} .title'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_1
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .title'
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
				'selector' => '{{WRAPPER}} .desc'
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
					'{{WRAPPER}} .desc' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'description_text_shadow',
				'selector' => '{{WRAPPER}} .desc'
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

		$attributes['wrapper']['class'][] = 'octagon-elements timeline';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_timeline_render_attribute', $attributes );

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
		do_action( 'oee_timeline_render_attributes' );

	}

	/**
	 * Set live attributes.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access protected
	 */
	protected function set_live_attributes() {

		/**
		 * Render attributes based on {module}_live_attributes
		 *
		 * Fires before rendering live template content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_timeline_live_attributes' );
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

		echo oee_get_shortcode_template( 'timeline', $this );

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

		echo oee_get_live_template( 'timeline' );
	}

	/**
	 * Render timeline sets.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 */
	public function render_timeline() {

		$settings = $this->get_settings_for_display();

		$timeline = $settings['timeline'] ?? [];

		foreach( $timeline as $index => $set ) :

			$sub_title_setting_key = $this->get_repeater_setting_key( 'sub_title', 'timeline', $index );
			$title_setting_key = $this->get_repeater_setting_key( 'title', 'timeline', $index );
			$desc_setting_key = $this->get_repeater_setting_key( 'desc', 'timeline', $index );

			$this->add_render_attribute( $sub_title_setting_key, [
				'class' => [ 'sub-title' ]
			] );

			$this->add_render_attribute( $title_setting_key, [
				'class' => [ 'title' ]
			] );

			$this->add_render_attribute( $desc_setting_key, [
				'class' => [ 'desc' ]
			] );

			$this->add_inline_editing_attributes( $sub_title_setting_key, 'none' );
			$this->add_inline_editing_attributes( $title_setting_key, 'none' );
			$this->add_inline_editing_attributes( $desc_setting_key, 'none' );

			$sub_title = $set['sub_title'] ?? '';
			$title     = $set['title'] ?? '';
			$desc      = $set['desc'] ?? '';

			?>
			<div class="timeline-set">
				<?php if( ! empty( $desc ) ) :

					if( ! empty( $sub_title ) ) : ?>
						<span <?php echo $this->get_render_attribute_string( $sub_title_setting_key ); ?>><?php echo esc_html( $sub_title ); ?></span>
						<?php
					endif;

					if( ! empty( $title ) ) : ?>
						<p <?php echo $this->get_render_attribute_string( $title_setting_key ); ?>><?php echo esc_html( $title ); ?></p>
						<?php
					endif; ?>

					<p <?php echo $this->get_render_attribute_string( $desc_setting_key ); ?>><?php echo esc_html( $desc ); ?></p>

					<?php
				endif; ?>
			</div> <!-- .timeline-set -->

		<?php endforeach;
	}

}