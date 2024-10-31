<?php

/**
 * Advance Counter
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

class OEE_Advance_Counter_Module extends OEE_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		
		parent::__construct($data, $args);

		wp_register_script( 'countimator', OCTAGON_CORE_URL . 'library/js/countimator.min.js', array( 'jquery' ), '1.0', false );
   }

	/**
	 * Get element name.
	 *
	 * @version  1.0 
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'oee_advance_counter';
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
		return esc_html__( 'Advance Counter', 'octagon-elements-lite-for-elementor' );
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
		return 'oee-counter';
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
		return [ 'oee-advance-counter' ];
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
		return [ 'countimator' ];
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
			'show_icon',
			[
				'label'   => esc_html__( 'Display Icon', 'octagon-elements-lite-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hide',
				'options' => $this->get_array( 'show' )
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'octagon-elements-lite-for-elementor' ),
				'type'  => Controls_Manager::ICONS,
				'condition' => [
					'show_icon' => 'show'
				]
			]
		);

		$this->add_control(
			'number',
			[
				'label'      => esc_html__( 'Targeted Number', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'number',
				'default'    => 100
			]
		);

		$this->add_control(
			'label',
			[
				'label'      => esc_html__( 'Label', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'text',
				'default'    => esc_html__( 'Percent Number', 'octagon-elements-lite-for-elementor' )
			]
		);

		$this->add_control(
			'prefix',
			[
				'label'      => esc_html__( 'Prefix', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'text',
				'default'    => ''
			]
		);

		$this->add_control(
			'suffix',
			[
				'label'      => esc_html__( 'Suffix', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'text',
				'default'    => ''
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
				],
				'default' => 'align-center'
			]
		);

		$this->add_control(
			'decimals',
			[
				'label'      => esc_html__( 'Decimals', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'text',
				'default'    => '0'
			]
		);

		$this->add_control(
			'decimal_delimiter',
			[
				'label'      => esc_html__( 'Decimal Delimiter', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'text',
				'default'    => '.'
			]
		);

		$this->add_control(
			'thousand_delimiter',
			[
				'label'      => esc_html__( 'Thousand Delimiter', 'octagon-elements-lite-for-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'text',
				'default'    => ','
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
				'label' => esc_html__( 'Background Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-counter' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .advance-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		

		$this->add_control(
			'box_border_color',
			[
				'label' => esc_html__( 'Border Color', 'octagon-elements-lite-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-counter' => 'border: 1px solid {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .advance-counter'
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
					'{{WRAPPER}} .advance-counter .counter-icon' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .advance-counter .counter-icon' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .advance-counter .counter-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'icon_text_shadow',
				'selector' => '{{WRAPPER}} .advance-counter .counter-icon'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Prefix ----------------------------------------------- */

		$this->start_controls_section(
			'section_style_prefix',
			[
				'label' => esc_html__( 'Prefix', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'prefix_typography',
				'selector' => '{{WRAPPER}} .advance-counter .prefix'
			]
		);

		$this->add_control(
			'prefix_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .advance-counter .prefix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'prefix_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .advance-counter .prefix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'prefix_text_shadow',
				'selector' => '{{WRAPPER}} .advance-counter .prefix'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Suffix ----------------------------------------------- */

		$this->start_controls_section(
			'section_style_suffix',
			[
				'label' => esc_html__( 'Suffix', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'suffix_typography',
				'selector' => '{{WRAPPER}} .advance-counter .suffix'
			]
		);

		$this->add_control(
			'suffix_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .advance-counter .suffix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'suffix_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .advance-counter .suffix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'suffix_text_shadow',
				'selector' => '{{WRAPPER}} .advance-counter .suffix'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Number ----------------------------------------------- */

		$this->start_controls_section(
			'section_style_number',
			[
				'label' => esc_html__( 'Number', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .advance-counter .number'
			]
		);

		$this->add_control(
			'number_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_1
				],
				'selectors' => [
					'{{WRAPPER}} .advance-counter .number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'number_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .advance-counter .number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'number_text_shadow',
				'selector' => '{{WRAPPER}} .advance-counter .number'
			]
		);

		$this->end_controls_section();


		/* Style Inner Section: Label ------------------------------------------------ */

		$this->start_controls_section(
			'section_style_label',
			[
				'label' => esc_html__( 'Label', 'octagon-elements-lite-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'scheme'   => Schemes_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .advance-counter .counter-label'
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( 'Color', 'octagon-elements-lite-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'scheme' => [
					'type'  => Schemes_Color::get_type(),
					'value' => Schemes_Color::COLOR_2
				],
				'selectors' => [
					'{{WRAPPER}} .advance-counter .counter-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .advance-counter .counter-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'label_text_shadow',
				'selector' => '{{WRAPPER}} .advance-counter .counter-label'
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

		$attributes['wrapper']['class'][] = 'octagon-elements advance-counter';
		$attributes['wrapper']['class'][] = $settings['align'] ?? 'align-center';
		$attributes['wrapper']['class'][] = $settings['ex_class'] ?? '';

		$attributes['number']['class'][] = 'number';

		if( '' != $settings['decimals'] ) {
			$attributes['number']['data-decimals'] = $settings['decimals'];
		}

		if( '' != $settings['decimal_delimiter'] ) {
			$attributes['number']['data-decimal-delimiter'] = $settings['decimal_delimiter'];
		}

		if( '' != $settings['thousand_delimiter'] ) {
			$attributes['number']['data-thousand-delimiter'] = $settings['thousand_delimiter'];
		}

		$attributes['prefix']['class'][] = 'prefix';

		$attributes['suffix']['class'][] = 'suffix';

		$attributes['label']['class'][] = 'counter-label';

		/**
		 * Returns render attributes array based on {module}_render_attribute
		 *
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		$attributes = apply_filters( 'oee_advance_counter_render_attribute', $attributes );
		

		// Add render attributes
		$this->add_render_attribute( $attributes );

		$this->add_inline_editing_attributes( 'prefix', 'none' );

		$this->add_inline_editing_attributes( 'suffix', 'none' );

		$this->add_inline_editing_attributes( 'number', 'none' );

		$this->add_inline_editing_attributes( 'label', 'none' );

		/**
		 * Render attributes based on {module}_render_attributes
		 *
		 * Fires before rendering elements content.
		 * 
		 * @version  1.0 
		 * @since 1.0
		 * 
		 */
		do_action( 'oee_advance_counter_render_attributes' );

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

		var iconHTML = '';

		view.addRenderAttribute( 'number', {
			'class': [ 'number' ]
		} );

		if( '' != settings.decimals ) {
			view.addRenderAttribute( 'number', {
				'data-decimals': settings.decimals
			} );
		}

		if( '' != settings.decimal_delimiter ) {
			view.addRenderAttribute( 'number', {
				'data-decimal-delimiter': settings.decimal_delimiter
			} );
		}

		if( '' != settings.thousand_delimiter ) {
			view.addRenderAttribute( 'number', {
				'data-thousand-delimiter': settings.thousand_delimiter
			} );
		}
		
		if( 'show' == settings.show_icon && 'svg' != settings.icon.library ) {
			iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'class' : 'counter-icon' }, 'span' , 'object' );
		}
		
		view.addRenderAttribute( 'label', {
			'class': 'counter-label'
		} );

		view.addInlineEditingAttributes( 'label', 'none' );
		
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
		do_action( 'oee_advance_counter_live_attributes' );
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

		echo oee_get_shortcode_template( 'advance-counter', $this );

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

		echo oee_get_live_template( 'advance-counter' );
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

		if( 'show' == $settings['show_icon'] ) {
			if( 'svg' === $settings['icon']['library'] ) {
				return false;
			}
			else {
				Icons_Manager::render_icon( $settings['icon'], [ 'class' => 'counter-icon' ], 'span' );
			}
		}

	}

}